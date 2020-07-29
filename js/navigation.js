jQuery(document).ready(function($){
	// define constants
	const col2Title = $('.col2-title').text();
	const col3Title = $('.col3-title').text();

	// toggle nav menu class
	$('#nav-btn').on('click', function(e) {
		if ($('#nav-btn').hasClass('open')){
			$('.nav-list').removeClass('bottom100');
			setTimeout( function() {
					$('#nav-btn').toggleClass('open');
					$('#nav-overlay').toggleClass('open');
				}, 300);
		} else {
			$('#nav-btn').toggleClass('open');
			$('#nav-overlay').toggleClass('open');
			setTimeout( function() {
				$('.nav-list').addClass('bottom100');
			}, 380);
		}
	});

	// columns hover text change with gsap
	$('.col2').on('hover', function(e){
		gsap.to($('.col2-title'), {duration: 1, text: 'What?', ease: 'none'});
	});
	$('.col2').on('mouseleave', function(e){
		gsap.to($('.col2-title'), {duration: 1, text: col2Title, ease: 'none'});
	});

	$('.col3').on('hover', function(e){
		gsap.to($('.col3-title'), {duration: 1, text: 'What?', ease: 'none'});
	});
	$('.col3').on('mouseleave', function(e){
		gsap.to($('.col3-title'), {duration: 1, text: col3Title, ease: 'none'});
	});
	
	$('.blog-text')
	.mouseover(function(){
		$('.blog').addClass('hovered');
	})
	.mouseleave(function(){
		$('.blog').removeClass('hovered');
	});
});