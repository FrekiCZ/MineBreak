<?php
register_sidebar("sidebar_countdown");

function sidebar_countdown() {
	$content = "";
	$content = file_get_contents(get_template_file("panels/sidebar/countdown.html"));
	return $content;
}