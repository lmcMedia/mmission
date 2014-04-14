var ytplayer;
var initVideoOnFirstTime;
var isPreloaderComplete = false;

function onYouTubeIframeAPIReady() {
	initVideoOnFirstTime = setInterval(function() {
		if(isPreloaderComplete) {
			clearInterval(initVideoOnFirstTime);
			
			ytplayer = new YT.Player('player', {
				videoId : 'VyQxn8KD6YQ',
				playerVars : {
					allowScriptAccess : "always",
					wmode : "opaque"
				},
				events : {}
			});
		}
	}, 500);
	
}

$(window).load(function() {
	$('.flexslider').flexslider({
		animation : "fade"
	});
});

$(document).ready(function(e) {
	isPreloaderComplete = true;
	
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
		$(".mCSB_scrollTools").css({"display": "block"});
		$("ul.title li").removeClass("active");
		$(".tab-tweets").parent().addClass("active");
		
		$("#tabs-2, #tabs-3").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-2, #tabs-3").css({"display": "none"});
			$("#tabs-1").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
		});
	});
	$(".tab-facebook").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-facebook").parent().addClass("active");
		
		$("#tabs-1, #tabs-3").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-1, #tabs-3").css({"display": "none"});
			$("#tabs-2").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
		});		
	});
	$(".tab-tumblr").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-tumblr").parent().addClass("active");
		
		$("#tabs-1, #tabs-2").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-1, #tabs-2").css({"display": "none"});
			$("#tabs-3").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
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
		},
		advanced:{
	        updateOnContentResize: true
	    }
	});

	$.ajax({
		url: 'https://graph.facebook.com/TheMidnightMission/feed?limit=10&access_token=220476801479966|8VwX5XAIRAdP8d9F57yggxnGFBI',
		dataType: "jsonp",
		success: function(data) {
			var entities = data.data;

			for(var i=0; i<entities.length; i++) {
				var post = entities[i];
				switch(post['type'])
				{
					case 'photo':
						$(".facebooks").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["from"]['name'] + "</span></p><p style=\"display: block;\">" + post["caption"]  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["link"] + "\">Read more</a></p></li>" );
						break;
					case 'status':
						$(".facebooks").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + "Update Status: " + "</span></p><p style=\"display: block;\">" + post["message"]  + "</p></li>" );
						break;
					case 'link':
						$(".facebooks").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["from"]['name'] + "</span></p><p style=\"display: block;\">" + post["caption"]  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["link"] + "\">Read more</a></p></li>" );
						break;
				} 
				
			}
			
			$("#tabs-2 > div").mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});
		}
	});
	
	$.ajax({
		url: 'http://api.tumblr.com/v2/blog/themidnightmission.tumblr.com/posts?api_key=hCuLtlmdXHDlaDgCImhr0YJg7LhAHmOPhf7DA7X1u6YYQynycC&limit=10',
		dataType: "jsonp",
		success: function(data) {
			
			var entities = data.response.posts;
			for(var i=0; i<entities.length; i++) {
				var post = entities[i];
				switch(post['type'])
				{
					case 'photo':
						$(".tumblrs").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["blog_name"] + "</span></p><p style=\"display: block;\">" + post["caption"].substr(0, post["caption"].indexOf("</p>")+4)  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["short_url"] + "\">" + post["short_url"] +"</a></p></li>" );
						break;
					case 'text':
						$(".tumblrs").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["blog_name"] + "</span></p><p style=\"display: block;\">" + post["title"]  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["short_url"] + "\">" + post["short_url"] +"</a></p></li>" );
						break;
					case 'link':
						$(".tumblrs").append( "<li><p><span style=\"font-family: 'HelveticaNeue-Bold';\">" + post["blog_name"] + "</span></p><p style=\"display: block;\">" + post["title"]  + "</p><p><a style=\"color: #8dd6f5; display: block; text-align: right;\" target=\"_blank\" href=\"" + post["short_url"] + "\">" + post["short_url"] +"</a></p></li>" );
						break;
				} 
			}
			
			$("#tabs-3 > div").mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});
		}
	});
	
});