<?php
register_sidebar("sidebar_advertising");

function sidebar_advertising() {
	$content = "";
	$content = file_get_contents(get_template_file("panels/sidebar/other.html"));
	return $content;
}