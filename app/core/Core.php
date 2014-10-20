<?php
class Core {
	
	public static $basename;
	private static $isInFolder;
	
	public function setBasename($basename) {
		Core::$basename = $basename;
	}
	
	public function setIsInfolder($par1booled) {
		Core::$isInFolder = $par1booled;
	}
	
	public static function sanitize_output($buffer) {
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
	    $replace = array('>','<','\\1');
    	$buffer = preg_replace($search, $replace, $buffer);
    	return $buffer;
	}
	
	public static function getURLData($id) {
		$server = $_SERVER["REQUEST_URI"];
		
		if(Core::$isInFolder) {
			$base_folder = "/" . Core::$basename;
			$ex = explode($base_folder, $server);
			$link_array = array_pop($ex);
			$data_array = explode("/", $link_array);
			$data = $data_array[$id];
			if($data != null || $data != "") {
				return $data;
			} else {
				return null;
			}
		} else {
			$data_array = explode("/", $server);
			$data = $data_array[$id];
			if($data != null || $data != "") {
				return $data;
			} else {
				return null;
			}
		}
	}
	
	public static function countURLData() {
		$server = $_SERVER["REQUEST_URI"];
		
		if(Core::$isInFolder) {
			$base_folder = Core::$basename;
			$e = explode($base_folder, $server);
			$link_array = array_pop($e);
			return substr_count($link_array, "/") + 1;
		} else {
			return substr_count($server, "/") + 1;
		}
	}
	
	public static function STRING_CONTAINS($string, $serach) {
		if(strpos($string, $serach) !== FALSE) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function CONTAINS_IN_URI($string) {
		if(Core::STRING_CONTAINS(strtolower($_SERVER["REQUEST_URI"]), strtolower($string))) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function HASH_DATA_TP1($data) {
		$hash_data = md5("ment_tes_" . $data);
		return $hash_data;
	}
	
	public static function HASH_DATA_TP2($data) {
		$token = "DF32as5d78";
		$hash_data = sha1(md5(sha1($token . $data)));
		$hash_data = substr($hash_data, 0, 32);
		return $hash_data;
	}
	
	public static function MYSQL_PROTECT($query) {
		return mysql_real_escape_string($query);
	}
}