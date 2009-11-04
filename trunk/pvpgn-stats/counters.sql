CREATE TABLE `counters` (
 `max_uid` int(11) NOT NULL default '0',
 PRIMARY KEY  (`max_uid`)
) TYPE=MyISAM;

ALTER TABLE `counters` ADD `d2ladder_time` INT DEFAULT '0' NOT NULL;
