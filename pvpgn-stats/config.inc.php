<?php
// ----------------------------------------------------------------------
// Player -vs- Player Gaming Network Statistics System
// http://pvpgn.spfree.net/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Author from 2.4.4: Pelish (pelish@gmail.com)
// Original author: jfro (imeepmeep@hotmail.com)
// Author from 2.3.20: Snaiperx (http://www.rino.com.co/)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------


// ---------------------------------------------------------------------------------
// Database & System Config settings - Key
//
//      db_type:           Database type (mysqli, mysql, pgsql, etc.)
//      db_host:           SQL Server Hostname or IP address
//      db_port:           SQL Server port
//      db_database:       SQL Database Name
//      db_user:           SQL Username
//      db_pass:           SQL Password
//      db_prefix          SQL Database Prefix
//      db_record:         Name of the table with player records in yourSQL DB
//      db_bnet:           Name of the table with player info`s in your SQL DB
//      db_profile:        Name of the table with player profile in your SQL DB
//      db_teams:          Name of the table with team records in your SQL DB
//      db_friend:         Name of the table with friends records in your SQL DB
//      db_counters:       Name of the table with counter records in your SQL DB
//      db_d2:             Name of the table with d2ladder records in your SQL DB
//
// *NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*
// *NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*
// (Provided my Gambit)
// For better support for everyone, I have added a central location to assign links for
// all PHP and HTML pages.  Now you don't have to scour HTML code for links/URL's to wrong domains.
// Assighn the values below to correct all links and refrences to your webpage.
//
//      (DO NOT UNCOMMENT, CHANGE BELOW UNDER "// System Config settings")
//      homepage           Full URL to your websites Home Page
//      ladderroot         Full URL to main stats page
//      (DO NOT UNCOMMENT, CHANGE BELOW UNDER "// System Config settings")
//
// *NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*
// *NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*NEW*

// System Config settings
$site_name = "PvPGN server";
$db_type = "mysql";
$db_host = "127.0.0.1";
$db_port = 3306; /* 3306 is the most common MySQL port */
$db_database = "PvPGN";
$db_user = "PvPGN";
$db_pass = "pvpgnp_password";
$db_prefix = "pvpgn_";
$db_record = $db_prefix."Record";
$db_bnet = $db_prefix."BNET";
$db_profile = $db_prefix."profile";
$db_teams = $db_prefix."team";
$db_friend = $db_prefix."friend";
$db_counters = $db_prefix."counters";
$db_d2 = $db_prefix."d2ladder";
$homepage = "http://www.myserver.net";
$ladderroot = "http://www.myserver.net/ladder/"; /* can also be something like "http://www.myserver.net/ladder/" */


$theme = "bnet";

$use_php_xslt = false; // only change this if you know you have xsltproc installed and not php-xslt
$xslt_command = "xsltproc"; // for when you don't have php4-xslt but have the xsltproc command or sabcmd

// set pvpgn_dir to where you pvpgn directory is, include trailing slash
$pvpgn_dir = "/usr/local/";
$ladders_dir = $pvpgn_dir."var/ladders/";

$w3ladder_xsl_file = getcwd()."/themes/$theme/w3ladder.xsl";
$d2ladder_xml_file = $ladders_dir."d2ladder.xml";
$d2ladder_xsl_file = getcwd()."/themes/$theme/d2ladder.xsl";
// ---------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------
// PvPGN variables settings
//
//     icon_levelx:          Wins required for TFT icon
//
// ---------------------------------------------------------------------------------

$icon_level1 = 25;
$icon_level2 = 50;
$icon_level3 = 100;
$icon_level4 = 200;
$icon_level5 = 500;

// ---------------------------------------------------------------------------------
// Page settings
//
//      site_theme:        Theme you want to run
//      page_max:          How many players you want to display on one page
//      default_game:      Defines stats for which game user will see on entering
//      default_type:      Defines which type of game user will see on entering
//      date_format:       Defines PHP date format used in stats displaying
//      d2ladder_file:     Path on your system which shows ladder.D2DV location
//      d2update_time:     Time to update your D2 DB (in seconds), 0 is off
//      stats_version:     Don't change, just for easier version display
//
// ---------------------------------------------------------------------------------

$site_theme = "bnet";
$page_max = "50";
$default_game = "W3XP";
$default_type = "solo";
$date_format = " F j - G:i";
$d2ladder_file = "/usr/local/var/ladders/ladder.D2DV";
$d2update_time = "3600";
$stats_version = "2.4.6";

// ---------------------------------------------------------------------------------
// Administration Interface settings
//
//      max_rank:          Maximum rank number allowed on your server
//      default_sort_by:   Can be auth_lock, auth_admin, uid or acct_username
//      default_sort_dir:  Can be DESC or ASC
//
// ---------------------------------------------------------------------------------

$max_rank = "1000";
$default_sort_by = "auth_admin";
$default_sort_dir = "DESC";


// ---------------------------------------------------------------------------------
// Optional User file settings (unfinished, doesn`t work)
//
//      pvpgn_users:       Path on your system which shows user dir location
//      use_files:         Defines whether we use files or database
//
// ---------------------------------------------------------------------------------

$pvpgn_users = "/usr/local/var/users";
$use_files = false;

// ---------------------------------------------------------------------------------
// END of conf file.
?>