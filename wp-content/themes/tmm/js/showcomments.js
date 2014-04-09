$(document).ready(function() {
	$('.commentlist li .children').hide();
	$('.commentlist li .children').addClass('hide');
	
	// Show child comments
	 $('.comment-respon').bind('click',function(e){
	    	$paren = $(this).parent();
	    	if($paren.children('.children').hasClass('show')){
	    		$paren.children('.children').hide('fast');
	    		$paren.children('.children').addClass('hide');
	    		$paren.children('.children').removeClass('show');
	    	} else {
	    		$paren.children('.children').addClass('show');
	    		$paren.children('.children').removeClass('hide');
	    		$paren.children('.children').show('fast');
	    	}	    	
	 });
});