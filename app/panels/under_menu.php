<?php
register_panel("panel_under_menu", "{MB_PAGE_UNDER_MENU}");

function panel_under_menu() {
	$content = "";
	
	$content = file_get_contents(get_template_file("panels/under_menu.html"));
	
	return $content;
}