<?php
class Page {
	
	private $page;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/main.html"));
	}
	
	public function run() {
		$content = "";
		$content .= $this->page;
		return $content;
	}
	
}