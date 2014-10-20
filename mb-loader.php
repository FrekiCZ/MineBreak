<?php
defined("MB_INIT") or die("Error");

define("ABS_PATH", dirname(__FILE__) . '/');
define("CORE_DIR", "app/core");

require_once ABS_PATH . CORE_DIR . "/Core.php";
require_once ABS_PATH . CORE_DIR . "/User.php";
require_once ABS_PATH . CORE_DIR . "/MySQL.php";
require_once ABS_PATH . CORE_DIR . "/ImageUtil.php";
require_once ABS_PATH . CORE_DIR . "/Templating.php";
require_once ABS_PATH . 'mb-functions.php';

$core = new Core();
$user = new User();
$mysql = new MySQL();
$template = new Templating();

$mysql->setData(MBDB_HOST, MBDB_USER, MBDB_PASSWORD, MBDB_NAME);
$mysql->setCharset(MBDB_CHARSET);
$mysql->connect();

if($mysql->connected) {
	if(basename(__DIR__) == "htdocs" || basename(__DIR__) == "www") {
		define("WEB_IDIR", "http://" . $_SERVER["HTTP_HOST"] . "/");
		define("WEB_TYPE", true);
		$core->setIsInfolder(false);
	} else {
		define("WEB_IDIR", "http://" . $_SERVER["HTTP_HOST"] . "/" . basename(__DIR__) . "/");
		define("WEB_TYPE", false);
		$core->setIsInfolder(true);
		$core->setBasename(basename(dirname(__FILE__)));
	}
	
	$user->init();
	$template->init();
	
	define("WEB_TDIR", WEB_IDIR . "app/themes/" . MBCORE_THEME . "/");
	define("WEB_RES_IMAGES", ABS_PATH . "mb-upload/resources/images/");
	
	$template->registerReplace("{ABS_PATH}", WEB_IDIR);
	$template->registerReplace("{THEME_DIR}", WEB_TDIR);
	$template->registerReplace("{WEB_HOST}", WEB_IDIR);
	
	if(WEB_TYPE) {
		$template->registerReplace("{BASENAME}", "");
	} else {
		$template->registerReplace("{BASENAME}", "/" . Core::$basename);
	}
	
	$page = $template->run();
	
	$page = preg_replace(array('/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'), array(' ', ''), $page);
	
	echo $page;
}