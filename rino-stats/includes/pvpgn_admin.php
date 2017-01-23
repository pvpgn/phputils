<?php
// ----------------------------------------------------------------------
// Player -vs- Player Gaming Network Statistics System
// http://www.stormzone.ru/
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
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------

include_once("includes/db_handler.php");

class pvpgn_admin {
	var $db;

// ----------------------------------------------------------------------------------------------
// Defines connection to DB
// ----------------------------------------------------------------------------------------------

	function pvpgn_admin() {
		global $db_host,$db_user,$db_pass,$db_database;
		$this->db = new db_handle();
		$this->db->db_connect($db_host,$db_user,$db_pass,$db_database);
		
	}

// ----------------------------------------------------------------------------------------------
// This is how we grab users from DB
// ----------------------------------------------------------------------------------------------

	function get_users($start,$stop,$sort_by,$sort_dir) {
		global $db_bnet;
		$lock = array("true"=>"checked=\"checked\"","false"=>"",""=>"");
		$query = "SELECT acct_username,uid,auth_lockk,auth_operator,auth_admin FROM $db_bnet WHERE uid != 0 ORDER BY $sort_by $sort_dir LIMIT $start,$stop";
		$result = $this->db->db_query($query);
		if($result) {
			$n=0;
			while($row = $this->db->db_fetch_array($result)) {
				$return[$n] = $row;
				$return[$n]['lock'] = $lock[$row['auth_lockk']];
				$return[$n]['operator'] = $lock[$row['auth_operator']];
				$return[$n]['admin'] = $lock[$row['auth_admin']];
				$n++;
			}
		}
		else
			$return = array();
		return $return;
	}

// ----------------------------------------------------------------------------------------------
// This is how we search for certain user(s)
// ----------------------------------------------------------------------------------------------

	function user_search($user_name,$exact=true) {
		global $db_bnet;
		$lock = array("true"=>"checked=\"checked\"","false"=>"",""=>"");
		$query = "SELECT acct_username,uid,auth_lockk,auth_operator,auth_admin FROM $db_bnet WHERE `acct_username`";
		if($exact)
			$query .= " LIKE '$user_name'";
		else
			$query .= " LIKE '%$user_name%'";
		$query .= " ORDER BY acct_username";
		$result = $this->db->db_query($query);
		$n=0;
		if($result) {
			while($row = $this->db->db_fetch_array($result)) {
				$return[] = $row;
				$return[$n]['lock'] = $lock[$row['auth_lockk']];
				$return[$n]['operator'] = $lock[$row['auth_operator']];
				$return[$n]['admin'] = $lock[$row['auth_admin']];
				$n++;
			}
		}
		else
			$return = array();
		return $return;
		
	}

// ----------------------------------------------------------------------------------------------
// This is how we count number of users
// ----------------------------------------------------------------------------------------------

	function num_of_users() {
		global $db_bnet;
		$query = "SELECT COUNT(*) FROM $db_bnet";
		$result = $this->db->db_query($query);
		if($result)
			list($count) = $this->db->db_fetch_array($result);
		return $count;	
	}

// ----------------------------------------------------------------------------------------------
// This is how we delete user account
// ----------------------------------------------------------------------------------------------

	function user_delete($user_id) {
		global $db_friend,$db_teams,$db_bnet,$db_record,$db_profile;
		$query[0] = "DELETE FROM $db_friend WHERE uid = $user_id";
		$query[1] = "DELETE FROM $db_teams WHERE uid = $user_id";
		$query[2] = "DELETE FROM $db_bnet WHERE uid = $user_id";
		$query[3] = "DELETE FROM $db_record WHERE uid = $user_id";
		$query[4] = "DELETE FROM $db_profile WHERE uid = $user_id";
		//foreach($query as $q)
		for($q=0;$q<=4;$q++)
		$this->db->db_query($query[$q]);
		
			
			
			
	}

// ----------------------------------------------------------------------------------------------
// This is how we lock user account
// ----------------------------------------------------------------------------------------------

	function user_lock($user_id) {
		global $db_bnet;
		$query = "UPDATE $db_bnet SET `auth_lockk`='true' WHERE `uid`=$user_id";
		$this->db->db_query($query);
	}

// ----------------------------------------------------------------------------------------------
// This is how we unlock user account
// ----------------------------------------------------------------------------------------------

	function user_unlock($user_id) {
		global $db_bnet;
		$query = "UPDATE $db_bnet SET `auth_lockk`='false' WHERE `uid`=$user_id";
		$this->db->db_query($query);
	}

// ----------------------------------------------------------------------------------------------
// This is how we make user channel operator
// ----------------------------------------------------------------------------------------------

	function user_operator($user_id,$operator) {
		global $db_bnet;
		$query = "UPDATE $db_bnet SET `auth_operator`='$operator' WHERE `uid`=$user_id";
		$this->db->db_query($query);
	}

// ----------------------------------------------------------------------------------------------
// This is how we make user admin
// ----------------------------------------------------------------------------------------------

	function user_admin($user_id,$admin) {
		global $db_bnet;
		$query = "UPDATE $db_bnet SET `auth_admin`='$admin' WHERE `uid`=$user_id";
		$this->db->db_query($query);
	}
}

?>