$(function() {
	$("<div id=\"tooltip\"><div id=\"tooltip-content\"></div></div>").appendTo('body');
	var tooltipBox = $("#tooltip");
	var tooltipContent = $("#tooltip-content");
	
	$(".tooltip").hover(function() {
		var data = $(this).attr("data-tooltip-content");
		tooltipContent.html(data);
	}, function() {
		tooltipBox.css("display", "none");
	}).mousemove(function(e) {
		var mousex = e.pageX + 20;
		var mousey = e.pageY + 10;
        tooltipBox.css("display", "block");
        tooltipBox.css("left", mousex);
        tooltipBox.css("top", mousey);
	});
	
});