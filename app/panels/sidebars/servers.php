<?php
register_sidebar("sidebar_servers");

function sidebar_servers() {
	$content = "";
	$content = file_get_contents(get_template_file("panels/sidebar/servers.html"));
	return $content;
}