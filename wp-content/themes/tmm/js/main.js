var ytplayer;
var initVideoOnFirstTime;
var isPreloaderComplete = false;

function onPlayerReady(event) {
}

function onPlayerStateChange(event) {
	if(event.data == 0) {
		$('.close-video-home').click();
	}
}

var youtubeVideoID = 'mmMs9NHCePo';
function onYouTubeIframeAPIReady() {
	initVideoOnFirstTime = setInterval(function() {
		if(isPreloaderComplete) {
			clearInterval(initVideoOnFirstTime);
			
			ytplayer = new YT.Player('player', {
				videoId : youtubeVideoID ,
				playerVars : {
					allowScriptAccess : "always",
					wmode : "transparent",
					autoplay: 1,
					rel: 0
				},
				events : {
					'onReady': onPlayerReady,
					'onStateChange': onPlayerStateChange
				}
			});
		}
	}, 500);	
}

$(window).load(function() {
	if(reloadSite) {
		$('.flexslider').flexslider({
			animation : "fade",
			slideshowSpeed: 5000,
			slideshow: true,
			start: function( slider ) {
				$(".home-slider-bg").css({"background-image": 'url("/wp-content/themes/tmm/images/home/background-slider.jpg")'});
			}, 
		});
	} else {
		$('.flexslider').flexslider({
			animation : "fade",
			slideshowSpeed: 5000,
			slideshow: false,
			start: function( slider ) {
				$(".home-slider-bg").css({"background-image": 'url("/wp-content/themes/tmm/images/home/background-slider.jpg")'});
			}, 
		});
	}
});

$(document).ready(function(e) {
	if(reloadSite) {
		$('body').css({
			'display': 'block'
		});
		
		clearInterval(initVideoOnFirstTime);
		isPreloaderComplete = true;
		
		// remove blur effect		
		$('.home-slider-bg').removeAttr('style');
		
		// hide video container
		$('.video-container').css({
			"display" : "none"
		});
		
		$('.flexslider').flexslider("play");
		
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
			$(".flex-prev").css({"left": "10px", 'opacity': "1"});
			$(".flex-next").css({"right": "10px", 'opacity': "1"});
		} 
	} else {
		$('body').jpreLoader({
			splashID: "#jSplash",
			loaderVPos: '45%',
			autoClose: true,
			showPercentage: false,
			splashFunction: function() {}
		}, function() {	//callback function
			isPreloaderComplete = true;
		});
		
		$('.home-slider-bg').blurjs({
			source: '.home-slider-bg', 
			radius: 5,
			overlay: 'rgba(0, 0, 0, 0.5)'
		}); 
		
	}

	if ( (/iphone|ipad|ipod/gi).test(navigator.appVersion) ) {
		$(".videoWrapper").addClass("ios");
	}
	
	
	$('.close-video-home').click(function(event) {
		// remove blur effect
		if(reloadSite) {
			$('.home-slider-bg').removeAttr('style');
		}
		
		// stop youtube video
		if (ytplayer) {
			ytplayer.destroy();
		}
		
		// hide video container
		$('.video-container').css({
			"display" : "none"
		});
		
		$('.flexslider').flexslider("play");
		
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
			$(".flex-prev").css({"left": "10px", 'opacity': "1"});
			$(".flex-next").css({"right": "10px", 'opacity': "1"});
		} 
	});
	
	$(".tab-tweets").click(function(event) {
		$("#tabs-1 > div").mCustomScrollbar("scrollTo","top");
		$(".mCSB_scrollTools").css({"display": "block"});
		$("ul.title li").removeClass("active");
		$(".tab-tweets").parent().addClass("active");
		
		$("#tabs-3").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-3").css({"display": "none"});
			$("#tabs-1").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
		});
	});
	/*
	$(".tab-facebook").click(function(event) {
		$("#tabs-2 > div").mCustomScrollbar("scrollTo","top");
		$("ul.title li").removeClass("active");
		$(".tab-facebook").parent().addClass("active");
		
		$("#tabs-1, #tabs-3").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-1, #tabs-3").css({"display": "none"});
			$("#tabs-2").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
		});		
	});
	*/
	$(".tab-tumblr").click(function(event) {
		$("#tabs-3 > div").mCustomScrollbar("scrollTo","top");
		$("ul.title li").removeClass("active");
		$(".tab-tumblr").parent().addClass("active");
		
		$("#tabs-1").stop(true,false).animate({"opacity":"0"},function(){
			$("#tabs-1").css({"display": "none"});
			$("#tabs-3").css({"opacity":"0", "display":"inline-block"}).stop(true,false).animate({opacity:1});
		});		
	});
	
	$(".social-nav .social-previous, .social-nav .social-next").click(function(event) {
		var indexTab = $("ul.title li").index( $("ul.title li.active") );
		switch(indexTab)
		{
			case 0:
				$(".tab-tumblr").click();
				break;
			case 1:
			case 2:
			default:
				$(".tab-tweets").click();
				break;
		}
	});
	/*
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
	*/
	$("#tabs-1 > div").mCustomScrollbar({
		scrollButtons:{
			enable:true
		},
		advanced:{
	        updateOnContentResize: true
	    }
	});
/*
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
				},
				advanced:{
			        updateOnContentResize: true
			    }
			});
		}
	});
	*/
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
				},
				advanced:{
			        updateOnContentResize: true
			    }
			});
		}
	});
	
});