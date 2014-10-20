<?php
register_panel("user_panel", "{MB_PANEL_USER}");

function user_panel() {
	$content = "";
	
	if(User::isUserLogged()) {
		$content = loggedData(file_get_contents(get_template_file("panels/user-panel.html")));
	} else {
		$content = unloggerData(file_get_contents(get_template_file("panels/login-panel.html")));
	}
	
	return $content;
}

function loggedData($content) {
	$content = str_replace("{MB_USER_PAR1}", "Vítej " . User::getUserData("username"), $content);
	$content = str_replace("{MB_USER_PAR2}", "<a href=\"#\">Upravit profil</a>", $content);
	$content = str_replace("{MB_USER_PAR3}", "<a href=\"#\">Žebříček hráčů</a>", $content);
	$content = str_replace("{MB_USER_PAR4}", "<a href=\"#\">Fórum</a>", $content);
	return $content;
}
	
function unloggerData($content) {
	return $content;
}