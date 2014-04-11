var ytplayer;
function onYouTubeIframeAPIReady() {
	ytplayer = new YT.Player('player', {
		videoId : 'VyQxn8KD6YQ',
		playerVars : {
			allowScriptAccess : "always",
			wmode : "opaque"
		},
		events : {}
	});
}

$(window).load(function() {
	$('.flexslider').flexslider({
		animation : "fade"
	});
});

$(document).ready(function(e) {
	$('.home-slider-bg').blurjs({
		source: '.home-slider-bg', 
		radius: 5,
		overlay: 'rgba(0, 0, 0, 0.5)'
	}); 
	
	$('.close-video-home').click(function(event) {
		// remove blur effect		
		$('.home-slider-bg').removeAttr('style');
		
		// stop youtube video
		if (ytplayer) {
			ytplayer.destroy();
		}
		
		// hide video container
		$('.video-container').css({
			"display" : "none"
		});
	});
	
	$(".tab-tweets").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-tweets").parent().addClass("active");
		
		$("ul.content > li:not(#tabs-1)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content > li:not(#tabs-1)").css({"display": "none"});
			$("#tabs-1").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});
	});
	$(".tab-facebook").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-facebook").parent().addClass("active");
		
		$("ul.content > li:not(#tabs-2)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content > li:not(#tabs-2)").css({"display": "none"});
			$("#tabs-2").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});		
	});
	$(".tab-tumblr").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-tumblr").parent().addClass("active");
		
		$("ul.content > li:not(#tabs-3)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content > li:not(#tabs-3)").css({"display": "none"});
			$("#tabs-3").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});		
	});
	
	$(".social-nav .social-previous").click(function(event) {
		var indexTab = $("ul.title li").index( $("ul.title li.active") );
		switch(indexTab)
		{
			case 0:
				$(".tab-tumblr").click();
				break;
			case 1:
				$(".tab-tweets").click();
				break;
			case 2:
			default:
				$(".tab-facebook").click();
				break;
		}
	});
	$(".social-nav .social-next").click(function(event) {
		var indexTab = $("ul.title li").index( $("ul.title li.active") );
		
		switch(indexTab)
		{
			case 0:
				$(".tab-facebook").click();				
				break;
			case 1:
				$(".tab-tumblr").click();
				break;
			case 2:
			default:
				$(".tab-tweets").click();
				break;
		}
	});
	
	
	$("#tabs-1 > div").mCustomScrollbar({
		scrollButtons:{
			enable:true
		}
	});

	$.ajax({
		url: 'https://graph.facebook.com/TheMidnightMission/feed?limit=10&access_token=CAADIhcFu9R4BADfgrePHqJCsic8zH5hWREeZA63jjpW74RDpSnvIuz1QpjJhzH1Ykas8UQr6lHYTXf5MmWKpHKxWVW2ojJd8ZAqQXfOcaQ34pqoXJwx6Qc3EyCs6a15xa8PnOa0cQCKayrZCZAvKxVL9hZBqXV7e2EZBqirPdCFLNZCnKTvK9GTqbg9VBr4TbvuPcGbdYoCtQZDZD',
		dataType: "json",
		success: function(data) {
			var entities = data.data;
			for(var i=0; i<entities.length; i++) {
				var post = entities[i];
				$(".facebooks").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["from"]['name'] + "</span></p><p style=\"display: block;\">" + post["caption"]  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["link"] + "\">Read more</a></p></li>" );
			}
			
			$("#tabs-2 > div").mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});
		}
	});
});
