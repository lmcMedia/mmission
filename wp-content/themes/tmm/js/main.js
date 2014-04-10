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
	$('.close-video-home').click(function(event) {
		if (ytplayer) {
			ytplayer.destroy();
		}

		$('.video-container').css({
			"display" : "none"
		});
	});
	
	$(".tab-tweets").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-tweets").parent().addClass("active");
		
		$("ul.content li:not(#tabs-1)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content li:not(#tabs-1)").css({"display": "none"});
			$("#tabs-1").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});
	});
	$(".tab-facebook").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-facebook").parent().addClass("active");
		
		$("ul.content li:not(#tabs-2)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content li:not(#tabs-2)").css({"display": "none"});
			$("#tabs-2").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});
		
	});
	$(".tab-tumblr").click(function(event) {
		$("ul.title li").removeClass("active");
		$(".tab-tumblr").parent().addClass("active");
		
		$("ul.content li:not(#tabs-3)").stop(true,false).animate({"opacity":"0"},function(){
			$("ul.content li:not(#tabs-3)").css({"display": "none"});
			$("#tabs-3").css({"opacity":"0", "display":"block"}).stop(true,false).animate({opacity:1});
		});
		
	});
});
