<?php

// ---------------------------
// File: db_handler.php
// Description:
//    Database insertion/deletion/selecting/etc. handling class
//    This is organized to allow similar classes to be made for different database engines
// Created: 9/24/02
// Author: jerome
// ----------------------------

$error_handle = "DIE";  // how to handle mysql failtures, DIE to stop execution, or PRINT, to just print error and continue

class db_handle {
	var $db_connection;

	// ----------------------------------------
	// --- Connection & selection routines ----
	// ----------------------------------------
	
	function db_handle() {
		
	}
	
	function db_connect($host,$user,$pass,$db) { // connects & selects your specified database to start off
		$this->db_connection = mysql_connect($host,$user,$pass) or print_db_error("Failed to connect to database");
		mysql_select_db($db,$this->db_connection) or print_db_error("Failed to select database $db");
	}

	function db_change_db($db) { // changes database your working with
		mysql_select_db($db,$this->db_connection);
	}

	function db_disconnect() { // just disconnects the mysql connection...
		mysql_close($this->db_connection);
	}

	function is_connected() {
		if(isset($this->db_connection)) {
			return true;
		}
		else
			return false;
	}

	// ----------------------------------
	// --- Query & fetching routines ----
	// ----------------------------------
	function db_query($query) { // just queries the database and returns the mysql result resource
		$result = mysql_query($query,$this->db_connection) or print_db_error("Failed to query Database<br />\nQuery: $query");
		print mysql_error($this->db_connection);
		return $result;
	}

	function db_query_fetch($query) { // queries a database and returns the data in an array, rows starting at 0 and up, containign associative arrays of the row data.
		$result = mysql_query($query,$this->db_connection) or print_db_error("Failed to query Database<br />\nQuery: $query");
		if($result) {
			for($n=0;$row=mysql_fetch_array($result);$n++) {
				$results[$n] = $row;
			}
		}
		else
			$results = array();
		return $results;
	}

	function db_fetch_from_result($result) { // fetches the data into an array & returns it from a given mysql result resource
		for($n=0;$row=mysql_fetch_array($result);$n++) {
			$results[$n] = $row;
		}
		return $results;
	}

	function db_fetch_array($result) {	// just to keep with the database abstraction, if we just want to grab 1 row.
		if($result)
			return mysql_fetch_array($result);
		else
			return array();
	}

	function db_count_num_rows($result) { // take sa mysql result resource and returns the number of rows in it
		return mysql_num_rows($result);
	}

	function db_count_table_rows($table) { // counts number of rows in a table and returns it
		$query = "SELECT COUNT(*) FROM $table";
		$result = mysql_query($query,$this->db_connection) or print_db_error("Failed to query database on table: $table");
		$row = mysql_fetch_row($result);
		return $row[0];
	}

	function db_insert($table,$columns,$values) { // insertion routine, takes table & array of columns with values to go in them respectively
		$query = "INSERT INTO $table (`".$columns[0]."`";

		if(count($columns) == count($values)) {
			if(!is_array($columns)) {
				$columns = array($columns);
				$values = array($values);
			}
			$temp = "VALUES('".$values[0]."'";
			for($n=1;$n<count($columns);$n++) {
				$query .= ",`".$columns[$n]."`";
				$temp .= ",'".$values[$n]."'";
			}
			$query .= ") ".$temp.")";
			$this->db_query($query);
		}
		else {
			print_error("db_handler->db_insert: number of columns has to equal number of values");
		}
	}

	function db_delete($table,$columns,$values,$limit=NULL) { // deletes row(s) according to $columns[x]=$values[x] with a limit if specified
		$query = "DELETE FROM $table WHERE `".$columns[0]."`=";
		if(count($columns) == count($values)) {
			if(is_string($values[0]))
				$query .= "'".$values[0]."'";
			for($n=1;$n<count($columns);$n++) {
				$query .= " AND `".$columns[$n]."`=";
				if(is_string($values[$n]))			// we want '' around value if it's a string for most mysql servers
					$query .= "'".$values[$n]."'";
				else
					$query .= $values[$n];
			}
			if(($limit != NULL)&&(is_int($limit)))
				$query .= " LIMIT $limit";
			$this->db_query($query);
		}
		else
			print_error("db_handler->db_insert: number of columns has to equal number of values");
	}

}
	// ----------------------------------
	// --- Utility routines (private) ---
	// ----------------------------------
	function print_db_error($string) { // prints the mysql error and choice of text, and will die or just print depending on a variable.
		if($error_handle == "DIE") {
			die($string."<br />\n<strong>MySQL Error:</strong>".mysql_error($this->db_connection));
		}
		else if($error_handle == "PRINT") {
			print "<hr />".$string."<br />\n<strong>MySQL Error:</strong>".mysql_error($this->db_connection)."<hr />";
		}
	}

?>