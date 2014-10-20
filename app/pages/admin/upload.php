<?php
class Page {
	
	private $page;
	
	public function __construct($page) {
		$this->page = file_get_contents(get_template_file("admin/upload.html"));
	}
	
	public function run() {
		$this->upload();
		return $this->page;
	}
	
	public function upload() {
		if(isset($_POST["upload"])) {
			if(!empty($_FILES["file"])) {
				if(
					$_FILES["file"]["type"] == "image/gif"  || 
					$_FILES["file"]["type"] == "image/png"  ||
					$_FILES["file"]["type"] == "image/jpeg" ||
					$_FILES["file"]["type"] == "image/pjpeg"
				) {
					mysql_query("INSERT INTO `mb_images` values('', '" . $_FILES["file"]["name"] . "', 'all');");
					move_uploaded_file($_FILES["file"]["tmp_name"], WEB_RES_IMAGES . $_FILES["file"]["name"]);
					$this->setInfo(" - Soubor úspěšně nahrán beze změn.");
				} else {
					$this->setWarning(" - Soubor musí být pouze obrázek !");
				}
			} else {
				$this->setWarning("");
			}
		} else {
			$this->setWarning("");
		}
	}
	
	private function setInfo($message) {
		$this->page = str_replace("{MB_ADMIN_UP_INFO}", "<font color=\"green\">" . $message . "</font>", $this->page);
	}
	
	private function setWarning($message) {
		$this->page = str_replace("{MB_ADMIN_UP_INFO}", "<font color=\"red\">" . $message . "</font>", $this->page);
	}
	
	public function resizeImage($fromFile, $toFile, $newWidth, $newHeight) {
		
		$info = getimagesize($fromFile);
    	$imageType = $info['mime'];
    	
    	if($imageType == "image/jpeg") {
    		$image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
    	}
    	
		if($imageType == "image/png") {
    		$image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
    	}
    	
    	if($imageType == "image/gif") {
    		$image_create_func = 'imagecreatefromgif';
            $image_save_func = 'imagegif';
    	}
    	
    	$img = $image_create_func($toFile);
    	$tmp = imagecreatetruecolor($newWidth, $newHeight);
    	list($width, $height, $type, $attr) = getimagesize($fromFile);
    	imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		
		if (file_exists($toFile)) {
	            unlink($toFile);
	    }
	    
	    $image_save_func($tmp, $toFile);
    	
	}
	
}