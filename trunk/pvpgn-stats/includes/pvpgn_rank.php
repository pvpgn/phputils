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
// Author from 2.3.20: Snaiperx (http://www.rino.com.co/)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------

include_once("includes/db_handler.php");

class pvpgn_rank {
	var $db;

// ----------------------------------------------------------------------------------------------
// Defines connection to DB
// ----------------------------------------------------------------------------------------------

	function pvpgn_rank() {
		global $db_host,$db_user,$db_pass,$db_database;
		$this->db = new db_handle();
		$this->db->db_connect($db_host,$db_user,$db_pass,$db_database);
	}

// ----------------------------------------------------------------------------------------------
// This is how we update ranks in the DB
// ----------------------------------------------------------------------------------------------

	function update_ranks($game,$type) {
		global $db_record,$max_rank,$db_d2;
		if(strstr($game,"WAR3" || strstr($game,"W3XP"))) {
			if($type == "0")
				$type = $game."_".$type;
			$query = "SELECT ".$type."_xp,uid FROM `$db_record` WHERE not (`".$type."_xp`= 0) AND uid != 0 ORDER BY ".$type."_xp DESC LIMIT $max_rank";
			$users = $this->db->db_query_fetch($query);
			for($n=1;$n<count($users)+1;$n++) {
				if($users[$n-1]['uid'] != 0) {
					$query = "UPDATE `$db_record`	SET `".$type."_rank`=$n WHERE `uid`=".$users[$n-1]['uid'];
					$this->db->db_query($query);
				}
			}
		}
		else if(strstr($game,"SEXP") || strstr($game,"STAR") || strstr($game,"W2BN")) {
			if($type == "0") {
				$type = $game."_".$type;
				$query = "SELECT ".$type."_wins,uid FROM `$db_record` WHERE not(`".$type."_wins` is null) AND uid != 0 ORDER BY ".$type."_wins DESC LIMIT $max_rank";
				$users = $this->db->db_query_fetch($query);
				for($n=1;$n<count($users)+1;$n++) {
					if($users[$n-1]['uid'] != 0) {
						$query = "UPDATE `$db_record`	SET `".$type."_rank`=$n WHERE `uid`=".$users[$n-1]['uid'];
						$this->db->db_query($query);
					}
				}
			}	
		}
		else if(strstr($game,"DRTL")) {
			if($type == "0") {
				$type = $game."_".$type;
				$query = "SELECT ".$type."_level,uid FROM `$db_record` WHERE not(`".$type."_level` is null) AND uid != 0 ORDER BY ".$type."_level DESC LIMIT $max_rank";
				$users = $this->db->db_query_fetch($query);
				for($n=1;$n<count($users)+1;$n++) {
					if($users[$n-1]['uid'] != 0) {
						$query = "UPDATE `$db_record`	SET `".$type."_rank`=$n WHERE `uid`=".$users[$n-1]['uid'];
						$this->db->db_query($query);
					}
				}
			}
		}
		else if(strstr($game,"D2DV") || strstr($game,"D2XP")) {
			$query = "SELECT experience,charname FROM `$db_d2` WHERE `game`='$game' AND `type`='$type' ORDER BY experience DESC LIMIT $max_rank";
			$users = $this->db->db_query_fetch($query);
			for($n=1;$n<count($users)+1;$n++) {
				$query = "UPDATE `$db_d2`	SET `rank`=$n WHERE `charname`='".$users[$n-1]['charname']."'";
				$this->db->db_query($query);
			}
		}
	}
}

?>