$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        console.log($(this).width())
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
    
    	setInterval(function() {
    		$.ajax({
    			url: 'http://minebreak.cz/count.php',
    			type: 'post',
    			data: { data:"get" },
    			success: function(data) {
    				$(".web-count").html(data);
    			}
    		});
    	}, 500);

    	
})
