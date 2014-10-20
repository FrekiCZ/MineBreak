$(function() {
	var $image = $(".img-container img");
	$image.cropper({
	    preview: ".img-preview",
	    done: function(data) {
	    	
	    }
	});
	
	$("#img-icon").click(function() {
		$image.cropper("setData", {width: 33, height: 33});
		$("#page-info").html("<font color=\"green\"></font>");
	});
	
	$("#img-prew").click(function() {
		var imgSize = $image.cropper("getImgInfo").naturalWidth;
		console.log(imgSize);
		if(!(imgSize < 638)) {
			$image.cropper("setData", {width: 638, height: 95});
		} else {
			$("#page-info").html("<font color=\"red\">Obrázek je příliš malý !</font>");
		}
	});

	$("#img-nochange").click(function() {
		$("#page-info").html("<font color=\"green\">Uloženo.</font>");
		var imgWidth = $image.cropper("getImgInfo").naturalWidth;
		var imgHeight = $image.cropper("getImgInfo").naturalHeight;
		$image.cropper("setData", {x1: 0, y1: 0, width: imgWidth, height: imgHeight});
	});
});