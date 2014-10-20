<?php

function get_option($option) {
	$query = mysql_query("SELECT * FROM `mb_options` WHERE `data`='" . $option . "'");
	$row = mysql_fetch_array($query);
	return $row["value"];
}

function get_template_file($file) {
	return ABS_PATH . "app/themes/" . MBCORE_THEME . "/" . $file;
}

function replace($from, $to, $input) {
	return str_replace($from, $to, $input);
}

function register_panel($func_name, $replace_string) {
	if(empty(Templating::$panels)) {
		Templating::$panels = $func_name . ";" . $replace_string;
	} else {
		Templating::$panels .= ":" . $func_name . ";" . $replace_string;
	}
}

function register_sidebar($func_name) {
	if(empty(Templating::$sidebars)) {
		Templating::$sidebars = $func_name;
	} else {
		Templating::$sidebars .= ":" . $func_name;
	}
}

function getBlockName($blockid) { 
		if($blockid == 1) { 
	        return "stone"; 
	    } else  if($blockid == 4) { 
	        return "cobblestone"; 
	    } else  if($blockid == 5) { 
	        return "wooden plank (Oak)"; 
	    } else  if($blockid == 5) { 
	        return "wooden plank (Spruce)"; 
	    } else  if($blockid == 5) { 
	        return "wooden plank (Birch)"; 
	    } else  if($blockid == 5) { 
	        return "wooden plank (Jungle)"; 
	    } else  if($blockid == 5) { 
	        return "wooden plank (Acacia)"; 
	    } else  if($blockid == 5) { 
	        return "Wooden Plank (Dark Oak)"; 
	    } else  if($blockid == 12) { 
	        return "sand"; 
	    } else  if($blockid == 17) { 
	        return "wood (oak)"; 
	    } else  if($blockid == 17) { 
	        return "wood (Spruce)"; 
	    } else  if($blockid == 17) { 
	        return "wood (Birch)"; 
	    } else  if($blockid == 17) { 
	        return "wood (Jungle)"; 
	    } else  if($blockid == 17) { 
	        return "Wood (Oak 5)"; 
	    } else  if($blockid == 20) { 
	        return "glass"; 
	    } else  if($blockid == 22) { 
	        return "lapis lazuli block"; 
	    } else  if($blockid == 23) { 
	        return "dispenser"; 
	    } else  if($blockid == 24) { 
	        return "sandstone"; 
	    } else  if($blockid == 24) { 
	        return "sandstone (Chiseled)"; 
	    } else  if($blockid == 24) { 
	        return "sandstone (Smooth)"; 
	    } else  if($blockid == 25) { 
	        return "note block"; 
	    } else  if($blockid == 27) { 
	        return "rail (Powered)"; 
	    } else  if($blockid == 28) { 
	        return "rail (Detector)"; 
	    } else  if($blockid == 29) { 
	        return "sticky piston"; 
	    } else  if($blockid == 33) { 
	        return "piston"; 
	    } else  if($blockid == 35) { 
	        return "wool"; 
	    } else  if($blockid == 35) { 
	        return "orange wool"; 
	    } else  if($blockid == 35) { 
	        return "magenta wool"; 
	    } else  if($blockid == 35) { 
	        return "light blue wool"; 
	    } else  if($blockid == 35) { 
	        return "yellow wool"; 
	    } else  if($blockid == 35) { 
	        return "lime wool"; 
	    } else  if($blockid == 35) { 
	        return "pink wool"; 
	    } else  if($blockid == 35) { 
	        return "gray wool"; 
	    } else  if($blockid == 35) { 
	        return "light gray wool"; 
	    } else  if($blockid == 35) { 
	        return "cyan wool"; 
	    } else  if($blockid == 35) { 
	        return "purple wool"; 
	    } else  if($blockid == 35) { 
	        return "blue wool"; 
	    } else  if($blockid == 35) { 
	        return "brown wool"; 
	    } else  if($blockid == 35) { 
	        return "green wool"; 
	    } else  if($blockid == 35) { 
	        return "red wool"; 
	    } else  if($blockid == 35) { 
	        return "black wool"; 
	    } else  if($blockid == 37) { 
	        return "Dandelion"; 
	    } else  if($blockid == 38) { 
	        return "Poppy"; 
	    } else  if($blockid == 38) { 
	        return "Blue Orchid"; 
	    } else  if($blockid == 38) { 
	        return "Allium"; 
	    } else  if($blockid == 38) { 
	        return "Red Tulip"; 
	    } else  if($blockid == 38) { 
	        return "Orange Tulip"; 
	    } else  if($blockid == 38) { 
	        return "White Tulip"; 
	    } else  if($blockid == 38) { 
	        return "Pink Tulip"; 
	    } else  if($blockid == 38) { 
	        return "Oxeye Daisy"; 
	    } else  if($blockid == 39) { 
	        return "brown mushroom"; 
	    } else  if($blockid == 40) { 
	        return "red mushroom"; 
	    } else  if($blockid == 41) { 
	        return "block of gold"; 
	    } else  if($blockid == 42) { 
	        return "block of iron"; 
	    } else  if($blockid == 44) { 
	        return "Stone Slab"; 
	    } else  if($blockid == 44) { 
	        return "Sandstone Slab"; 
	    } else  if($blockid == 44) { 
	        return "Wooden Slab"; 
	    } else  if($blockid == 44) { 
	        return "Quartz Slab"; 
	    } else  if($blockid == 45) { 
	        return "Brick"; 
	    } else  if($blockid == 46) { 
	        return "TNT"; 
	    } else  if($blockid == 47) { 
	        return "Bookshelf"; 
	    } else  if($blockid == 49) { 
	        return "Obsidian"; 
	    } else  if($blockid == 50) { 
	        return "Torch"; 
	    } else  if($blockid == 53) { 
	        return "Wooden Stairs (Oak)"; 
	    } else  if($blockid == 54) { 
	        return "Chest"; 
	    } else  if($blockid == 57) { 
	        return "Block of Diamond"; 
	    } else  if($blockid == 58) { 
	        return "workbench"; 
	    } else  if($blockid == 61) { 
	        return "furnace"; 
	    } else  if($blockid == 65) { 
	        return "ladder"; 
	    } else  if($blockid == 66) { 
	        return "rail"; 
	    } else  if($blockid == 67) { 
	        return "Cobblestone Stairs"; 
	    } else  if($blockid == 69) { 
	        return "lever"; 
	    } else  if($blockid == 70) { 
	        return "stone pressure plate"; 
	    } else  if($blockid == 72) { 
	        return "wooden pressure plate"; 
	    } else  if($blockid == 76) { 
	        return "redstone torch"; 
	    } else  if($blockid == 77) { 
	        return "button (stone)"; 
	    } else  if($blockid == 80) { 
	        return "snow block"; 
	    } else  if($blockid == 82) { 
	        return "clay block"; 
	    } else  if($blockid == 84) { 
	        return "jukebox"; 
	    } else  if($blockid == 85) { 
	        return "fence"; 
	    } else  if($blockid == 86) { 
	        return "pumpkin"; 
	    } else  if($blockid == 89) { 
	        return "glowstone"; 
	    } else  if($blockid == 91) { 
	        return "Jack-O-Lantern"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (White)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Orange)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Magenta)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Light Blue)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Yellow)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Lime)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Pink)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Gray)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Light Grey)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Cyan)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Purple)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Blue)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Brown)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Green)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Red)"; 
	    } else  if($blockid == 95) { 
	        return "Stained Glass (Black)"; 
	    } else  if($blockid == 98) { 
	        return "Stone Bricks"; 
	    } else  if($blockid == 101) { 
	        return "Iron Bars"; 
	    } else  if($blockid == 103) { 
	        return "melon block"; 
	    } else  if($blockid == 112) { 
	        return "nether brick"; 
	    } else  if($blockid == 116) { 
	        return "enchantment table"; 
	    } else  if($blockid == 124) { 
	        return "Redstone Lamp (On)"; 
	    } else  if($blockid == 126) { 
	        return "oak-Wood Slab"; 
	    } else  if($blockid == 126) { 
	        return "spruce-Wood Slab"; 
	    } else  if($blockid == 126) { 
	        return "birch-Wood Slab"; 
	    } else  if($blockid == 126) { 
	        return "jungle-Wood Slab"; 
	    } else  if($blockid == 126) { 
	        return "acacia-Wood Slab"; 
	    } else  if($blockid == 126) { 
	        return "Dark Oak-Wood Slab"; 
	    } else  if($blockid == 130) { 
	        return "Ender Chest"; 
	    } else  if($blockid == 131) { 
	        return "Tripwire hook"; 
	    } else  if($blockid == 133) { 
	        return "Block of emerald"; 
	    } else  if($blockid == 134) { 
	        return "Wooden Stairs (Spruce)"; 
	    } else  if($blockid == 135) { 
	        return "Wooden Stairs (Birch)"; 
	    } else  if($blockid == 136) { 
	        return "Wooden Stairs (Jungle)"; 
	    } else  if($blockid == 139) { 
	        return "Cobblestone Wall"; 
	    } else  if($blockid == 143) { 
	        return "Button (Wood)"; 
	    } else  if($blockid == 145) { 
	        return "anvil"; 
	    } else  if($blockid == 146) { 
	        return "Trapped Chest"; 
	    } else  if($blockid == 147) { 
	        return "Weighted Pressure Plate (Light)"; 
	    } else  if($blockid == 148) { 
	        return "Weighted Pressure Plate (Heavy)"; 
	    } else  if($blockid == 150) { 
	        return "Redstone Comparator (On)"; 
	    } else  if($blockid == 151) { 
	        return "Daylight Sensor"; 
	    } else  if($blockid == 152) { 
	        return "Block of Redstone"; 
	    } else  if($blockid == 154) { 
	        return "Hopper"; 
	    } else  if($blockid == 155) { 
	        return "Quartz Block"; 
	    } else  if($blockid == 155) { 
	        return "Chiseled Quartz Block"; 
	    } else  if($blockid == 155) { 
	        return "Pillar Quartz Block"; 
	    } else  if($blockid == 156) { 
	        return "Quartz Stairs"; 
	    } else  if($blockid == 157) { 
	        return "Rail (Activator)"; 
	    } else  if($blockid == 158) { 
	        return "Dropper"; 
	    } else  if($blockid == 159) { 
	        return "Stained Clay (Orange)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (White)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Orange)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Magenta)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Light Blue)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Yellow)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Lime)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Pink)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Gray)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Light Gray)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Cyan)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Purple)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Blue)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Brown)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Green)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Red)"; 
	    } else  if($blockid == 160) { 
	        return "Stained Glass Pane (Black)"; 
	    } else  if($blockid == 162) { 
	        return "Wood (Acacia Oak)"; 
	    } else  if($blockid == 162) { 
	        return "Wood (Dark Oak)"; 
	    } else  if($blockid == 163) { 
	        return "Wooden Stairs (Acacia)"; 
	    } else  if($blockid == 164) { 
	        return "Wooden Stairs (Dark Oak)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (White)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Orange)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Magenta)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Light Blue)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Yellow)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Lime)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Pink)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Grey)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Light Gray)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Cyan)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Purple)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Blue)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Brown)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Green)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Red)"; 
	    } else  if($blockid == 171) { 
	        return "Carpet (Black)"; 
	    } else  if($blockid == 172) { 
	        return "Hardened Clay"; 
	    } else  if($blockid == 173) { 
	        return "Block of Coal"; 
	    } else  if($blockid == 175) { 
	        return "Sunflower"; 
	    } else  if($blockid == 175) { 
	        return "Lilac"; 
	    } else  if($blockid == 175) { 
	        return "Rose Bush"; 
	    } else  if($blockid == 175) { 
	        return "Peony"; 
	    } else  if($blockid == 256) { 
	        return "Iron Shovel"; 
	    } else  if($blockid == 257) { 
	        return "Iron Pickaxe"; 
	    } else  if($blockid == 258) { 
	        return "Iron Axe"; 
	    } else  if($blockid == 259) { 
	        return "Flint and Steel"; 
	    } else  if($blockid == 260) { 
	        return "Apple"; 
	    } else  if($blockid == 261) { 
	        return "Bow"; 
	    } else  if($blockid == 262) { 
	        return "Arrow"; 
	    } else  if($blockid == 263) { 
	        return "Coal"; 
	    } else  if($blockid == 264) { 
	        return "Diamond Gem"; 
	    } else  if($blockid == 265) { 
	        return "Iron Ingot"; 
	    } else  if($blockid == 266) { 
	        return "Gold Ingot"; 
	    } else  if($blockid == 267) { 
	        return "Iron Sword"; 
	    } else  if($blockid == 268) { 
	        return "Wooden Sword"; 
	    } else  if($blockid == 269) { 
	        return "Wooden Shovel"; 
	    } else  if($blockid == 270) { 
	        return "Wooden Pickaxe"; 
	    } else  if($blockid == 271) { 
	        return "Wooden Axe"; 
	    } else  if($blockid == 272) { 
	        return "Stone Sword"; 
	    } else  if($blockid == 273) { 
	        return "Stone Shovel"; 
	    } else  if($blockid == 274) { 
	        return "Stone Pickaxe"; 
	    } else  if($blockid == 275) { 
	        return "Stone Axe"; 
	    } else  if($blockid == 276) { 
	        return "Diamond Sword"; 
	    } else  if($blockid == 277) { 
	        return "Diamond Shovel"; 
	    } else  if($blockid == 278) { 
	        return "Diamond Pickaxe"; 
	    } else  if($blockid == 279) { 
	        return "Diamond Axe"; 
	    } else  if($blockid == 280) { 
	        return "Stick"; 
	    } else  if($blockid == 281) { 
	        return "Bowl"; 
	    } else  if($blockid == 282) { 
	        return "Mushroom Stew"; 
	    } else  if($blockid == 283) { 
	        return "Gold Sword"; 
	    } else  if($blockid == 284) { 
	        return "Gold Shovel"; 
	    } else  if($blockid == 285) { 
	        return "Gold Pickaxe"; 
	    } else  if($blockid == 286) { 
	        return "Gold Axe"; 
	    } else  if($blockid == 287) { 
	        return "String"; 
	    } else  if($blockid == 288) { 
	        return "Feather"; 
	    } else  if($blockid == 289) { 
	        return "Gunpowder"; 
	    } else  if($blockid == 290) { 
	        return "Wooden Hoe"; 
	    } else  if($blockid == 291) { 
	        return "Stone Hoe"; 
	    } else  if($blockid == 292) { 
	        return "Iron Hoe"; 
	    } else  if($blockid == 293) { 
	        return "Diamond Hoe"; 
	    } else  if($blockid == 294) { 
	        return "Gold Hoe"; 
	    } else  if($blockid == 296) { 
	        return "Wheat"; 
	    } else  if($blockid == 297) { 
	        return "Bread"; 
	    } else  if($blockid == 298) { 
	        return "Leather Helmet"; 
	    } else  if($blockid == 299) { 
	        return "Leather Chestplate"; 
	    } else  if($blockid == 300) { 
	        return "Leather Leggings"; 
	    } else  if($blockid == 301) { 
	        return "Leather Boots"; 
	    } else  if($blockid == 302) { 
	        return "Chainmail Helmet"; 
	    } else  if($blockid == 303) { 
	        return "Chainmail Chestplate"; 
	    } else  if($blockid == 304) { 
	        return "Chainmail Leggings"; 
	    } else  if($blockid == 305) { 
	        return "Chainmail Boots"; 
	    } else  if($blockid == 306) { 
	        return "Iron Helmet"; 
	    } else  if($blockid == 307) { 
	        return "Iron Chestplate"; 
	    } else  if($blockid == 308) { 
	        return "Iron Leggings"; 
	    } else  if($blockid == 309) { 
	        return "Iron Boots"; 
	    } else  if($blockid == 310) { 
	        return "Diamond Helmet"; 
	    } else  if($blockid == 311) { 
	        return "Diamond Chestplate"; 
	    } else  if($blockid == 312) { 
	        return "Diamond Leggings"; 
	    } else  if($blockid == 313) { 
	        return "Diamond Boots"; 
	    } else  if($blockid == 314) { 
	        return "Gold Helmet"; 
	    } else  if($blockid == 315) { 
	        return "Gold Chestplate"; 
	    } else  if($blockid == 316) { 
	        return "Gold Leggings"; 
	    } else  if($blockid == 317) { 
	        return "Gold Boots"; 
	    } else  if($blockid == 318) { 
	        return "Flint"; 
	    } else  if($blockid == 321) { 
	        return "Painting"; 
	    } else  if($blockid == 322) { 
	        return "Golden Apple"; 
	    } else  if($blockid == 322) { 
	        return "Enchanted Golden Apple"; 
	    } else  if($blockid == 323) { 
	        return "Sign"; 
	    } else  if($blockid == 325) { 
	        return "Bucket"; 
	    } else  if($blockid == 328) { 
	        return "Minecart"; 
	    } else  if($blockid == 332) { 
	        return "Snowball"; 
	    } else  if($blockid == 333) { 
	        return "Boat"; 
	    } else  if($blockid == 334) { 
	        return "Leather"; 
	    } else  if($blockid == 335) { 
	        return "Bucket (Milk)"; 
	    } else  if($blockid == 336) { 
	        return "Clay Brick"; 
	    } else  if($blockid == 337) { 
	        return "Clay"; 
	    } else  if($blockid == 338) { 
	        return "Sugar Cane"; 
	    } else  if($blockid == 339) { 
	        return "Paper"; 
	    } else  if($blockid == 340) { 
	        return "Book"; 
	    } else  if($blockid == 341) { 
	        return "Slime Ball"; 
	    } else  if($blockid == 342) { 
	        return "Minecart (Storage)"; 
	    } else  if($blockid == 343) { 
	        return "Minecart (Powered)"; 
	    } else  if($blockid == 351) { 
	        return "Ink Sack"; 
	    } else  if($blockid == 351) { 
	        return "Rose Red Dye"; 
	    } else  if($blockid == 351) { 
	        return "Cactus Green Dye"; 
	    } else  if($blockid == 351) { 
	        return "Cocoa Bean"; 
	    } else  if($blockid == 351) { 
	        return "Lapis Lazuli"; 
	    } else  if($blockid == 351) { 
	        return "Purple Dye"; 
	    } else  if($blockid == 351) { 
	        return "Cyan Dye"; 
	    } else  if($blockid == 351) { 
	        return "Light Gray Dye"; 
	    } else  if($blockid == 351) { 
	        return "Gray Dye"; 
	    } else  if($blockid == 351) { 
	        return "Pink Dye"; 
	    } else  if($blockid == 351) { 
	        return "Lime Dye"; 
	    } else  if($blockid == 351) { 
	        return "Dandelion Yellow Dye"; 
	    } else  if($blockid == 351) { 
	        return "Light Blue Dye"; 
	    } else  if($blockid == 351) { 
	        return "Magenta Dye"; 
	    } else  if($blockid == 351) { 
	        return "Orange Dye"; 
	    } else  if($blockid == 351) { 
	        return "Bone Meal"; 
	    } else  if($blockid == 352) { 
	        return "Bone"; 
	    } else  if($blockid == 353) { 
	        return "Sugar"; 
	    } else  if($blockid == 354) { 
	        return "Cake"; 
	    } else  if($blockid == 355) { 
	        return "Bad"; 
	    } else  if($blockid == 356) { 
	        return "Redstone Repeater"; 
	    } else  if($blockid == 357) { 
	        return "Cookie"; 
	    } else  if($blockid == 358) { 
	        return "Map"; 
	    } else  if($blockid == 359) { 
	        return "Shears"; 
	    } else  if($blockid == 360) { 
	        return "Melon (Slice)"; 
	    } else  if($blockid == 361) { 
	        return "Pumpkin Seeds"; 
	    } else  if($blockid == 362) { 
	        return "Melon Seeds"; 
	    } else  if($blockid == 368) { 
	        return "Ender Pearl"; 
	    } else  if($blockid == 369) { 
	        return "Blaze Rod"; 
	    } else  if($blockid == 370) { 
	        return "Gold Nugget"; 
	    } else  if($blockid == 374) { 
	        return "Glass Bottle"; 
	    } else  if($blockid == 375) { 
	        return "Spider Eye"; 
	    } else  if($blockid == 376) { 
	        return "Fermented Spider Eye"; 
	    } else  if($blockid == 377) { 
	        return "Blaze Powder"; 
	    } else  if($blockid == 378) { 
	        return "Magma Cream"; 
	    } else  if($blockid == 379) { 
	        return "Brewing Stand"; 
	    } else  if($blockid == 380) { 
	        return "Cauldron"; 
	    } else  if($blockid == 381) { 
	        return "Eye of Ender"; 
	    } else  if($blockid == 382) { 
	        return "Glistering Melon (Slice)"; 
	    } else  if($blockid == 385) { 
	        return "Fire Charge"; 
	    } else  if($blockid == 386) { 
	        return "Book and Quill"; 
	    } else  if($blockid == 388) { 
	        return "Emerald"; 
	    } else  if($blockid == 389) { 
	        return "Item Frame"; 
	    } else  if($blockid == 390) { 
	        return "Flower Pot"; 
	    } else  if($blockid == 391) { 
	        return "Carrot"; 
	    } else  if($blockid == 396) { 
	        return "Golden Carrot"; 
	    } else  if($blockid == 399) { 
	        return "Nether Star"; 
	    } else  if($blockid == 400) { 
	        return "Pumpkin Pie"; 
	    } else  if($blockid == 405) { 
	        return "Nether Brick (Item)"; 
	    } else  if($blockid == 406) { 
	        return "Nether Quartz"; 
	    } else  if($blockid == 407) { 
	        return "Minecart (TNT)"; 
	    } else  if($blockid == 408) { 
	        return "Minecart (Hopper)"; 
	    } else  if($blockid == 417) { 
	        return "Iron Horse Armor"; 
	    } else  if($blockid == 418) { 
	        return "Gold Horse Armor"; 
	    } else  if($blockid == 419) { 
	        return "Diamond Horse Armor"; 
	    }
	}