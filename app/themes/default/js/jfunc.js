//$(function() {
//	var title = "           Minebreak - první český JailBreak server";
//	var titlePart = 0;
//	setInterval(function() {
//		titlePart++;
//		if(titlePart == 37) {
//			titlePart = 0;
//		} else {
//			document.title = title.substring(titlePart);
//		}
//	}, 200);
//});
$(function() {
//	var switchLive = false;
//	setInterval(function() {
//		if(switchLive) {
//			$("#livestream-status").removeClass("live");
//			$("#livestream-status").addClass("nolive");
//			switchLive = false;
//		} else {
//			$("#livestream-status").removeClass("nolive");
//			$("#livestream-status").addClass("live");
//			switchLive = true;
//		}
//	}, 1000);
});

function create_toggle_element(button, element, speed) {
	$(function() {
		$(button).click(function() {
			$(element).toggle(speed);
		});
	});
}

function new_changeable_div(button, div, message1, message2) {
	$(function() {
		$(button).click(function() {
			var oldContent = div.val();
			if(oldContent != message1) {
				$(div).html(message1);
			} else {
				$(div).html(message2);
			}
		});
	});
}