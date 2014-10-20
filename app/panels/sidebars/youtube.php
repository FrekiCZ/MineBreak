<?php
register_sidebar("sidebar_youtube");

function sidebar_youtube() {
	$content = "";
	$content = file_get_contents(get_template_file("panels/sidebar/youtube.html"));
	return $content;
}