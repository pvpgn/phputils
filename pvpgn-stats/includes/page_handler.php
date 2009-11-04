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

class page_handle {
	var $full_content;
	var $page_data;
	var $main_file;
	var $theme;

// ----------------------------------------------------------------------------------------------
// This is how we setup the page
// ----------------------------------------------------------------------------------------------

	function setup($theme,$main_file,$page_data) {
		$this->page_data = $page_data;
		$this->main_file = $main_file;
		$this->theme = $theme;
	}

// ----------------------------------------------------------------------------------------------
// This is how we fetch the content
// ----------------------------------------------------------------------------------------------

	function fetch() {
		return $this->full_content;	
	}

// ----------------------------------------------------------------------------------------------
// This is how we parse
// ----------------------------------------------------------------------------------------------

	function parse() {
		$fp = fopen("themes/".$this->theme."/".$this->main_file,"r");
		$main_content = fread($fp,filesize("themes/".$this->theme."/".$this->main_file));
		$done = false;
		do {
			$pos = strpos($main_content,"[[");
			$pos2 = strpos($main_content,"]]");
			$key = substr($main_content,$pos+2,$pos2-$pos-2);
			if(is_int($pos)&&is_int($pos2)) {
				if(is_array($this->page_data[$key])) {
					$main_content = str_replace("[[$key]]",$this->build_repeat($this->page_data[$key]),$main_content);
				}
				else {
					$main_content = str_replace("[[$key]]",$this->page_data[$key],$main_content);
				}
			}
			else
				$done = true;
		} while(!$done);
		$this->full_content = $main_content;
	}

// ----------------------------------------------------------------------------------------------
// This is how we build
// ----------------------------------------------------------------------------------------------

	function build_repeat($data) {
		$fp = fopen("themes/".$this->theme."/".$data['theme_file'],"r");
		$size = filesize("themes/".$this->theme."/".$data['theme_file']);
		$content = fread($fp,$size);
		for($n=0;$n<count($data)-1;$n++) {
			$temp = $content;
			$done = false;
			do {
				$pos = strpos($temp,"[[");
				$pos2 = strpos($temp,"]]");
				$key = substr($temp,$pos+2,$pos2-$pos-2);
				if(is_int($pos)&&is_int($pos2)) {
					$temp = str_replace("[[".$key."]]",$data[$n][$key],$temp);
				}
				else
					$done = true;
			} while(!$done);
			$output .= $temp;
		}
		return $output;
	}
}

?>