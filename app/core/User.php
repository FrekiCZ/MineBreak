<?php
class User {
	
	private static $is_User_Logged = false;
	private static $user_id;
	private static $user_data = array();
	private static $user_meta = array();
	
	public function __construct() {
		session_start();
	}
	
	public function init() {
		if(isset($_SESSION["mb_user"])) {
			$query = mysql_query("SELECT `id` FROM `mb_sessions` WHERE `hash`='" . $_SESSION["mb_user"] . "'");
			if(mysql_num_rows($query)) {
				
				$query_user_id = mysql_query("SELECT `user_id` FROM `mb_sessions` WHERE `hash`='" . Core::MYSQL_PROTECT($_SESSION["mb_user"]) . "'");
				$row_id = mysql_fetch_array($query_user_id);
				User::$user_id = $row_id["user_id"];
				
				$query_user = mysql_query("SELECT * FROM `mb_users` WHERE `id`='" . User::$user_id . "'");
				$row_user = mysql_fetch_array($query_user);
				User::$user_data["username"] = $row_user["username"];
				User::$user_data["display_name"] = $row_user["display_name"];
				User::$user_data["email"] = $row_user["email"];
				User::$user_data["register_date"] = $row_user["register_date"];
				User::$user_data["last_login"] = $row_user["last_login"];
				User::$user_data["permission"] = $row_user["permission"];
				User::$is_User_Logged = true;
				$this->initUserMeta();
			}
		}
	}
	
	private function initUserMeta() {
		$query = mysql_query("SELECT * FROM `hraci` WHERE `nick`='" . User::getUserData("username") . "'");
		$row = mysql_fetch_array($query);
		User::$user_meta = $row;
	}
	
	public static function isUserLogged() {
		return User::$is_User_Logged;
	}
	
	public static function getUserID() {
		if(User::$is_User_Logged) {
			return User::$user_id;
		} else {
			return 0;
		}
	}
	
	public static function isUserAdmin() {
		if(User::$is_User_Logged) {
			$per = User::getUserData("permission");
			if($per > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public static function getUserData($data) {
		if(User::$is_User_Logged) {
			return User::$user_data[$data];
		} else {
			return 0;
		}
	}
	
	public static function getUserMetaData($metadata) {
		if(User::$is_User_Logged) {
			return User::$user_meta[$metadata];
		} else {
			return 0;
		}
	}
	
	public static function getUsername($id) {
		$query = mysql_query("SELECT `username` FROM `mb_users` WHERE `id`='" . $id . "'");
		$row = mysql_fetch_array($query);
		return $row["username"];
	}
	
}