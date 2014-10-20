<?php
register_panel("main_paganation", "{MB_PAGE_PAGANATION}");

function main_paganation() {
	$content = "";
	$page = Core::getURLData(2);
	$pex = explode("-", $page);
	if($pex[0] != "stranka") {
		$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `mb_articles`"), 0);
		$after_rows = 4;
		
		if($rows > $after_rows) {
			$content = file_get_contents(get_template_file("/panels/paganation.html"));
			$page_id = $templating->getPageId($page);
			$content = str_replace("{MB_PAGE_BACK}", "0", $content);
			$content = str_replace("{MB_PAGE_NEXT}", "1", $content);
		}
	} else {
		$content = file_get_contents(get_template_file("/panels/paganation.html"));
		$page_id = $templating->getPageId($page);
		
		$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `mb_articles`"), 0);
		$after_rows = 4;
		$max_page = ceil($rows / $after_rows);
		
		if($max_page > $after_rows) {
			if($page_id == $max_page - 1) {
				if($page_id != 0) {
					$content = str_replace("{MB_PAGE_BACK}", $page_id - 1, $content);
					$content = str_replace("{MB_PAGE_NEXT}", $page_id, $content);
				} else {
					$content = str_replace("{MB_PAGE_BACK}", "0", $content);
					$content = str_replace("{MB_PAGE_NEXT}", "1", $content);
				}
				
			} else if($page_id != 0) {
				$content = str_replace("{MB_PAGE_BACK}", $page_id - 1, $content);
				$content = str_replace("{MB_PAGE_NEXT}", $page_id + 1, $content);
			} else {
				$content = str_replace("{MB_PAGE_BACK}", "0", $content);
				$content = str_replace("{MB_PAGE_NEXT}", "1", $content);
			}
		}
	}
	
	return $content;
}