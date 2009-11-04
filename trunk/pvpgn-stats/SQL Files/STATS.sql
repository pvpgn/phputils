#------------------------------------------------------
# Table structure PvPGN Statistics System v2.4.5
#------------------------------------------------------

#
# Table structure for table 'Record'
#

CREATE TABLE Record (
  uid int(11) NOT NULL default '0',
  SEXP_0_rank int(11) default '0',
  STAR_0_rank int(11) default '0',
  W2BN_0_rank int(11) default '0',
  DRTL_0_rank int(11) default '0',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;


#
# Dumping data for table 'Record'
#

INSERT INTO record VALUES("0", "0", "0", "0", "0");
