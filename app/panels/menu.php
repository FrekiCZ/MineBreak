<?php
register_panel("menu_page", "{MB_PAGE_MENU}");
function menu_page() {
	return file_get_contents(get_template_file("/panels/menu.html"));
}