<?php
class Page {
	
	private $page;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/upload-complete.html"));
	}
	
	public function run() {
		$content = "";
		
		$this->setInfo("Test");
		
		return $this->page;
	}
	
	private function setInfo($message) {
		$this->page = str_replace("{MB_ADMIN_UP_INFO}", "<font color=\"green\">" . $message . "</font>", $this->page);
	}
	
	private function setWarning($message) {
		$this->page = str_replace("{MB_ADMIN_UP_INFO}", "<font color=\"red\">" . $message . "</font>", $this->page);
	}
	
}