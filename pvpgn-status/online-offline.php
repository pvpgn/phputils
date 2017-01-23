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
// This script pings a PvPGN server and (optionally) Diablo 2 gameservers to see if they are  //
// online and then displays the server status on a website.                                   //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// AUTHOR                                                                                     //
//                                                                                            //
//   U-238 (mark@darkterrorsdomain.cjb.net)                                                   //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

// Language constants.  Translate into your native language if needed.
$language = array(
    'pvpgnonline' => 'The PvPGN server is <font color="#00FF00">online</font>.',
    'pvpgnoffline' => 'The PvPGN server is <font color="#FF0000">offline</font>.',
    'd2realmonline' => 'The Diablo 2 realm is <font color="#00FF00">online</font> (%d of %d gameservers running).',
                                                         // This will end up like:  (3 of 5 gameservers running)
    'd2realmoffline' => 'The Diablo 2 realm is <font color="#FF0000">offline</font>.',
);

// Connection timeout in seconds.  If the script cannot connect to a server before this timeout,
// then that server is considered to be offline.  Don't make this too big or your website could
// take a long time to load.
$timeout = 1;

$pvpgn = array(
    'check' => true,             // Should we check the status of the PvPGN server? (true or false)
    'ip' => '127.0.0.1',         // IP of the PvPGN server
    'port' => 6112,              // Port of the PvPGN server
);

// ---------------------------------------------------------------------------------------------- //
// If you are not running a Diablo 2 closed realm, there is no need to change anything below here //
// ---------------------------------------------------------------------------------------------- //

$d2realm = array(
    'check' => false,            // Should we check the status of the Diablo 2 realm? (true or false)
    'd2cs' => array(
        'ip' => '127.0.0.1',     // d2cs IP address
        'port' => 6113,          // d2cs port
    ),
    'd2dbs' => array(
        'ip' => '127.0.0.1',     // d2dbs IP address
        'port' => 6114,          // d2dbs port
    ),
    'd2gs' => array(
        // The following is a list of your Diablo 2 gameservers.  Add as many entries
        // as you need, with a comma (,) after each one.  Make sure you have
        // quotes '' around each IP address.
        '127.0.0.1',
    ),
);

// A Diablo 2 realm is considered to be online if:
//  The Diablo 2 character server (d2cs) is running,
//  the Diablo 2 database server (d2dbs) is running,
//  and at least one Diablo 2 gameserver is running.

// ------------------------------------------------------------------------------------------ //
//                                                                                            //
//               Configuration finished, no need to change anything below here                //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

$output = "";

if ($pvpgn['check']) {
    if ($fp = @fsockopen($pvpgn['ip'], $pvpgn['port'], $errno, $errstr, $timeout)) {
        fclose($fp);
        $pvpgn_online = true;
        $output .= "<p>\n";
        $output .= "  ".$language['pvpgnonline']."\n";
        $output .= "</p>\n";
    } else {
        $pvpgn_online = false;
        $output .= "<p>\n";
        $output .= "  ".$language['pvpgnoffline']."\n";
        $output .= "</p>\n";
    }
}

if ($d2realm['check']) {
    $d2realm_online = false;
    if ($fp = @fsockopen($d2realm['d2cs']['ip'], $d2realm['d2cs']['port'], $errno, $errstr, $timeout)) {
        fclose($fp);
        if ($fp = @fsockopen($d2realm['d2dbs']['ip'], $d2realm['d2dbs']['port'], $errno, $errstr, $timeout)) {
            fclose($fp);
            $a = 0;
            $b = 0;
            foreach ($d2realm['d2gs'] as $ip) {
                $a++;
                if ($fp = @fsockopen($ip, 4000, $errno, $errstr, $timeout)) {
                    fclose($fp);
                    $b++;
                    $d2realm_online = true;
                }
            }
        }
    }
    if ($d2realm_online) {
        $output .= "<p>\n";    
        $output .= "  ".sprintf($language['d2realmonline'],$b,$a)."\n";
        $output .= "</p>\n";
    } else {
        $output .= "<p>\n";
        $output .= "  ".$language['d2realmoffline']."\n";
        $output .= "</p>\n";
    }
}
echo $output;
?>
