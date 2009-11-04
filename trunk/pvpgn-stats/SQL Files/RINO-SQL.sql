# MySQL-Front Dump 2.5
#
# Host: localhost   Database: pvpgn
# --------------------------------------------------------
# Server version 4.0.15-nt


#
# Table structure for table 'arrangedteam'
#

CREATE TABLE arrangedteam (
  teamid int(11) NOT NULL default '0',
  size int(11) default '0',
  clienttag varchar(8) default NULL,
  lastgame int(11) default '0',
  member1 int(11) default '0',
  member2 int(11) default '0',
  member3 int(11) default '0',
  member4 int(11) default '0',
  wins int(11) default '0',
  losses int(11) default '0',
  xp int(11) default '0',
  level int(11) default '0',
  rank int(11) default '0',
  PRIMARY KEY  (teamid)
) TYPE=MyISAM;



#
# Dumping data for table 'arrangedteam'
#

INSERT INTO arrangedteam VALUES("0", "0", NULL, "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");


#
# Table structure for table 'bnet'
#

CREATE TABLE bnet (
  uid int(11) NOT NULL default '0',
  acct_username varchar(128) default NULL,
  acct_userid varchar(128) default NULL,
  acct_passhash1 varchar(128) default NULL,
  flags_initial varchar(128) default NULL,
  auth_admin varchar(128) default 'false',
  auth_normallogin varchar(128) default NULL,
  auth_changepass varchar(128) default NULL,
  auth_changeprofile varchar(128) default NULL,
  auth_botlogin varchar(128) default 'true',
  auth_operator varchar(128) default NULL,
  new_at_team_flag varchar(128) default '0',
  auth_lockk varchar(128) default '0',
  auth_command_groups varchar(128) NOT NULL default '1',
  acct_lastlogin_owner varchar(128) default NULL,
  acct_lastlogin_time varchar(128) default NULL,
  acct_lastlogin_clientver varchar(128) default NULL,
  acct_lastlogin_clienttag varchar(128) default NULL,
  acct_lastlogin_clientexe varchar(128) default NULL,
  acct_lastlogin_connection varchar(128) default NULL,
  acct_firstlogin_owner varchar(128) default NULL,
  acct_firstlogin_clientver varchar(128) default NULL,
  acct_firstlogin_clienttag varchar(128) default NULL,
  acct_firstlogin_clientexe varchar(128) default NULL,
  acct_firstlogin_connection varchar(128) default NULL,
  acct_firstlogin_time varchar(128) default NULL,
  acct_email varchar(128) default NULL,
  acct_lastlogin_host varchar(128) default NULL,
  current_at_team varchar(128) default NULL,
  auth_announce varchar(128) default NULL,
  acct_lastlogin_ip varchar(32) default NULL,
  auth_operator_Warcraft_3_Frozen_Throne varchar(128) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'bnet'
#

INSERT INTO bnet VALUES("0", NULL, NULL, NULL, NULL, "false", NULL, NULL, NULL, "true", NULL, "0", "0", "1", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


#
# Table structure for table 'clan'
#

CREATE TABLE clan (
  cid int(11) NOT NULL default '0',
  short int(11) NOT NULL default '0',
  name varchar(30) default NULL,
  motd varchar(30) default NULL,
  creation_time int(11) NOT NULL default '0',
  PRIMARY KEY  (cid)
) TYPE=MyISAM;



#
# Dumping data for table 'clan'
#

INSERT INTO clan VALUES("0", "0", NULL, NULL, "0");


#
# Table structure for table 'clanmember'
#

CREATE TABLE clanmember (
  cid int(11) NOT NULL default '0',
  uid int(11) NOT NULL default '0',
  status int(11) NOT NULL default '0',
  join_time int(11) NOT NULL default '0',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'clanmember'
#

INSERT INTO clanmember VALUES("0", "0", "0", "0");


#
# Table structure for table 'counters'
#

CREATE TABLE counters (
  d2ladder_time int(11) NOT NULL default '0',
  max_uid int(11) NOT NULL default '0',
  PRIMARY KEY  (max_uid)
) TYPE=MyISAM;



#
# Dumping data for table 'counters'
#



#
# Table structure for table 'd2ladder'
#

CREATE TABLE d2ladder (
  charname varchar(16) NOT NULL default '',
  title varchar(16) default NULL,
  level int(4) default '1',
  class varchar(10) default NULL,
  experience float(8,0) default NULL,
  rank int(11) default NULL,
  type char(2) default 'SC',
  dead varchar(5) default 'ALIVE',
  game varchar(4) NOT NULL default '',
  PRIMARY KEY  (charname),
  KEY experience (experience)
) TYPE=MyISAM;



#
# Dumping data for table 'd2ladder'
#

INSERT INTO d2ladder VALUES("", "", NULL, "", NULL, NULL, "", "", "");


#
# Table structure for table 'friend'
#

CREATE TABLE friend (
  uid int(11) NOT NULL default '0',
  0_name varchar(128) default NULL,
  1_name varchar(128) default NULL,
  count varchar(128) default NULL,
  2_name varchar(128) default NULL,
  1_uid varchar(128) default NULL,
  0_uid varchar(128) default NULL,
  2_uid varchar(128) default NULL,
  3_uid varchar(128) default NULL,
  4_uid varchar(128) default NULL,
  5_uid varchar(128) default NULL,
  6_uid varchar(128) default NULL,
  7_uid varchar(128) default NULL,
  8_uid varchar(128) default NULL,
  9_uid varchar(128) default NULL,
  10_uid varchar(128) default NULL,
  11_uid varchar(128) default NULL,
  12_uid varchar(128) default NULL,
  13_uid varchar(128) default NULL,
  14_uid varchar(128) default NULL,
  16_uid varchar(128) default NULL,
  15_uid varchar(128) default NULL,
  17_uid varchar(128) default NULL,
  19_uid varchar(128) default NULL,
  18_uid varchar(128) default NULL,
  20_uid varchar(128) default NULL,
  21_uid varchar(128) default NULL,
  23_uid varchar(128) default NULL,
  22_uid varchar(128) default NULL,
  24_uid varchar(128) default NULL,
  26_uid varchar(128) default NULL,
  25_uid varchar(128) default NULL,
  27_uid varchar(128) default NULL,
  28_uid varchar(128) default NULL,
  29_uid varchar(128) default NULL,
  30_uid varchar(128) default NULL,
  32_uid varchar(128) default NULL,
  31_uid varchar(128) default NULL,
  33_uid varchar(128) default NULL,
  34_uid varchar(128) default NULL,
  35_uid varchar(128) default NULL,
  36_uid varchar(128) default NULL,
  38_uid varchar(128) default NULL,
  37_uid varchar(128) default NULL,
  39_uid varchar(128) default NULL,
  40_uid varchar(128) default NULL,
  41_uid varchar(128) default NULL,
  42_uid varchar(128) default NULL,
  43_uid varchar(128) default NULL,
  44_uid varchar(128) default NULL,
  45_uid varchar(128) default NULL,
  46_uid varchar(128) default NULL,
  47_uid varchar(128) default NULL,
  49_uid varchar(128) default NULL,
  48_uid varchar(128) default NULL,
  50_uid varchar(128) default NULL,
  51_uid varchar(128) default NULL,
  52_uid varchar(128) default NULL,
  53_uid varchar(128) default NULL,
  55_uid varchar(128) default NULL,
  54_uid varchar(128) default NULL,
  56_uid varchar(128) default NULL,
  57_uid varchar(128) default NULL,
  58_uid varchar(128) default NULL,
  59_uid varchar(128) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'friend'
#

INSERT INTO friend VALUES("0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


#
# Table structure for table 'profile'
#

CREATE TABLE profile (
  uid int(11) NOT NULL default '0',
  clanname varchar(128) default NULL,
  description varchar(128) default NULL,
  sex varchar(16) default NULL,
  location varchar(128) default NULL,
  age varchar(16) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'profile'
#

INSERT INTO profile VALUES("0", NULL, NULL, NULL, NULL, NULL);


#
# Table structure for table 'pvpgn'
#

CREATE TABLE pvpgn (
  name varchar(128) NOT NULL default '',
  value varchar(255) default NULL,
  PRIMARY KEY  (name)
) TYPE=MyISAM;



#
# Dumping data for table 'pvpgn'
#



#
# Table structure for table 'record'
#

CREATE TABLE record (
  uid int(11) NOT NULL default '0',
  WAR3_solo_xp int(11) default '0',
  WAR3_solo_level int(11) default '0',
  WAR3_solo_wins int(11) default '0',
  WAR3_solo_rank int(11) default '0',
  WAR3_solo_losses int(11) default '0',
  WAR3_team_xp int(11) default '0',
  WAR3_team_level int(11) default '0',
  WAR3_team_rank int(11) default '0',
  WAR3_team_wins int(11) default '0',
  WAR3_team_losses int(11) default '0',
  WAR3_ffa_xp int(11) default '0',
  WAR3_ffa_rank int(11) default '0',
  WAR3_ffa_level int(11) default '0',
  WAR3_ffa_wins int(11) default '0',
  WAR3_ffa_losses int(11) default '0',
  WAR3_orcs_wins int(11) default '0',
  WAR3_orcs_losses int(11) default '0',
  WAR3_humans_wins int(11) default '0',
  WAR3_humans_losses int(11) default '0',
  WAR3_undead_wins int(11) default '0',
  WAR3_undead_losses int(11) default '0',
  WAR3_nightelves_wins int(11) default '0',
  WAR3_nightelves_losses int(11) default '0',
  WAR3_random_wins int(11) default '0',
  WAR3_random_losses int(11) default '0',
  WAR3_teamcount int(11) default '0',
  W3XP_solo_xp int(11) default '0',
  W3XP_solo_level int(11) default '0',
  W3XP_solo_wins int(11) default '0',
  W3XP_solo_rank int(11) default '0',
  W3XP_solo_losses int(11) default '0',
  W3XP_team_xp int(11) default '0',
  W3XP_team_level int(11) default '0',
  W3XP_team_rank int(11) default '0',
  W3XP_team_wins int(11) default '0',
  W3XP_team_losses int(11) default '0',
  W3XP_ffa_xp int(11) default '0',
  W3XP_ffa_rank int(11) default '0',
  W3XP_ffa_level int(11) default '0',
  W3XP_ffa_wins int(11) default '0',
  W3XP_ffa_losses int(11) default '0',
  W3XP_orcs_wins int(11) default '0',
  W3XP_orcs_losses int(11) default '0',
  W3XP_humans_wins int(11) default '0',
  W3XP_humans_losses int(11) default '0',
  W3XP_undead_wins int(11) default '0',
  W3XP_undead_losses int(11) default '0',
  W3XP_nightelves_wins int(11) default '0',
  W3XP_nightelves_losses int(11) default '0',
  W3XP_random_wins int(11) default '0',
  W3XP_random_losses int(11) default '0',
  W3XP_teamcount int(11) default '0',
  W3XP_w3pgrace varchar(128) default NULL,
  W3XP_userselected_icon varchar(128) default NULL,
  WAR3_userselected_icon varchar(16) default NULL,
  STAR_0_wins int(11) default '0',
  STAR_0_losses int(11) default '0',
  STAR_0_disconnects int(11) default '0',
  STAR_1_wins int(11) default '0',
  STAR_1_losses int(11) default '0',
  STAR_1_disconnects int(11) default '0',
  STAR_0_last_game int(11) default '0',
  STAR_0_last_game_result varchar(128) default NULL,
  STAR_1_last_game int(11) default '0',
  STAR_1_last_game_result varchar(128) default NULL,
  STAR_1_rating int(11) default '0',
  STAR_1_high_rating int(11) default '0',
  STAR_1_rank int(11) default '0',
  STAR_1_high_rank int(11) default '0',
  SEXP_0_wins int(11) default '0',
  SEXP_0_losses int(11) default '0',
  SEXP_0_disconnects int(11) default '0',
  SEXP_1_wins int(11) default '0',
  SEXP_1_losses int(11) default '0',
  SEXP_1_disconnects int(11) default '0',
  SEXP_0_last_game int(11) default '0',
  SEXP_0_last_game_result varchar(128) default NULL,
  SEXP_1_last_game int(11) default '0',
  SEXP_1_last_game_result varchar(128) default NULL,
  SEXP_1_rating int(11) default '0',
  SEXP_1_high_rating int(11) default '0',
  SEXP_1_rank int(11) default '0',
  SEXP_1_high_rank int(11) default '0',
  WAR3_w3pgrace varchar(128) default NULL,
  STAR_0_draws varchar(128) default NULL,
  SEXP_0_draws varchar(128) default NULL,
  SEXP_0_rank int(11) default '0',
  STAR_0_rank int(11) default '0',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'record'
#

INSERT INTO record VALUES("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", NULL, NULL, NULL, "0", "0", "0", "0", "0", "0", "0", NULL, "0", NULL, "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", NULL, "0", NULL, "0", "0", "0", "0", NULL, NULL, NULL, "0", "0");


#
# Table structure for table 'team'
#

CREATE TABLE team (
  uid int(11) NOT NULL default '0',
  W3XP_1_teamsize varchar(128) default NULL,
  W3XP_1_teammembers varchar(128) default NULL,
  W3XP_0_rank varchar(128) default NULL,
  W3XP_1_teamxp varchar(128) default NULL,
  W3XP_1_teamlevel varchar(128) default NULL,
  W3XP_1_teamlosses varchar(128) default NULL,
  W3XP_1_teamwins varchar(128) default NULL,
  W3XP_3_teamsize varchar(128) default NULL,
  W3XP_3_teammembers varchar(128) default NULL,
  W3XP_2_teamsize varchar(128) default NULL,
  W3XP_2_teammembers varchar(128) default NULL,
  W3XP_3_teamlevel varchar(128) default NULL,
  W3XP_3_teamxp varchar(128) default NULL,
  W3XP_3_teamwins varchar(128) default NULL,
  W3XP_2_teamlevel varchar(128) default NULL,
  W3XP_2_teamxp varchar(128) default NULL,
  W3XP_2_teamlosses varchar(128) default NULL,
  W3XP_2_rank varchar(128) default NULL,
  W3XP_2_teamwins varchar(128) default NULL,
  W3XP_4_teamsize varchar(128) default NULL,
  W3XP_4_teammembers varchar(128) default NULL,
  W3XP_3_teamlosses varchar(128) default NULL,
  W3XP_4_teamlevel varchar(128) default NULL,
  W3XP_4_teamxp varchar(128) default NULL,
  W3XP_4_teamlosses varchar(128) default NULL,
  WAR3_1_teamsize varchar(128) default NULL,
  WAR3_1_teammembers varchar(128) default NULL,
  W3XP_5_teamsize varchar(128) default NULL,
  W3XP_5_teammembers varchar(128) default NULL,
  W3XP_6_teamsize varchar(128) default NULL,
  W3XP_6_teammembers varchar(128) default NULL,
  W3XP_5_teamlevel varchar(128) default NULL,
  W3XP_5_teamxp varchar(128) default NULL,
  W3XP_5_teamwins varchar(128) default NULL,
  W3XP_6_teamlevel varchar(128) default NULL,
  W3XP_6_teamxp varchar(128) default NULL,
  W3XP_6_teamwins varchar(128) default NULL,
  W3XP_7_teamsize varchar(128) default NULL,
  W3XP_7_teammembers varchar(128) default NULL,
  W3XP_8_teamsize varchar(128) default NULL,
  W3XP_8_teammembers varchar(128) default NULL,
  W3XP_9_teamlevel varchar(128) default NULL,
  W3XP_9_teamxp varchar(128) default NULL,
  W3XP_9_teamwins varchar(128) default NULL,
  W3XP_9_teammembers varchar(128) default NULL,
  W3XP_9_teamsize varchar(128) default NULL,
  W3XP_7_teamlevel varchar(128) default NULL,
  W3XP_7_teamxp varchar(128) default NULL,
  W3XP_7_teamlosses varchar(128) default NULL,
  W3XP_10_teamlevel varchar(128) default NULL,
  W3XP_10_teamxp varchar(128) default NULL,
  W3XP_10_teammembers varchar(128) default NULL,
  W3XP_10_teamwins varchar(128) default NULL,
  W3XP_10_teamsize varchar(128) default NULL,
  W3XP_8_teamlevel varchar(128) default NULL,
  W3XP_8_teamxp varchar(128) default NULL,
  W3XP_8_teamlosses varchar(128) default NULL,
  W3XP_9_teamlosses varchar(128) default NULL,
  W3XP_10_teamlosses varchar(128) default NULL,
  W3XP_11_teamsize varchar(128) default NULL,
  W3XP_11_teammembers varchar(128) default NULL,
  W3XP_12_teamsize varchar(128) default NULL,
  W3XP_12_teammembers varchar(128) default NULL,
  W3XP_11_teamlevel varchar(128) default NULL,
  W3XP_11_teamxp varchar(128) default NULL,
  W3XP_11_teamlosses varchar(128) default NULL,
  W3XP_12_teamlevel varchar(128) default NULL,
  W3XP_12_teamxp varchar(128) default NULL,
  W3XP_12_teamlosses varchar(128) default NULL,
  W3XP_1_rank varchar(128) default NULL,
  W3XP_4_teamwins varchar(128) default NULL,
  W3XP_5_teamlosses varchar(128) default NULL,
  W3XP_8_teamwins varchar(128) default NULL,
  W3XP_6_rank varchar(128) default NULL,
  W3XP_5_rank varchar(128) default NULL,
  W3XP_4_rank varchar(128) default NULL,
  W3XP_8_rank varchar(128) default NULL,
  W3XP_3_rank varchar(128) default NULL,
  W3XP_6_teamlosses varchar(128) default NULL,
  W3XP_12_teamwins varchar(128) default NULL,
  W3XP_14_teamsize varchar(128) default NULL,
  W3XP_14_teammembers varchar(128) default NULL,
  W3XP_14_teamlevel varchar(128) default NULL,
  W3XP_14_teamxp varchar(128) default NULL,
  W3XP_14_teamlosses varchar(128) default NULL,
  W3XP_14_teamwins varchar(128) default NULL,
  W3XP_16_teamsize varchar(128) default NULL,
  W3XP_16_teammembers varchar(128) default NULL,
  W3XP_16_teamlevel varchar(128) default NULL,
  W3XP_16_teamxp varchar(128) default NULL,
  W3XP_16_teamlosses varchar(128) default NULL,
  W3XP_16_teamwins varchar(128) default NULL,
  W3XP_18_teamsize varchar(128) default NULL,
  W3XP_18_teammembers varchar(128) default NULL,
  W3XP_18_teamlevel varchar(128) default NULL,
  W3XP_18_teamxp varchar(128) default NULL,
  W3XP_18_teamwins varchar(128) default NULL,
  W3XP_20_teamsize varchar(128) default NULL,
  W3XP_20_teammembers varchar(128) default NULL,
  W3XP_20_teamlevel varchar(128) default NULL,
  W3XP_20_teamxp varchar(128) default NULL,
  W3XP_20_teamlosses varchar(128) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;



#
# Dumping data for table 'team'
#

INSERT INTO team VALUES("0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
