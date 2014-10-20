<?php
class Page {
	
	private $page;
	private $article_content;
	private $page_id;
	
	public function __construct($page) {
		preg_match_all('!\d+!', Core::getURLData(2), $matches);
		$this->page = file_get_contents(get_template_file("main.html"));
		$this->article_content = Templating::getContentByID($this->page, "MB_PAGE_ARTICLE");
		$this->page = str_replace($this->article_content, "", $this->page);
		$this->page = str_replace(array("{MB_PAGE_ARTICLE}", "{/MB_PAGE_ARTICLE}"), "", $this->page);
	}
	
	public function run() {
		$content = "";
		
		$after_rows = 4;
		
		$now_page = $this->page_id;
		
		$articles_query = mysql_query("SELECT * FROM `mb_articles` ORDER BY id DESC LIMIT $now_page,$after_rows");
		if(mysql_num_rows($articles_query)) {
			while($row = mysql_fetch_array($articles_query)) {
				if($row["visibility"] == "true") {
					$content .= $this->setContentToArticle($row["id"], $row["up_title"], $row["head_title"], $row["icon_id"], $row["prew_image_id"], $row["content"]);
				}
			}
		} else {
			$content = $this->setContentToArticle("0", "404", "Stránka nenalazena", 0, 0, "ssdgsdg");
		}
		
		$this->page = str_replace("{MB_PAGE_ARTICLES}", $content, $this->page);
		
		return $this->page;
	}
	
	private function setContentToArticle($article_id, $up_title, $head_title, $icon_ID, $prev_image_ID, $content) {
		$data_content = $this->article_content;
		$icon_file_name = "default.png";
		$prew_image_name = "default_prew.png";
		$content = $this->perex($content, 200);
		$prev_link_ac_name = str_replace(" ", "-", $head_title);
		
		$query_icon_data = mysql_query("SELECT `file_name`, `type` FROM `mb_images` WHERE `id`='" . Core::MYSQL_PROTECT($icon_ID) . "'");
		if(mysql_num_rows($query_icon_data)) {
			$row_icon = mysql_fetch_array($query_icon_data);
			if($row_icon["type"] == "icon") $icon_file_name = $row_icon["file_name"];
		}
		
		$query_pre_image_data = mysql_query("SELECT `file_name`, `type` FROM `mb_images` WHERE `id`='" . Core::MYSQL_PROTECT($prev_image_ID) . "'");
		if(mysql_num_rows($query_pre_image_data)) {
			$row_prew_image = mysql_fetch_array($query_pre_image_data);
			if($row_prew_image["type"] == "prew") $prew_image_name = $row_prew_image["file_name"];
		}
		return str_replace(array("{MB_PAGE_ARTICLE_ID}", "{MB_PAGE_ARTICLE_UP_TITLE}", "{MB_PAGE_ARTICLE_HEAD_TITLE}", "{MB_PAGE_ARTICLE_ICON}", "{MB_PAGE_ARTICLE_PREW_IMAGE}", "{MB_PAGE_ARTICLE_CONTENT}", "{MB_ARTICLE_LINK_TITLE}"), array($article_id, $up_title, $head_title, $icon_file_name, $prew_image_name, $content, $prev_link_ac_name), $data_content);
	}
	
	private function perex($text, $length = 5, $ending = "...") {
	    $text  = mb_substr($text, 0, $length);
	    $pos   = mb_strrpos($text, " ");
	    $text  = mb_substr($text, 0, $pos);
	    $text .= $ending;
	    return $text;
	 
	}
	
}