<?php
class Page {
	
	private $page;
	private $user_format;
	private $alt_active = true;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/articles.html"));
		$this->user_format = Templating::getContentByID($this->page, "MB_ADMIN_USER");
		$this->page = str_replace($this->user_format, "", $this->page);
		$this->page = str_replace(array("{MB_ADMIN_USER}", "{/MB_ADMIN_USER}"), "", $this->page);
		//$this->handleForm();
	}
	
	public function run() {
		$content = "";
		
		$users_query = mysql_query("SELECT * FROM `mb_users` ORDER by id DESC");
		
		while($row = mysql_fetch_array($users_query)) {
			$content .= $this->setContentToUser($row["id"], $row["username"], $row["register_date"], $row["permission"]);
		}
		
		$this->page = str_replace("{MB_ADMIN_USERS}", $content, $this->page);
		return $this->page;
	}
	
	private function setContentToUser($user_id, $username, $register_date, $permissions) {
		$data_content = $this->user_format;
		$per_tex = $permissions > 0 ? "Admin" : "Uživatel";
		$content = str_replace(array(
			"{MB_ADMIN_AC_ID}",
			"{MB_ADMIN_USERNAME}",
			"{MB_ADMIN_REGISTER_DATE}",
			"{MB_ADMIN_AC_PERMISSION}"
		), array(
			$user_id,
			$username,
			date("Y d.m H:i:s", $register_date),
			$per_tex
		), $data_content);
		if($this->alt_active) {
			$content = str_replace("{ALT}", "alt", $content);
			$this->alt_active = false;
		} else {
			$content = str_replace("{ALT}", "", $content);
			$this->alt_active = true;
		}
		return $content;
	}
	
}