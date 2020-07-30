jQuery(document).ready(function ($) {

	// Loading animation
	function hideLoader() {
		$('.loader').addClass('hide');
		$('.loader-gif').addClass('hidden');
	}
	hideLoader();

	function showLoader() {
		$('.loader').removeClass('hide');
		$('.loader-gif').removeClass('hidden');
	}

	// define constants
	const col2Title = $('.col2-title').text();
	const col3Title = $('.col3-title').text();

	// toggle nav menu class
	$('#nav-btn').on('click', function (e) {
		if ($('#nav-btn').hasClass('open')) {
			$('.nav-list').removeClass('bottom100');
			setTimeout(function () {
				$('#nav-btn').toggleClass('open');
				$('#nav-overlay').toggleClass('open');
			}, 300);
		} else {
			$('#nav-btn').toggleClass('open');
			$('#nav-overlay').toggleClass('open');
			setTimeout(function () {
				$('.nav-list').addClass('bottom100');
			}, 380);
		}
	});

	// columns hover text change with gsap
	$('.col2').on('hover', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: 'What?', ease: 'none' });
	});
	$('.col2').on('mouseleave', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: col2Title, ease: 'none' });
	});

	$('.col3').on('hover', function (e) {
		gsap.to($('.col3-title'), { duration: 1, text: 'What?', ease: 'none' });
	});
	$('.col3').on('mouseleave', function (e) {
		gsap.to($('.col3-title'), { duration: 1, text: col3Title, ease: 'none' });
	});

	$('.blog-text')
		.mouseover(function () {
			$('.blog').addClass('hovered');
		})
		.mouseleave(function () {
			$('.blog').removeClass('hovered');
		});

	//Portfolio

	var colorCount = 0;
	function portfolioRender() {
		var tl = gsap.timeline();
		var tl2 = gsap.timeline();
		var duration = 0.3;
		var container = $('.col-container');
		var border = $('.border');
		var col1 = $('.col1');
		var portfolioURL = $('.portfolio-item.active').data('item-url');
		var portfolioTitle = $('.portfolio-item.active').data('item-name');
		var colors = $('.col-container, .border, li.active');
		var colorArray = ['#ae2b24', '#ff007c', '#5877e8', '#a78169', '#1a1919', '#2f3b37', '#e5e5e5'];
		$('.portfolio-item').css({'background-color': '#696a69'})
		var color = colorArray[colorCount];

		tl.to(border, {height: '0', duration: duration, ease: 'linear'});
		tl.to(col1, {width: '100vw', duration: duration, ease: 'linear'});
		tl.to(col1, {left: '100vw', duration: duration, ease: 'linear'});
		tl.to(col1, {left: 'auto', duration: 0, ease: 'linear'});
		tl.to(col1, {width: '0', duration: 0, ease: 'linear'});
		tl.to(col1, {width: '33.33vw', duration: duration, ease: 'linear'});
		tl.to(border, {height: '100', duration: duration, ease: 'linear'});

		tl2.delay(duration);
		tl2.to(container, {width: '0', duration: duration, ease: 'linear'});
		tl2.to(container, {width: '100vw', duration: 0, ease: 'linear'});
		tl2.to(container, {right: '100vw', duration: 0, ease: 'linear'});
		tl2.to(container, {right: '0', duration: duration, ease: 'linear'});
		tl2.to(container, {width: '66.66vw', duration: duration, ease: 'linear'});

		colors.css({'background-color': color});
		


		$('#portfolio-title').text(portfolioTitle);
		if (portfolioURL != '#') {
			$('#portfolio-title-text').attr('href', 'http://' + portfolioURL);
			$('#portfolio-link-text').attr('href', 'http://' + portfolioURL);
			$('#portfolio-link').text(portfolioURL);
		} else {
			$('#portfolio-title-text').removeAttr('href');
			$('#portfolio-link-text').removeAttr('href');
			$('#portfolio-link').text('');
		}

		if (colorCount >= colorArray.length - 1) {
			colorCount = 0;
		} else {
			colorCount += 1;
		}

	}

	
	if ( $('body').hasClass('page-template-page-portfolio') ){
		portfolioRender();
		$(window).bind('wheel', function (e) {
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
	}


	var isScroll = true;
	function portfolioScroll(direction) {
		var itemArray = $('.portfolio-item');
		var itemCount = $('.portfolio-item').size();
		var currentItem = itemArray.index($('.active'));
		$('.portfolio-item.active').removeClass('active');
		if (direction == 'next') {
			var nextItem = currentItem + 1;
			if (nextItem >= itemCount) {
				nextItem = 0;
			}
			$(itemArray[nextItem]).addClass('active');

		} else if (direction == 'prev') {
			var prevItem = currentItem - 1;

			if (prevItem < 0) {
				prevItem = itemCount - 1;
			}
			$(itemArray[prevItem]).addClass('active');
		}
		portfolioRender();
		setTimeout(
			function () {
				isScroll = true;
			}, 500);

	}

	$('.portfolio-list').on('click', function(e){
		if (isScroll == true) {
			isScroll = false;
			var clicked = e.target;
			if ($(clicked).hasClass('portfolio-item') ) {
				$('.active').removeClass('active');
				$(clicked).addClass('active');
			}
			portfolioRender();
			setTimeout(
				function () {
					isScroll = true;
				}, 500);
		}
	});

	// Ajax loading
	$('.col2').on('click', function ajaxLoadPage(destination) {
		console.log('clicked');
		showLoader();
		var theUrl = 'http://localhost:8001/?page_id=8';
		$.ajax({
			async: true,   // this will solve the problem
			type: "POST",
			url: theUrl,
			contentType: "application/json",
			success: function(response){
				var newDoc = document.open("text/html", "replace");
				newDoc.write(response);
				newDoc.close();
				window.history.pushState({}, '', theUrl);
			},
			error: function(response){
				console.log(response);
			}
		 });
	});

	window.addEventListener("popstate", function(e) {
		window.location.href = location.href;
	});


});