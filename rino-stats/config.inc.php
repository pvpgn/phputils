<?php
// ----------------------------------------------------------------------
// Player -vs- Player Gaming Network Statistics System
// http://www.stormzone.ru/
// http://www.rino.com.co/
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
// Original author: jfro (imeepmeep@hotmail.com)
// Author from 2.3.20: Snaiperx (http://www.rino.com.co/)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------



// ---------------------------------------------------------------------------------
// Database & System Config settings
//
//      db_host:           MySQL Database Hostname
//      db_database:       MySQL Database Name
//      db_user:           MySQL Username
//      db_pass:           MySQL Password
//      db_record:         Name of the table with player records in your MySQL DB
//      db_bnet:           Name of the table with player info`s in your MySQL DB
//      db_profile:        Name of the table with player profile in your MySQL DB
//      db_teams:          Name of the table with team records in your MySQL DB
//      db_friend:         Name of the table with friends records in your MySQL DB
//      db_counters:       Name of the table with counter records in your MySQL DB
//      db_d2:             Name of the table with d2ladder records in your MySQL DB
//
// ---------------------------------------------------------------------------------

$db_host = "127.0.0.1";
$db_database = "PVPGN";
$db_user = "root";
$db_pass = "miguel";
$db_record = "Record";
$db_bnet = "BNET";
$db_profile = "profile";
$db_teams = "Team";
$db_friend = "friend";
$db_counters = "counters";
$db_d2 = "d2ladder";

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
$d2ladder_file = "f://pvpgn164/var/ladders/ladder.D2DV";
$d2update_time = "3600";
$stats_version = "2.3.20a-CVS-29.03.2004";

// ---------------------------------------------------------------------------------
// Administration Interface settings
//
//      max_rank:          Maximum rank number allowed on your server
//      site_user:         Your username to access admin interface
//      site_pass:         Your password to access admin interface, hashed with md5()
//      default_sort_by:   Can be auth_lock, auth_admin, uid or acct_username
//      default_sort_dir:  Can be DESC or ASC
//
// ---------------------------------------------------------------------------------

$max_rank = "1000";
$site_user = "admin";
$site_pass = "b6df9e9eaac595ad86025dad66a695a6";
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

?>