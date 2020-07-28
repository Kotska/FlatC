jQuery(document).ready(function($){
	$(".nav-list-li").toggle();
	$('#nav-btn').on('click', function(e) {
		if ($('#nav-btn').hasClass('open')){
			$(".nav-list-li").slideUp();
			setTimeout( function() {
					$('#nav-btn').toggleClass('open');
					$('#nav-overlay').toggleClass('open');
				}, 300);
		} else {
			$('#nav-btn').toggleClass('open');
			$('#nav-overlay').toggleClass('open');
			setTimeout( function() {
				$(".nav-list-li").slideDown();
			}, 200);
		}
	});
});