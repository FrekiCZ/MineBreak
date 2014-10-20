<?php
class Page {
	
	private $page;
	private $login_response;
	
	public function __construct($page) {
		$this->page = file_get_contents(ABS_PATH . "app/themes/" . MBCORE_THEME . "/" . $page . ".html");
		$this->catchUserLogin();
	}
	
	public function run() {
		$response = "<p class=\"red\">" . $this->login_response . "</p>";
		$this->page = str_replace("{MB_PAGE_LOGIN_RESPONSE}", $response, $this->page);
		return $this->page;
	}
	
	public function catchUserLogin() {
		if(isset($_POST["login"])) {
			$username = Core::MYSQL_PROTECT($_POST["username"]);
			$password = Core::MYSQL_PROTECT($_POST["password"]);
			
			if(!empty($username)) {
				if(!empty($password)) {
					$password = Core::HASH_DATA_TP2($password);
					$user_query = mysql_query("SELECT * FROM `mb_users` WHERE `username`='" . $username . "' AND `password`='" . $password . "'");
					if(mysql_num_rows($user_query)) {
						$user_row = mysql_fetch_array($user_query);
						$user_id = $user_row["id"];
						$hashed_id = Core::HASH_DATA_TP2($user_id);
						$_SESSION["mb_user"] = $hashed_id;
						
						$is_user_exist_in_session = mysql_query("SELECT * FROM `mb_sessions` WHERE `user_id`='" . $user_id . "'");
						if(!mysql_num_rows($is_user_exist_in_session)) {
							mysql_query("INSERT INTO `mb_sessions` values('', '" . $hashed_id . "', '" . $user_id . "', '0000-00-00 00:00:00')");
						}
						
						header("Location: ./");
					} else {
						$this->login_response = "Chybně zadané jméno nebo heslo !";
					}
				} else {
					$this->login_response = "Musíte zadat heslo !";
				}
			} else {
				$this->login_response = "Musíte zadat jméno !";
			}
		}
	}
	
}