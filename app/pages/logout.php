<?php
class Page {
	
	public function __construct($page) {
		
	}
	
	public function run() {
		session_destroy();
		if(WEB_TYPE) {
			header("Location: /");
		} else {
			header("Location: /" . Core::$basename . "/");
		}
		return "";
	}
	
}