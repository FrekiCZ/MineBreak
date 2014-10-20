<?php
class Page {
	
	private $page;
	private $article_format;
	private $alt_active = true;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/articles.html"));
		$this->article_format = Templating::getContentByID($this->page, "MB_ADMIN_ARTICLE");
		$this->page = str_replace($this->article_format, "", $this->page);
		$this->page = str_replace(array("{MB_ADMIN_ARTICLE}", "{/MB_ADMIN_ARTICLE}"), "", $this->page);
		$this->handleForm();
	}
	
	public function run() {
		$content = "";
		
		$articles_query = mysql_query("SELECT * FROM `mb_articles` ORDER by id DESC LIMIT 5");
		
		if(mysql_num_rows($articles_query)) {
			while($row = mysql_fetch_array($articles_query)) {
				$content .= $this->setContentToArticle($row["id"], $row["head_title"], User::getUsername($row["user_id"]), "0", $row["date"]);
			}
		}
		
		$this->page = str_replace("{MB_ADMIN_ARTICLES}", $content, $this->page);
		return $this->page;
	}
	
	
	
	private function setContentToArticle($article_id, $article_title, $publisher, $comments, $date) {
		$data_content = $this->article_format;
		$content = str_replace(array("{MB_ADMIN_AC_ID}", "{MB_ADMIN_AC_NAME}", "{MB_ADMIN_AC_PUBLISHER}", "{MB_ADMIN_AC_COMMENTS}", "{MB_ADMIN_AC_DATE}"), array($article_id, $article_title, $publisher, $comments, "Publikováno<br>" . date("m.d.Y", $date)), $data_content);
		if($this->alt_active) {
			$content = str_replace("{ALT}", "alt", $content);
			$this->alt_active = false;
		} else {
			$content = str_replace("{ALT}", "", $content);
			$this->alt_active = true;
		}
		return $content;
	}
	
	private function handleForm() {
		if(isset($_POST["article-remove"])) {
			$id = Core::MYSQL_PROTECT($_POST["article-remove"]);
			mysql_query("DELETE FROM `mb_articles` WHERE `id`='" . $id . "'");
		}
		
		if(isset($_POST["article-edit"])) {
			if(WEB_TYPE) {
				header("Location: /admin/edit-article?id=" . $_POST["article-edit"]);
			} else {
				header("Location: /" . Core::$basename . "/admin/edit-article?id=" . $_POST["article-edit"]);
			}
		}
		
	}
	
}