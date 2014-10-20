$(function() {
	
	$(".chat-head").click(function() {
		var data_toggle = $(this).attr("data-toggle");
		var element = $("." + data_toggle).toggle(0);
		console.log(data_toggle + ":" + element);
	});
	
});