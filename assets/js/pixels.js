function likepost(workid) 
{
	//alert(workid);
        //event.preventDefault();     
  	$.post("/api/submit/like",{workid:workid},function( data ) {
                    alert(data['error']);
              },"json")
}

$(document).ready(function() {
    $(".map").click(function() {
    	var url = $(this).attr("href");
        window.location.href=url;
    });
});

$(document).ready(function() {
    $(".alink").hover(function() {
		$(this).parent().children("p").show();
	}, function() {
		$(this).parent().children("p").hide();
	});
});

