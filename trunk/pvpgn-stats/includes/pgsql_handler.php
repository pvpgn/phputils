<?php
// ----------------------------------------------------------------------
// Player -vs- Player Gaming Network Statistics System
// http://pvpgn.spfree.net/
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
// Author from 2.4.4: Pelish (pelish@gmail.com)
// Original author: jfro (imeepmeep@hotmail.com)
// Author from 2.3.20: Snaiperx (http://www.rino.com.co/)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------

class sql_handle {
	var $db_connection,$port;
// ----------------------------------------------------------------------------------------------
// This is how we connect to DB
// ----------------------------------------------------------------------------------------------

	function db_connect($db_hostname, $db_username, $db_password, $db_name)
	{ global $db_port;
		$this->db_connection = pg_connect("host=".$db_hostname." port=".$db_port." dbname=".$db_name." user=".$db_username." password=".$db_password) 
			OR die ("Connection Error to PostgreSQL Server");
		return $this->db_connection;
	}

// ----------------------------------------------------------------------------------------------
// This is how we get the number of rows in a database query result
// ----------------------------------------------------------------------------------------------

	function sql_num_rows($result) {
		return pg_num_rows($result);
	}

// ----------------------------------------------------------------------------------------------
// This is how we get the first row of a database query result
// ----------------------------------------------------------------------------------------------

	function sql_fetch_row($query) {
		return pg_fetch_row($query);
	}

// ----------------------------------------------------------------------------------------------
// This is how we get an associative result from query resources
// ----------------------------------------------------------------------------------------------

	function sql_fetch_assoc($result) {
		return pg_fetch_assoc($result);
	}

// ----------------------------------------------------------------------------------------------
// This is how we get queries from DB
// ----------------------------------------------------------------------------------------------

	function db_query($db_query) {
		$result = pg_query($this->db_connection,$db_query)
			or die("Query: $db_query  <br /> Error: ".pg_last_error($this->db_connection)."<br />");
		return $result;
	}

// ----------------------------------------------------------------------------------------------
// This is how we print DataBase errors
// ----------------------------------------------------------------------------------------------

	function print_db_error($string) {
		if($error_handle == "DIE") {
			die($string."<br />\n<strong>PostgreSQL Error:</strong>".pg_last_error($this->db_connection));
		}
		else if($error_handle == "PRINT") {
			print "<hr />".$string."<br />\n<strong>PostgreSQL Error:</strong>".pg_last_error($this->db_connection)."<hr />";
		}
	}

// ----------------------------------------------------------------------------------------------
// This is how we fetch DB from result
// ----------------------------------------------------------------------------------------------

	function db_fetch($db_result) {
		while($value = pg_fetch_assoc($db_result)) {
			$results[] = $value;
		}
		return $results;
	}

// ----------------------------------------------------------------------------------------------
// This is how we fetch DB from query (diffirent parsing method)
// Possibly in the future this will be removed to improve performance.
// ----------------------------------------------------------------------------------------------

	function db_query_fetch($query) {
		$result = pg_query($this->db_connection,$query) or $this->print_db_error("Failed to query Database<br />\nQuery: $query");
		if($result) {
			for($n=0;$row=pg_fetch_array($result);$n++) {
				$results[$n] = $row;
			}
		}
		else $results = array();
		return $results;
	}
// ----------------------------------------------------------------------------------------------
// This is how we disconnect from DB
// ----------------------------------------------------------------------------------------------

	function db_disconnect()
	{
		pg_close($this->db_connection);
	}

// ----------------------------------------------------------------------------------------------
// This is how we do search in DB
// ----------------------------------------------------------------------------------------------

	function db_search($value,$column,$column_want,$table) {
		$query = "SELECT $column_want FROM $table WHERE `$column` LIKE '$value'";
		$result = pg_query($this->db_connection,$query);
		while($entry = pg_fetch_assoc($result)) {
			$results[] = $entry;
		}
		return $results;
	}

}

?>