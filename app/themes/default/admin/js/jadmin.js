$(function() {
	
	$("#open-gallery").click(function() {
		$("#box-container-overlay").toggle();
	});
	
	$("#open-gallery-all").click(function() {
		$(".box-container-overlay").toggle();
	});
	
	$(".close-gallery").click(function() {
		$("#box-container-overlay").toggle();
	});
	
	$("#close-gallery").click(function() {
		$(".box-container-overlay").toggle();
	});
	
	$("#public-article").click(function() {
		var article_title = $("#article-title").val();
		var prew_img_id = $("#prew-img-id").val();
		var content = CKEDITOR.instances.article_content.getData();
		
		if(article_title == "" || article_title == null) {
			warningInfo(" - Musíte zadat název článku !");
			return false;
		} else if(prew_img_id == "" || prew_img_id == null) {
			warningInfo(" - Musíte vybrat náhledový obrázek !");
			return false;
		} else if(content == "" || content == null) {
			warningInfo(" - Musíte do článku něco napsat !");
			return false;
		} else {
			return true;
		}
		
	});
	
	$("#upload").click(function() {
		var file = $("#file").val();
		if(file == null || file == "") {
			warningInfo(" - Musíte vybrat soubor !");
			return false;
		} else {
			return true;
		}
	});
	
	$(".post").mouseover(function() {
		var id = this.id;
		var row = "#row-" + id;
		$(row).css("visibility", "visible");
	});
	
	$(".post").mouseout(function() {
		var id = this.id;
		var row = "#row-" + id;
		$(row).css("visibility", "hidden");
	});
	
	$("#confirm").click(function() {
		var conf = confirm("Opravdu smazat ?");
		if(conf == false) return false;
	});
	
});

function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	$("#percents").html(Math.round(percent) + "% uploaded... please wait");
}

function setInfo(message) {
	$("#page-info").css("color", "green");
	$("#page-info").html(message);
}

function warningInfo(message) {
	$("#page-info").css("color", "red");
	$("#page-info").html(message);
}

function setImage(id, name) {
	$("#selected-image").html(name);
	$("#prew-img-id").val(id);
	$("#box-container-overlay").toggle();
}