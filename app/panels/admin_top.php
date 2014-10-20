<?php
register_panel("admin_top_bar", "{MB_ADMIN_TOP_BAR}");

function admin_top_bar() {
	$content = "";
	
	if(User::isUserAdmin()) {
		$content = file_get_contents(get_template_file("/panels/admin-top.html"));
	}
	
	return $content;
}