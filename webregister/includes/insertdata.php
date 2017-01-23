<?php
function InsertData($data,$table) {
	unset($keys, $values);
	foreach($data as $key => $val) {
//		echo "Key: " . $key . ", Value: " . $val . "<br>";
		if (isset($keys)) {
			$keys .= ",`" . $key . "`";
			$values .= ",'" . $val . "'";
		} else {
			$keys = "`" . $key . "`";
			$values = "'" . $val . "'";
		}
	}
	if (@mysql_query("INSERT INTO `" . $table . "`(" . $keys . ") VALUES(" . $values . ")")) {
		return true;
	} else {
		error(1,__DBINSERTERROR,mysql_error());
	}
}
?>