<?php
class Page {
	
	private $page;
	
	public function __construct($page) {
		$this->page = file_get_contents(ABS_PATH . "app/themes/" . MBCORE_THEME . "/" . $page . ".html");
	}
	
	public function run() {
		$content = "";
		$content .= $this->page;
		return $content;
	}
	
}