CREATE TABLE awaiting_activation (
  uid int(11) NOT NULL default '0',
  acct_username varchar(32) default NULL,
  acct_passhash1 varchar(128) default NULL,
  acct_email varchar(128) default NULL,
  webacct_creation_time int(11) default NULL,
  webacct_activation_code varchar(32) default NULL,
  webacct_lang char(2) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM;

INSERT INTO awaiting_activation VALUES (0, NULL, NULL, NULL, NULL, NULL, NULL);
