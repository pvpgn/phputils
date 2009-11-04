##
## Table structure for table 'd2ladder'
##

CREATE TABLE `d2ladder` (
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
ALTER TABLE `counters` ADD `d2ladder_time` INT DEFAULT '0' NOT NULL;