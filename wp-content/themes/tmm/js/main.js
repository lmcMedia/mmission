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

$(function() {
	$( "#tabs" ).tabs();
});

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

});
