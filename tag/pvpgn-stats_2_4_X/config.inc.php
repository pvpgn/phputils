<?php

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

$db_host = "localhost";
$db_database = "PVPGNDB";
$db_user = "username";
$db_pass = "password";
$db_record = "Record";
$db_bnet = "BNET";
$db_profile = "profile";
$db_teams = "Team";
$db_friend = "friend";
$db_counters = "counters";
$db_d2 = "d2ladder";

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

$site_theme = "tanzania";
$page_max = "20";
$default_game = "W3XP";
$default_type = "solo";
$date_format = "l F j, Y G:i:s";
$d2ladder_file = "/usr/local/var/ladders/ladder.D2DV";
$d2update_time = "3600";
$stats_version = "2.3.20";

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

$max_rank = "100";
$site_user = "super_admin";
$site_pass = "cff2b9e18858bf1a0048b080a3a710a0";
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