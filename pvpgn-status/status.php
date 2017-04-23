<?php
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
//                            The Player vs Player Gaming Network                             //
//                                 Server status PHP script                                   //
//                                                                                            //
//                            Copyright (C) 2004, 2005 by U-238                               //
//                          http://pvpgn-phputils.sourceforge.net/                            //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// LICENSE                                                                                    //
//                                                                                            //
// This program is free software; you can redistribute it and/or modify it under the terms of //
// the GNU General Public License (GPL) as published by the Free Software Foundation; either  //
// version 2 of the License, or (at your option) any later version.                           //
//                                                                                            //
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;  //
// without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  //
// See the GNU General Public License for more details.                                       //
//                                                                                            //
// To read the license please visit http://www.gnu.org/copyleft/gpl.html                      //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// CHANGELOG                                                                                  //
//                                                                                            //
//   v1.2                                                                                     //
// - Users online can now be listed side-by-side rather than in a vertical list               //
// - You can now choose not to display a game icon next to the name of a user/game            //
//                                                                                            //
//   v1.1                                                                                     //
// - Fixed a bug where a PHP error would be shown if there are no users/games online          //
//                                                                                            //
//   v1.0                                                                                     //
// - Initial release of 1.x branch - complete rewrite relative to 0.x branch.                 //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// PURPOSE OF THIS PROGRAM                                                                    //
//                                                                                            //
// This script parses the server.dat file where PvPGN outputs info about users, games and     //
// channels online, and displays this information on a website.                               //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// AUTHOR                                                                                     //
//                                                                                            //
//   U-238 (mark@darkterrorsdomain.cjb.net)                                                   //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

// Path to server.dat
$statusfile = '/usr/local/pvpgn/var/status/server.dat';

// What info should be shown?
$show = array(
    'STATUS' => true,
    'USERS' => true,
    'GAMES' => true,
    'CHANNELS' => true,
);

// Display game icons next to users/games online?
$displayicons = true;

// URL of directory containing the game icons.  No trailing slash.
$iconsdir = "/gameicons";

// Enable profile links?
$profilelink_enable = true;
$profilelink_url = "/pvpgn-stats/index.php";    // URL to pvpgn-stats

// Display the list of users/games/channels side by side rather than in a vertical list?
$sidebyside = false;

// Language constants.  Translate into your native language if needed.
$language = array(
    'STATUSDETAIL'   => 'PvPGN Server Status',
    'USERSDETAIL'    => 'Users currently online',
    'GAMESDETAIL'    => 'Games currently online',
    'CHANNELSDETAIL' => 'Channels currently online',

    'Version'        => 'PvPGN version',
    'Uptime'         => 'Uptime',
    'Users'          => 'Users',
    'Games'          => 'Games',
    'Channels'       => 'Channels',
    'UserAccounts'   => 'User accounts',
    
    'none'           => 'None',
);

// ------------------------------------------------------------------------------------------ //
//                                                                                            //
//               Configuration finished, no need to change anything below here                //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //


function parse_statusfile($filename) {
    $ini_array = array();
    $lines = file($filename);
    foreach($lines as $line) {
        $line = trim($line);
        if ($line == "") {
            continue;
        } else if ($line[0] == "[" && $line[strlen($line) - 1] == "]") {
            $sec_name = substr($line, 1, strlen($line) - 2);
        } else {
            $pos = strpos($line, "=");
            $property = substr($line, 0, $pos);
            $value = substr($line, $pos + 1);
            if ($sec_name == 'USERS') {
                list($ini_array[$sec_name][$property]['ctag'],$ini_array[$sec_name][$property]['name']) = explode(',',$value);
            } else if ($sec_name == 'GAMES') {
                list($ini_array[$sec_name][$property]['ctag'],$_game_id,$ini_array[$sec_name][$property]['name']) = explode(',',$value);
            } else {
                $ini_array[$sec_name][$property] = $value;
            }
        }
    }
    return $ini_array;
}

function namedisplay($user) {
    global $profilelink_enable, $profilelink_url;
    if ($profilelink_enable && $user['ctag'] != 'CHAT') {
        return "<a href=\"".$profilelink_url."?game=".$user['ctag']."&amp;user=".$user['name']."\">".$user['name']."</a>";
    } else {
        return $user['name'];
    }
}

$status_array = parse_statusfile($statusfile);

if ($sidebyside) {
    $output = "<div>\n";
    foreach ($show as $type => $show) {
        if ($show == true) {
            $output .= "<strong>".$language[$type.'DETAIL']."</strong><br>\n";
            if (empty($status_array[$type])) {
                $output .= $language['none']."<br><br>\n";
            } else {
                switch ($type) {
                    case 'STATUS':
                        foreach ($status_array[$type] as $key => $value) {
                            $output .= $language[$key].": ".$value."<br>";
                        }
                        break;
                    case 'USERS':
                        foreach ($status_array[$type] as $key => $value) {
                            $output .= namedisplay($value).",   ";
                        }
                        break;
                    case 'GAMES':
                        foreach ($status_array[$type] as $key => $value) {
                            $output .= $value['name'].",   ";
                        }
                        break;
                    case 'CHANNELS':
                        foreach ($status_array[$type] as $key => $value) {
                            $output .= $value.",   ";
                        }
                        break;
                }
                $output = substr($output,0,-4);
                $output .= "<br><br>\n";
            }
        }
    }
} else {
    $output = "<table cellspacing=\"0\">\n";
    foreach ($show as $type => $show) {
        if ($show == true) {
            $output .= "  <tr>\n";
            $output .= "    <td colspan=\"2\">\n";
            $output .= "      <strong>".$language[$type.'DETAIL']."</strong>\n";
            $output .= "    </td>\n";
            $output .= "  </tr>\n";
            if ($status_array[$type] == true) {
                foreach ($status_array[$type] as $key => $value) {
                    if ($type == 'STATUS') {
                        $output .= "  <tr>\n";
                        $output .= "    <td colspan=\"2\">\n";
                        $output .= "      ".$language[$key].": ".$value."\n";
                        $output .= "    </td>\n";
                        $output .= "  </tr>\n";
                    } else {
                        $output .= "  <tr>\n";
                        if ($type != 'CHANNELS') {
                            $output .= "    <td width=\"1%\">\n";
                            if ($displayicons)
                                $output .= "      <img src=\"".$iconsdir."/".$value['ctag'].".jpg\">\n";
                            else
                                $output .= "      &nbsp;\n";
                            $output .= "    </td>\n";
                            $output .= "    <td>\n";
                            if ($type == 'USERS') {
                                $output .= "      ".namedisplay($value)."\n";
                            } else {
                                $output .= "      ".$value['name']."\n";
                            }
                            $output .= "    </td>\n";
                            $output .= "  </tr>\n";
                        } else {
                            $output .= "  <tr>\n";
                            $output .= "    <td colspan=\"2\">\n";
                            $output .= "      ".$value."\n";
                            $output .= "    </td>\n";
                            $output .= "  </tr>\n";
                        }
                    }
                }
            } else {
                $output .= "  <tr>\n";
                $output .= "    <td colspan=\"2\">\n";
                $output .= "      <strong>".$language['none']."</strong>\n";
                $output .= "    </td>\n";    
                $output .= "  </tr>\n";
            }
            $output .= "  <tr>\n";
            $output .= "    <td colspan=\"2\" height=\"7\">\n";
            $output .= "    </td>\n";
            $output .= "  </tr>\n";
        }
    }
    $output .= "</table>\n";
}
echo $output;
?>
