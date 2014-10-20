<?php
class ImageUtil {
	
	public static function cropImage($image, $x, $y, $width, $height) {
		return imagecrop($image, array($x, $y, $width, $height));
	}
	
	
	
}