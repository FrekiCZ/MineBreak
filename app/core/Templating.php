<?php
class Templating {
	
	private $replace_data = array();
	public static $panels;
	public static $sidebars;
	
	public function registerReplace($from, $to) {
		$this->replace_data[$from] = $to;
	}
	
	public function init() {
		$this->initPanels();
		$this->initSidebars();
	}
	
	private function initPanels() {
		$dir = ABS_PATH . "app/panels";
		$handler = opendir($dir);
		while($entry = readdir($handler)) {
			if($entry != "." && $entry != "..") {
				$s = explode(".", $entry);
				if(!empty($s[1])) {
					if($s[1] == "php") {
						include_once $dir . "/" . $entry;
					}
				}
			}
		}
		
		$data = explode(":", Templating::$panels);
		for($i = 0; $i < sizeof($data); $i++) {
			$sidebar_data = explode(";", $data[$i]);
			$sidebar_string_rep = $sidebar_data[1];
			$sidebar_name = $sidebar_data[0];
			$this->registerReplace($sidebar_string_rep, call_user_func($sidebar_name));
		}
	}
	
	private function initSidebars() {
		$dir = ABS_PATH . "app/panels/sidebars";
		$handler = opendir($dir);
		while($entry = readdir($handler)) {
			if($entry != "." && $entry != "..") {
				$s = explode(".", $entry);
				if($s[1] == "php") {
					include_once $dir . "/" . $entry;
				}
			}
		}
		
		$data = get_option("sidebars");
		$row_data = explode(":", $data);
		$content = "";
		for($i = 0; $i < sizeof($row_data); $i++) {
			$content .= call_user_func($row_data[$i]) . "\n";
		}
		$this->registerReplace("{MB_SIDEBARS}", $content);
	}
	
	public function run() {
		$page = Core::getURLData(1);
		if($page != null || $page != "") {
			$page_query = mysql_query("SELECT * FROM `mb_pages` WHERE `name`='" . Core::MYSQL_PROTECT($page) . "'");
			if(mysql_num_rows($page_query)) {
				$row_query = mysql_fetch_array($page_query);
				$page_paganation = mysql_query("SELECT * FROM `mb_paganations` WHERE `page`='" . $row_query["data"] . "'");
				
				if(mysql_num_rows($page_paganation)) {
					$once = true;
					while($row_paga = mysql_fetch_array($page_paganation)) {
						$page_name = $row_paga["page_index"];
						$ex = explode("{ID}", $page_name);
						$exlen = strlen($ex[0]);
						$third_link = Core::getURLData(2);
						$third_link = substr($third_link, 0, $exlen);
						if(Core::STRING_CONTAINS($third_link, $ex[0])) {
							$int_exist = str_replace($ex[0], "", Core::getURLData(2));
							if($int_exist != "" && preg_match('/[0-9]+/', $int_exist)) {
								return $this->runPage($row_paga["data"]);
								$once = false;
							} else {
								return $this->runPage("404");
								$once = false;
							}
						}
					}
					
					if($once) {
						return $this->runPage($row_query["data"]);
					}
					
				} else {
					$isRunnable = true;
					if($row_query["required_login"] == "true") {
						if(!User::isUserLogged()) {
							$isRunnable = false;
						} else {
							if(!(User::getUserData("permission") >= $row_query["permission"])) {
								$isRunnable = false;
							}
						}
					}
					
					if($isRunnable) {
						if($row_query["role"] == "normal") {
							return $this->runPage($row_query["data"]);
						} else {
							$urldata = Core::getURLData(2);
							if(Core::STRING_CONTAINS($urldata, "?")) {
								$ex = explode("?", $urldata);
								$urldata = $ex[0];
							}
							
							$subpage = $this->getSubPage($urldata);
							
							if($subpage != null) {
								
								if($subpage["page"] == $row_query["name"]) {
									if($row_query["role"] == "admin") {
										return $this->runPage($subpage["data"], "pages/" . $row_query["role"], false);
									} else {
										return $this->runPage($subpage["data"], "pages/" . $row_query["role"], true);
									}
								} else {
									return $this->runPage("404");
								}
							} else {
								if($row_query["role"] == "admin") {
									return $this->runPage($row_query["data"], "pages/" . $row_query["role"], false);
								} else {
									return $this->runPage($row_query["data"], "pages/" . $row_query["role"], true);
								}
							}
						}
					} else {
						return $this->runPage("404");
					}
				}
			} else {
				return $this->runPage("404");
			}
		} else {
			return $this->runPage("main");
		}
	}
	
	private function runPage($pageName, $folder = "pages", $header = true) {
		if(file_exists(ABS_PATH . "app/" . $folder . "/" . $pageName . ".php")) {
			require_once ABS_PATH . "app/" . $folder . "/" . $pageName . ".php";
			$page = new Page();
			$content = "";
			if($header) {
				$content .= file_get_contents(get_template_file("@head.html"));
				$content .= $page->run();
				$content .= file_get_contents(get_template_file("@footer.html"));
			} else {
				$content .= $page->run();
			}
			foreach($this->replace_data as $key => $value) {
				$content = str_replace($key, $value, $content);
			}
			return $content;
		} else {
			try {
				throw new Exception("Error: File \"app/" . $folder . "/" . $pageName . ".php\" not found !");
			} catch(Exception $ex) {
				return $ex->getMessage();
			}
		}
	}
	
	private function getSubPage($page) {
		$query = mysql_query("SELECT * FROM `mb_subpages` WHERE `subpage`='" . $page . "'");
		if(mysql_num_rows($query)) {
			$row = mysql_fetch_array($query);
			return array(
				"page"    => $row["page"],
				"subpage" => $row["subpage"],
				"data"    => $row["data"]
			);
		} else {
			return null;
		}
	}
	
	public static function getContentByID($fromContent, $id) {
		$delimiter = '#';
		$startTag = '{' . $id . '}';
		$endTag = '{/' . $id . '}';
		$regex = $delimiter . preg_quote($startTag, $delimiter) . '(.*?)' . preg_quote($endTag, $delimiter) . $delimiter . 's';
		preg_match($regex, $fromContent, $matches);
		$content = $matches[0];
		$fromContent = str_replace(array($startTag, $endTag), "", $fromContent);
		$content = str_replace(array($startTag, $endTag), "", $content);
		return $content;
	}
	
}