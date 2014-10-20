<?php
class Page {
	
	private $page;
	private $article_content;
	private $article_ID;
	
	public function __construct($page) {
		preg_match_all('!\d+!', Core::getURLData(2), $matches);
		$this->article_ID = $matches[0][0];
		$this->page = file_get_contents(get_template_file("main-article.html"));
		$this->article_content = Templating::getContentByID($this->page, "MB_PAGE_ARTICLE");
		$this->page = str_replace($this->article_content, "", $this->page);
		$this->page = str_replace(array("{MB_PAGE_ARTICLE}", "{/MB_PAGE_ARTICLE}"), "", $this->page);
	}
	
	public function run() {
		$content = "";
		
		$articles_query = mysql_query("SELECT * FROM `mb_articles` WHERE `id`='" . $this->article_ID . "'");
		if(mysql_num_rows($articles_query)) {
			$row = mysql_fetch_array($articles_query);
			if($row["visibility"] == "true") {
				$content .= $this->setContentToArticle($row["up_title"], $row["head_title"], $row["icon_id"], $row["prew_image_id"], $row["content"]);
			} else {
				$content .= $this->setContentToArticle("Nedostupné", "Článek nelze zobrazit !", 1, "Buhužel tento článek je skrytý !");
			}
		}
		
		$this->page = str_replace("{MB_PAGE_ARTICLES}", $content, $this->page);
		$this->page = str_replace("{MB_PAGE_ARTICLES}", $content, $this->page);
		
		if($this->article_ID > 0) {
			$this->page = str_replace("{MB_BACK_ARTICLE}", $this->article_ID - 1, $this->page);
		} else {
			$this->page = str_replace("{MB_BACK_ARTICLE}", $this->article_ID, $this->page);
		}
		
		$count_max_id = mysql_result(mysql_query("SELECT COUNT(*) FROM `mb_articles`"), 0);
		
		if($this->article_ID < $count_max_id) {
			$this->page = str_replace("{MB_NEXT_ARTICLE}", $this->article_ID + 1, $this->page);
		} else {
			$this->page = str_replace("{MB_NEXT_ARTICLE}", $this->article_ID, $this->page);
		}
		
		return $this->page;
	}
	
	private function setContentToArticle($up_title, $head_title, $icon_ID, $prev_image_ID, $content) {
		$data_content = $this->article_content;
		$icon_file_name = "default.png";
		$prew_image_name = "default_prew.png";
		
		$query_data = mysql_query("SELECT `file_name`, `type` FROM `mb_images` WHERE `id`='" . Core::MYSQL_PROTECT($icon_ID) . "'");
		if(mysql_num_rows($query_data)) {
			$row = mysql_fetch_array($query_data);
			if($row["type"] == "icon") $icon_file_name = $row["file_name"];
		}
		
		$query_pre_image_data = mysql_query("SELECT `file_name`, `type` FROM `mb_images` WHERE `id`='" . Core::MYSQL_PROTECT($prev_image_ID) . "'");
		if(mysql_num_rows($query_pre_image_data)) {
			$row_prew_image = mysql_fetch_array($query_pre_image_data);
			if($row_prew_image["type"] == "prew") $prew_image_name = $row_prew_image["file_name"];
		}
		
		$data_content = str_replace(array("{MB_PAGE_ARTICLE_UP_TITLE}", "{MB_PAGE_ARTICLE_ICON}", "{MB_PAGE_ARTICLE_HEAD_TITLE}", "{MB_PAGE_ARTICLE_CONTENT}", "{MB_PAGE_ARTICLE_CONTENT_PREW_IMG}"), array($up_title, $icon_file_name, $head_title, $content, $prew_image_name), $data_content);
		return $data_content;
	}
	
}