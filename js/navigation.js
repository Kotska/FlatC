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

	//Portfolio

	function portfolioRender() {
		var portfolioURL = $('.portfolio-item.active').data('item-url');
		var portfolioTitle = $('.portfolio-item.active').data('item-name');
		$('#portfolio-title').text(portfolioTitle);
		if (portfolioURL != '#'){
			$('#portfolio-title-text').attr('href', portfolioURL);
			$('#portfolio-link-text').attr('href', portfolioURL);
			$('#portfolio-link').text(portfolioURL);
		} else {
			$('#portfolio-title-text').removeAttr('href');
			$('#portfolio-link-text').removeAttr('href');
			$('#portfolio-link').text('');
		}
		console.log(portfolioURL);
	}

	portfolioRender();
	$(window).bind('wheel', function(e){
		if (isScroll == true) {
			var direction = e.originalEvent.wheelDelta;
			if (direction > 0) {
				direction = 'prev';
			} else {
				direction = 'next';
			}
			isScroll = false;
			portfolioScroll(direction);
		}

	});

	var isScroll = true;
	function portfolioScroll (direction) {
		var itemArray = $('.portfolio-item');
		var itemCount = $('.portfolio-item').size();
		var currentItem = itemArray.index($('.active'));
		$('.portfolio-item.active').removeClass('active');
		if (direction == 'next') {
			var nextItem = currentItem + 1;
			if (nextItem >= itemCount){
				nextItem = 0;
			}
			$(itemArray[nextItem]).addClass('active');

		} else if (direction == 'prev') {
			var prevItem = currentItem - 1;
			
			if (prevItem < 0){
				prevItem = itemCount - 1;
			}
			$(itemArray[prevItem]).addClass('active');
		}
		portfolioRender();
		setTimeout(
			function() 
			{
				isScroll = true;
			}, 500);;
		
	}
});