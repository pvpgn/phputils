##
## Table structure for table 'd2ladder'
##


--%PREFIX%-- The same prefix must be set in config.inc.php


CREATE TABLE `--%PREFIX%--d2ladder` (
  `charname` varchar(16) NOT NULL default '',
  `title` varchar(16) default NULL,
  `level` int(4) default '1',
  `class` varchar(10) default NULL,
  `experience` float(8,0) default NULL,
  `rank` int(11) default NULL,
  `type` char(2) default 'SC',
  `dead` varchar(5) default 'ALIVE',
  `game` varchar(4) NOT NULL default '',
  PRIMARY KEY  (`charname`),
  KEY `experience` (`experience`)
) TYPE=MyISAM;

CREATE TABLE `PvPGN`.`counters` (
  `d2ladder_time` int( 11 ) NOT NULL default '0'
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

##
## Table change for table 'Record'
##

ALTER TABLE --%PREFIF%--Record ADD `SEXP_0_rank` INT DEFAULT '0' NOT NULL;
ALTER TABLE --%PREFIF%--Record ADD `STAR_0_rank` INT DEFAULT '0' NOT NULL;
ALTER TABLE --%PREFIF%--Record ADD `W2BN_0_rank` INT DEFAULT '0' NOT NULL;
ALTER TABLE --%PREFIF%--Record ADD `DRTL_0_rank` INT DEFAULT '0' NOT NULL;
