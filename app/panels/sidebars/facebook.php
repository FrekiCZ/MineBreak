<?php
register_sidebar("sidebar_facebook");

function sidebar_facebook() {
	$content = "";
	$content = file_get_contents(get_template_file("panels/sidebar/facebook.html"));
	$content = replace("{facebook_import}", "<iframe src=\"//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FMineBreakcz&amp;width=210&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=424323774355008\" style=\"border:none; overflow:hidden; width:210px; height:258px;overflow: hidden;background: transparent\"></iframe>", $content);
	return $content;
}