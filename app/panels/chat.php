<?php
register_panel("chat_panel", "{MB_CHAT}");

function chat_panel() {
	$content = "";
	
	if(User::isUserLogged()) {
		//$content = file_get_contents(get_template_file("/panels/chat.html"));
	}
	
	return $content;
}