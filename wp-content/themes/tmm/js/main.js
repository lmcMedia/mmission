var ytplayer;
function onYouTubeIframeAPIReady() {
	ytplayer = new YT.Player('player', {
		videoId : 'VyQxn8KD6YQ',
		playerVars: {
			allowScriptAccess: "always",
			wmode: "opaque"
		},
		events : {
		}
	});
}

var owl;
$(document).ready(function(e) {
	$('.close-video-home').click(function(event) {
		if(ytplayer) {
			ytplayer.destroy();
			owl.play();
		}
		
		$('.video-container').css({
			"display" : "none"
		});
	});

	$("#owl-demo").owlCarousel({
		autoPlay : 5000,
		navigation : true,
		slideSpeed : 2000,
		paginationSpeed : 2000,
		singleItem : true,
		transitionStyle : "fade",
	});
	
	//get carousel instance data and store it in variable owl
	owl = $("#owl-demo").data('owlCarousel');
	owl.stop(); // Autoplay Stop
	
});
