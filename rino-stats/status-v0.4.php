<?php
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
//                            The Player vs Player Gaming Network                             //
//                                 Server status PHP script                                   //
//                                                                                            //
//                               Copyright (C) 2004 by U-238                                  //
//                          http://www.darkterrorsdomain.cjb.net/                             //
//                                                                                            //
//                     Uses some code from the server.dat parser by STORM                     //
//                                 http://www.stormzone.ru                                    //
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
// This software is for non-commercial use only.                                              //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// CHANGELOG                                                                                  //
//                                                                                            //
//   v0.4 - Requires PvPGN 1.6.3 or later                                                     //
// - Added support for Windows servers                                                        //
// - Added an option to monitor the online / offline status of a remote server                //
// - Added an option to display an icon next to a user's name to show what game they are      //
//   currently playing                                                                        //
// - The profiles page link now links to the user's profile for the game they are currently   //
//   playing                                                                                  //
// - Added an option to list the users side-by-side                                           //
// - The PHP-Nuke module is now a block only                                                  //
// - Fixed a bug where the PHP-Nuke module was interfering with other blocks around it        //
//                                                                                            //
//   v0.3                                                                                     //
// - Now available as a PHP-Nuke module                                                       //
//                                                                                            //
//   v0.2                                                                                     //
// - Certain stats (users, games, channels) can now be turned on/off.                         //
// - Added an option to have the list of users link to their respective user profiles.        //
//                                                                                            //
//   v0.1                                                                                     //
// - Initial Release                                                                          //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// USAGE                                                                                      //
//                                                                                            //
// At the beginning of your webpage, put:    include("status-v0.4.php");                      //
// Where you want to show the MOTD, put:     echo __BNMOTD;                                   //
// Where you want to show the server status: echo __PVPGN_STATUS;                             //
//                                                                                            //
// For more information please refer to the documentation at:                                 //
// http://www.darkterrorsdomain.cjb.net/PvPGN-Status/index.php?module=Documentation           //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
// Original Author of the file: U-238                                                         //
// Purpose of the file: Checks to see if certain PvPGN processes are running, and if PvPGN is //
// running, it parses the server.dat file where PvPGN outputs all the info about current      //
// server status, amount of games, users, channels etc and shows the info you specify on your //
// webpage.                                                                                   //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //
// CONFIGURATION                                                                              //

// Put the IP address of the PvPGN server you want to monitor.  It is not recommended to use
// 127.0.0.1 or localhost.  If you are behind a router, put the PvPGN server's internal IP
// address, not your external IP address.
$ip = "127.0.0.1";

// The ports that PvPGN uses.  In most cases the default will be fine.  If you don't know what
// this is then don't touch it.
$bnetdport = 6112;              // bnetd
$d2csport = 6113;               // d2cs
$d2dbsport = 6114;              // d2dbs
$win32='';
$onlinestatus['d2cs']='i';

// Display online/offline status for which servers?
$pvpgn = "yes";                 // PvPGN server
$d2realm = "no";               // Diablo 2 closed realm

// Rather than sending a ping to the server using fsockopen, you can use the Unix ps command
// to check if the processes are running.  This will only work on Unix-based machines and is
// generally faster than using fsockopen.  If you use ps, you won't need to specify your IP
// address above. It also requires that the web server is on the same machine as the PvPGN
// server.  If you don't know what this is then don't touch it.
$use_ps = "no";

// This is only needed if you are using ps:
// The Unix user that runs the bnetd, d2cs and d2dbs processes.  It cannot be the same user
// that runs the web server process or the script will not work.
$user = "pvpgn";

// If the server is online, would you like to show the server stats? (of course!)
$stats = "yes";

// If you answered no, you can ignore the rest of the configuration section.

// The path to PvPGN's server.dat file.  If you want to customize the layout of this script
// when there are no users online, you can use the server.dat.example included with this
// package.
$statsfile = "d://consolidado de archivos/fran no borrar/pvpgn/var/status/server.dat";

// What stats should be displayed?
// Display number of:
$num_users = "yes";             // Users
$num_games = "yes";             // Games
$num_channels = "yes";          // Channels
$num_useraccounts = "yes";      // User accounts

// And list of:
$list_users = "yes";            // Users
$list_games = "yes";            // Games
$list_channels = "no";         // Channels

// Display PvPGN version and server uptime?
$version = "yes";               // PvPGN version
$uptime = "yes";                // Uptime

// Do you want the list of users/games/channels to be displayed side by side rather than one
// user/game/channel per line?  This is a good idea if you have a busy server.
$sidebyside = "no";

// Do you want the list of users to display a game icon next to their name to show what game
// they are playing?  You cannot use this feature if you have the users listed side by side.
$gameicon = "yes";

// The URL to the directory where the game icons are stored.  No trailing slash.
$iconurl = "/ladder/gameicons";

// Do you want the list of users to link to a profile page?
$profilelink = "yes";

// What is the URL of the profiles page?  "?game=(clienttag)&user=(username)" will be added at
// the end of this URL.  For example: /pvpgn-stats/index.php?game=W3XP&user=JoeUser
$profileurl = "/ladder/index.php";

// Message of the day.  This is not used if you are using this script as a PHP-Nuke module
$bnmotd = "Our PvPGN server is running PvPGN version %v.  There are %a user accounts on our server.  The server has been online for %t and there are currently %u users online in %g games and %c channels.";

// Possible variables for the message of the day:
// %v = PvPGN version
// %t = Uptime
// %g = Number of games
// %u = Number of users
// %c = Number of chat channels
// %a = Number of user accounts

// Message of the day to be displayed if the server is offline.  You cannot use any variables
// (users, games, etc.) in here.
$offlinemotd = "Our PvPGN server is currently offline";

// Language constants.  Translate into your native language if needed.
define('__BNETDONLINE', 'The PvPGN server is <font color="#00FF00">online</font>.');
define('__BNETDOFFLINE','The PvPGN server is <font color="#FF0000">offline</font>.');
define('__REALMONLINE', 'The Diablo II closed realm is <font color="#00FF00">online</font>.');
define('__REALMOFFLINE','The Diablo II closed realm is <font color="#FF0000">offline</font>.');
define('__VERSION',     'PvPGN version:');
define('__UPTIME',      'Uptime:');
define('__USERS',       'Users:');
define('__GAMES',       'Games:');
define('__CHANNELS',  	'Channels:');
define('__USERACCOUNTS','User accounts:');
define('__USERSONSERV', 'Users currently online:');
define('__GAMESONSERV', 'Games currently online:');
define('__CHANSONSERV', 'Channels currently online:');
define('__NOCHANNELS',  'none');
define('__NOGAMES',     'none');
define('__NOUSERS',     'none');
define('__INCOMPATIBLE','This script does not work with your version of PvPGN.  Please upgrade to the latest version of PvPGN or use an older version of this script.');
define('__NOTFILE',     'server.dat doesn\'t exist or you entered the wrong path to it.');

// ------------------------------------------------------------------------------------------ //
//                                                                                            //
//               Configuration finished, no need to change anything below here                //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

function process_bnmotd($bnmotd, $fp) {
	$bnmotd = str_replace("%v",$fp['STATUS']['Version'],$bnmotd);
	$bnmotd = str_replace("%t",$fp['STATUS']['Uptime'],$bnmotd);
	$bnmotd = str_replace("%g",$fp['STATUS']['Games'],$bnmotd);
	$bnmotd = str_replace("%u",$fp['STATUS']['Users'],$bnmotd);
	$bnmotd = str_replace("%c",$fp['STATUS']['Channels'],$bnmotd);
	$bnmotd = str_replace("%a",$fp['STATUS']['UserAccounts'],$bnmotd);
	return $bnmotd;
}

function versioncheck($requiredversion, $actualversion) {
	if (!$actualversion) {
		$pass_vcheck = 0;
	} else {
		$reqver = array();
		$actualver = array();
		$reqver[1] = substr($requiredversion, 2, 1);
		$actualver[1] = substr($actualversion, 2, 1);
		$reqver[2] = substr($requiredversion, 4, 1);
		$actualver[2] = substr($actualversion, 4, 1);
		if ($reqver[1] < $actualver[1]) {
			$pass_vcheck = 1;
		} else {
			if ($reqver[1] === $actualver[1]) {
				if ($reqver[2] === $actualver[2] || $reqver[2] < $actualver[2]) {
					$pass_vcheck = 1;
				} else {
					$pass_vcheck = 0;
				}
			} else {
				$pass_vcheck = 0;
			}
		}
	}
	return $pass_vcheck;
}

function status_parse_ini($filename) {
	$ini_array = array();
	$sec_name = "";
	$lines = file($filename);
	foreach($lines as $line) {
		$line = trim($line);
		if($line == "") {
			continue;
		}
		if($line[0] == "[" && $line[strlen($line) - 1] == "]") {
			$sec_name = substr($line, 1, strlen($line) - 2);
		} else {
			$pos = strpos($line, "=");
			$property = substr($line, 0, $pos);
			$value = substr($line, $pos + 1);
			$ini_array[$sec_name][$property] = $value;
		}
	}
	return $ini_array;
}

function online_status($use_ps, $ip, $bnetdport, $d2csport, $d2dbsport, $user, $pvpgn, $d2realm) {
	$status = array();
	if ($use_ps == "yes") {
		if ($pvpgn == "yes") {
			if (exec("ps -ax -U " . $user . " | grep bnetd") <> "" ) {
				$status['bnetd'] = 1;
			} else {
				$status['bnetd'] = 0;
		}
		if ($d2realm == "yes") {
		}
			if (exec("ps -ax -U " . $user . " | grep d2cs") <> "") {
				$status['d2cs'] = 1;
			} else {
				$status['d2cs'] = 0;
			}
			if (exec("ps -ax -U " . $user . " | grep d2dbs") <> "") {
				$status['d2dbs'] = 1;
			} else {
				$status['d2dbs'] = 0;
			}
		}
	} else {
		if ($pvpgn == "yes" && $d2realm == "yes") {
			$ports = array("bnetd" => $bnetdport, "d2cs" => $d2csport, "d2dbs" => $d2dbsport);
		}
		if ($pvpgn == "yes" && $d2realm <> "yes") {
			$ports = array("bnetd" => $bnetdport);
		}
		if ($pvpgn <> "yes" && $d2realm == "yes") {
			$ports = array("d2cs" => $d2csport, "d2dbs" => $d2dbsport);
		}
		foreach($ports as $server => $port) {
			if($fp = @fsockopen($ip, $port, $errno, $errstr, 1) == false) {
				$status[$server] = 0;
			} else {
				$status[$server] = 1;
			}
		}		
	}
	return $status;
}
function parse_stats($fp, $list_channels, $list_users, $list_games, $profilelink, $profileurl, $gameicon, $iconurl, $num_users, $num_games, $num_channels, $num_useraccounts, $version, $uptime, $sidebyside)
{							
	if ($sidebyside === "yes") {
		$gameicon = "no";
	}
	
	$output = array(0 => "", 1 => "");
	
	$output[0] .= "      <table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\r\n";
	if ($version === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __VERSION . "</b> " . $fp['STATUS']['Version'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	if ($uptime === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __UPTIME . "</b> " . $fp['STATUS']['Uptime'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	if ($num_users === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __USERS . "</b> " . $fp['STATUS']['Users'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	if ($num_games === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __GAMES . "</b> " . $fp['STATUS']['Games'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	if ($num_channels === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __CHANNELS . "</b> " . $fp['STATUS']['Channels'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	if ($num_useraccounts === "yes") {
		$output[0] .= "        <tr>\r\n";
		$output[0] .= "          <td><b>" . __USERACCOUNTS . "</b> " . $fp['STATUS']['UserAccounts'] . "</td>\r\n";
		$output[0] .= "        </tr>\r\n";
	}
	$output[0] .= "        <tr height=\"5\">\r\n";
	$output[0] .= "          <td>&nbsp;</td>\r\n";
	$output[0] .= "        </tr>\r\n";
	$output[0] .= "      </table>\r\n";
	
	if($list_users == "yes")
	{		
		$output[1] .= "      <table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\r\n";
		$output[1] .= "        <tr>\r\n";
		$output[1] .= "          <td colspan=\"2\"><b>" . __USERSONSERV . "</b></td>\r\n";
		$output[1] .= "        </tr>\r\n";
	
		if(empty($fp['USERS']) || !isset($fp['USERS']))
			{
				$output[1] .= "        <tr>\r\n";
				$output[1] .= "          <td colspan=\"2\">" . __NOUSERS . "</td>\r\n";
				$output[1] .= "        </tr>\r\n";
			} else {
				if ($sidebyside === "yes") {
					$output[1] .= "          <td>";
				}
				$counter = 0;
				foreach($fp['USERS'] as $user) {
					$counter++;
					$pos = strpos($user, ",");
					$clienttag = substr($user, 0, $pos);
					$username = substr($user, $pos + 1);				
					if ($gameicon === "yes") {
						if ($profilelink === "yes" && $clienttag <> "CHAT") {
							$output[1] .= "        <tr>\r\n";
					    	$output[1] .= "          <td width=\"28\"><img src=\"" . $iconurl . "/" . $clienttag . ".jpg\" width=\"28\" height=\"14\"></td>\r\n";
					    	$output[1] .= "          <td width=\"99%\"><a href=\"" . $profileurl . "?game=" . $clienttag . "&user=" . $username . "\">" . $username . "</a></td>\r\n";
				  			$output[1] .= "        </tr>\r\n";
						} else {
							$output[1] .= "        <tr>\r\n";
					    	$output[1] .= "          <td width=\"28\"><img src=\"" . $iconurl . "/" . $clienttag . ".jpg\" width=\"28\" height=\"14\"></td>\r\n";
					    	$output[1] .= "          <td width=\"99%\">" . $username . "</td>\r\n";
				  			$output[1] .= "        </tr>\r\n";
						}
					} else {
						if ($profilelink === "yes" && $clienttag <> "CHAT") {
							if ($sidebyside === "yes") {
								$output[1] .= "<a href=\"" . $profileurl . "?game=" . $clienttag . "&user=" . $username . "\">" . $username . "</a>";
								if ($counter <> $fp['STATUS']['Users']) {
									$output[1] .= ", ";
								}
							} else {
								$output[1] .= "        <tr>\r\n          <td><a href=\"$profileurl?game=" . $clienttag . "&user=" . $username . "\">" . $username . "</a></td>\r\n        </tr>\r\n";
							}
						} else {
							if ($sidebyside === "yes") {
								$output[1] .= $username;
								if ($counter <> $fp['STATUS']['Users']) {
									$output[1] .= ", ";
								}
							} else {
								$output[1] .= "        <tr>\r\n          <td>" . $username . "</td>\r\n        </tr>\r\n";
							}
						}
					}
				}
				if ($sidebyside === "yes") {
					$output[1] .= "</td>\r\n";
				}
				$output[1] .= "        <tr>\r\n";
				$output[1] .= "          <td height=\"5\"></td>\r\n";
				$output[1] .= "        </tr>\r\n";
				$output[1] .= "      </table>\r\n";
	}
	if($list_games == "yes")
	{
		$output[1] .= "      <table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\r\n";
		$output[1] .= "        <tr>\r\n";
		$output[1] .= "          <td colspan=\"2\"><b>" . __GAMESONSERV . "</b></td>\r\n";
		$output[1] .= "        </tr>\r\n";
	
		if(empty($fp['GAMES']) || !isset($fp['GAMES']))
		{
			$output[1] .= "        <tr>\r\n";
			$output[1] .= "          <td colspan=\"2\">" . __NOGAMES . "</td>\r\n";
			$output[1] .= "        </tr>\r\n";
		} else {
			if ($sidebyside === "yes") {
				$output[1] .= "          <td>";
			}
			$counter = 0;
			foreach($fp['GAMES'] as $game)
			{
				$counter++;
				$pos = strpos($game, ",");
				$clienttag = substr($game, 0, $pos);
				$gamename = substr($game, $pos + 1);
				if ($gameicon === "yes") {				
					$output[1] .= "        <tr>\r\n";
				   	$output[1] .= "          <td width=\"28\"><img src=\"" . $iconurl . "/" . $clienttag . ".jpg\" width=\"28\" height=\"14\"></td>\r\n";
				   	$output[1] .= "          <td width=\"99%\">" . $gamename . "</td>\r\n";
			  		$output[1] .= "        </tr>\r\n";
				} else {
					if ($sidebyside === "yes") {
						$output[1] .= $gamename;
						if ($counter <> $fp['STATUS']['Games']) {
							$output[1] .= ", ";
						}
					} else {
					$output[1] .= "        <tr>\r\n";
					$output[1] .= "          <td>" . $gamename . "</td>\r\n";
					$output[1] .= "        </tr>\r\n";
					}
				}					
			}
			if ($sidebyside === "yes") {
				$output[1] .= "</td>\r\n";
			}
			$output[1] .= "        <tr>\r\n";
			$output[1] .= "          <td height=\"5\"></td>\r\n";
			$output[1] .= "        </tr>\r\n";
			$output[1] .= "      </table>\r\n";
		}
		}
	}
	if($list_channels == "yes")
	{
		$output[1] .= "      <table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\r\n";
		$output[1] .= "        <tr>\r\n";
		$output[1] .= "          <td><b>" . __CHANSONSERV . "</b></td>\r\n";
		$output[1] .= "        </tr>\r\n";
		
		if(empty($fp['CHANNELS']) || !isset($fp['CHANNELS']))
		{
			$output[1] .= "        <tr>\r\n";
			$output[1] .= "          <td>" . __NOCHANNELS . "</td>\r\n";
			$output[1] .= "        </tr>\r\n";
		}
		else
		{
			$counter = 0;
			if ($sidebyside === "yes") {
				$output[1] .= "          <td>";
			}
			foreach($fp['CHANNELS'] as $channel)
			{
				$counter++;
				if ($sidebyside === "yes") {
					$output[1] .= $channel;
					if ($counter <> $fp['STATUS']['Channels']) {
						$output[1] .= ", ";
				}
				} else {
					$output[1] .= "        <tr>\r\n";
					$output[1] .= "          <td>" . $channel . "</td>\r\n";
					$output[1] .= "        </tr>\r\n";
				}
			}
		if ($sidebyside === "yes") {
			$output[1] .= "</td>\r\n";
		}
		}
		$output[1] .= "      </table>\r\n";
	}
	return $output[0] . $output[1];
}

$content = "";
$motd = "";
$scriptversion = "v0.4";
$requiredversion = "1.6.3";

if($stats == "yes" && !file_exists($statsfile) || $stats == "yes" && !is_file($statsfile)) {
	$content = __NOTFILE;
	$motd = __NOTFILE;
} else {
	if ($stats == "yes") {
		$fp = status_parse_ini($statsfile, TRUE);
	} else {
		$fp['STATUS']['Version'] = $requiredversion;
	}
	if (versioncheck($requiredversion,$fp['STATUS']['Version']) === 0) {
		$content = __INCOMPATIBLE;
		$motd = __INCOMPATIBLE;
	} else {
		
		$onlinestatus = online_status($win32, $ip, $bnetdport, $d2csport, $d2dbsport, $user, $pvpgn, $d2realm);
		$content .= "      <table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\r\n";
		if ($pvpgn === "yes") {
			if ($onlinestatus['bnetd']) {
				$content .= "        <tr>\r\n";
				$content .= "          <td>" . __BNETDONLINE . "</td>\r\n";
				$content .= "        </tr>\r\n";
				$content .= "        <tr height=\"5\">\r\n";
	   			$content .= "          <td>&nbsp;</td>\r\n";
				$content .= "        </tr>\r\n";
			} else {
				$content .= "        <tr>\r\n";
				$content .= "          <td>" . __BNETDOFFLINE . "</td>\r\n";
				$content .= "        </tr>\r\n";
				$content .= "        <tr height=\"5\">\r\n";
			    $content .= "          <td>&nbsp;</td>\r\n";
				$content .= "        </tr>\r\n";
			}
		}
		if (0) {
			$closedrealm = 1;
		} else {
			$closedrealm = 0;
		}
//		}
		if ($d2realm === "yes") {
			if ($closedrealm) {
				$content .= "        <tr>\r\n";
				$content .= "          <td>" . __REALMONLINE . "</td>\r\n";
				$content .= "        </tr>\r\n";
				$content .= "        <tr height=\"5\">\r\n";
			    $content .= "          <td>&nbsp;</td>\r\n";
				$content .= "        </tr>\r\n";
			} else {
				$content .= "        <tr>\r\n";
				$content .= "          <td>" . __REALMOFFLINE . "</td>\r\n";
				$content .= "        </tr>\r\n";
				$content .= "        <tr height=\"5\">\r\n";
			    $content .= "          <td>&nbsp;</td>\r\n";
				$content .= "        </tr>\r\n";
			}
		}
		$content .= "      </table>\r\n";
		
		if ($onlinestatus['bnetd'] && $stats == "yes") {
			$content .= parse_stats($fp, $list_channels, $list_users, $list_games, $profilelink, $profileurl, $gameicon, $iconurl, $num_users, $num_games, $num_channels, $num_useraccounts, $version, $uptime, $sidebyside);
		}
		if ($stats == "yes") {
			if ($onlinestatus['bnetd']) {
				$motd = process_bnmotd($bnmotd, $fp);
			} else {
				$motd = $offlinemotd;
			}
		} else {
			$motd = "Server stats is not enabled";
		}
	}
}
define('__PVPGN_STATUS', $content);
define('__BNMOTD', $motd);
echo "<!-- This webpage uses the PvPGN Server Status Script " . $scriptversion . ". Copyright 2004 by U-238 -->\n";
?>
