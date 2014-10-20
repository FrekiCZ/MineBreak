<?php
class Page {
	
	private $page;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/edit-article.html"));
	}
	
	public function run() {
		$this->formListener();
		$this->page = str_replace("{MB_ADMIN_PAGE_GALLERIE}", $this->gallerie(), $this->page);
		$this->page = str_replace("{MB_ADMIN_PAGE_GALLERIE_ALL}", $this->gallerie_all(), $this->page);
		
		$ac_id = Core::MYSQL_PROTECT($_GET["id"]);
		
		$row = mysql_fetch_array(mysql_query("SELECT * FROM `mb_articles` WHERE `id`='$ac_id'"));
		
		$row_prew_img = mysql_fetch_array(mysql_query("SELECT * FROM `mb_images` WHERE `id`='" . $row["prew_image_id"] . "'"));
		$prew_name = $row_prew_img["file_name"];
		
		$this->page = str_replace("{MB_ADMIN_AC_ID}", $row["id"], $this->page);
		$this->page = str_replace("{MB_ADMIN_AC_TITLE}", $row["head_title"], $this->page);
		$this->page = str_replace("{MB_ADMIN_AC_PREW_IMAGE_ID}", $row["prew_image_id"], $this->page);
		$this->page = str_replace("{MB_ADMIN_AC_PREW_IMAGE}", $prew_name, $this->page);
		$this->page = str_replace("{MB_ADMIN_AC_CONTENT}", $row["content"], $this->page);
		
		
		return $this->page;
	}
	
	private function gallerie_all() {
		$content = "";
		$query_gallery = mysql_query("SELECT * FROM `mb_images` ORDER by id DESC");
		while($row = mysql_fetch_array($query_gallery)) {
			if($row["type"] == "all") {
				$content .= "<a><img src=\"{ABS_PATH}mb-upload/resources/images/" . $row["file_name"] . "\" width=\"150px;\"></a>\r";
			}
		}
		return $content;
	}
	
	private function formListener() {
		if(isset($_POST["save"])) {
			if(!empty($_POST["article-title"])) {
				if(!empty($_POST["prew-image"])) {
					if(!empty($_POST["article-content"])) {
						$article_title = Core::MYSQL_PROTECT($_POST["article-title"]);
						$prew_image = Core::MYSQL_PROTECT($_POST["prew-image"]);
						$article_conetent = Core::MYSQL_PROTECT($_POST["article-content"]);
						$time = time();
						$user_id = User::getUserID();
						$article_id = $_POST["article-id"];
						
						mysql_query("UPDATE `mb_articles` SET `head_title`='$article_title', `content`='$article_conetent', `prew_image_id`='$prew_image' WHERE `id`='$article_id';");
						$this->setInfo(" - Článek byl upraven.");
					} else {
						$this->setWarning("");
					}
				} else {
					$this->setWarning("");
				}
			} else {
				$this->setWarning("");
			}
		} else {
			$this->setWarning("");
		}
	}
	
	private function gallerie() {
		$content = "";
		$query_gallery = mysql_query("SELECT * FROM `mb_images` ORDER by id DESC");
		while($row = mysql_fetch_array($query_gallery)) {
			if($row["type"] == "prew") {
				$content .= "<a onclick=\"setImage('" . $row["id"] . "', '" . $row["file_name"] . "');\"><img src=\"{ABS_PATH}mb-upload/resources/images/" . $row["file_name"] . "\" width=\"150\"></a>\r";
			}
			
		}
		return $content;
	}
	
	private function setInfo($message) {
		$this->page = str_replace("{MB_ADMIN_AC_INFO}", "<font color=\"green\">" . $message . "</font>", $this->page);
	}
	
	private function setWarning($message) {
		$this->page = str_replace("{MB_ADMIN_AC_INFO}", "<font color=\"red\">" . $message . "</font>", $this->page);
	}
	
}