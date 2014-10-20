<?php
class Page {
	
	private $page;
	private $slot_content;
	private $null_slot_content;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("user/profil.html"));
		$this->slot_content = Templating::getContentByID($this->page, "INVENTORY_SLOT");
		$this->page = str_replace($this->slot_content, "", $this->page);
		$this->page = str_replace(array("{INVENTORY_SLOT}", "{/INVENTORY_SLOT}"), "", $this->page);
		
		$this->null_slot_content = Templating::getContentByID($this->page, "INVENTORY_NULL_SLOT");
		$this->page = str_replace(array("{INVENTORY_NULL_SLOT}", "{/INVENTORY_NULL_SLOT}"), "", $this->page);
		$this->page = str_replace($this->null_slot_content, "", $this->page);
	}
	
	public function run() {
		$this->page = str_replace("{USER_USERNAME}", User::getUserData("username"), $this->page);
		$this->replace("{USER_GAME_TYPE}", "Vezeň");
		$this->replace("{USER_LEVEL}", User::getUserMetaData("lvl"));
		$this->replace("{USER_XP}", User::getUserMetaData("xp"));
		$this->replace("{USER_CASH}", User::getUserMetaData("penize"));
		$this->replace("{USER_STRENGTH}", User::getUserMetaData("sila"));
		$this->replace("{USER_STAMINA}", User::getUserMetaData("vydrz"));
		$this->replace("{USER_FACILITY}", User::getUserMetaData("obratnost"));
		$this->replace("{USER_INTELIGENCE}", User::getUserMetaData("inteligence"));
		$this->replace("{USER_LUCK}", User::getUserMetaData("stesti"));
		
		$this->read_inventory();
		return $this->page;
	}
	
	public function replace($from, $to) {
		$this->page = str_replace($from, $to, $this->page);
	}
	
	private function read_inventory() {
		$content = "";
		
		$query = mysql_query("SELECT * FROM `inventar` WHERE `nick`='" . User::getUserData("username") . "' AND `typ`='vezen_chest'");
		$inventory = mysql_fetch_array($query);
		$ex = explode(";", $inventory["obsah"]);
		$size = sizeof($ex) - 1;
		$count = -1;
		
		for($count = 0; $count < $size; $count++) {
			$explode_data = explode(",", $ex[$count]);
			$content .= $this->set_content_to_slot(getBlockName($explode_data[0]), $explode_data[0]);
		}
		
		$count_null = 36 - $size;
		
		for($cn = 0; $cn < $count_null; $cn++) {
			$content .= $this->set_null_slot();
		}
		
		$this->page = str_replace("{INVENTORY_SLOTS}", $content, $this->page);
	}
	
	private function set_content_to_slot($item_name, $tem_id) {
		$content = $this->slot_content;
		
		$content = str_replace(array("{INVENTORY_ITEM_NAME}", "{INVENTORY_ITEM_ID}"), array($item_name, ($tem_id . ".png")), $content);
		
		return $content;
	}
	
	private function set_null_slot() {
		$content = $this->null_slot_content;
		return $content;
	}
}