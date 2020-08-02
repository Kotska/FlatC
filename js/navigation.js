jQuery(document).ready(function ($) {

	// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
	let vh = window.innerHeight * 0.01;
	// Then we set the value in the --vh custom property to the root of the document
	document.documentElement.style.setProperty('--vh', `${vh}px`);

	// We listen to the resize event
	window.addEventListener('resize', () => {
	// We execute the same script as before
	let vh = window.innerHeight * 0.01;
	document.documentElement.style.setProperty('--vh', `${vh}px`);
  });


	// Loading animation
	function hideLoader() {
		setTimeout(function(){
		$('.loader').addClass('hide');
		$('.loader-gif').addClass('hidden');
		setTimeout(function(){ 
			$('.loader').css({'display': 'none'});
		}, 500);
	}, 500);
	}
	
	hideLoader();
	

	function showLoader() {
		$('.loader').css({'display': 'flex'});
		setTimeout(function(){ 
			$('.loader').removeClass('hide');
			$('.loader-gif').removeClass('hidden');
		}, 50);
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

	function portfolioRender() {
		var tl = gsap.timeline();
		var tl2 = gsap.timeline();
		var tl3 = gsap.timeline();
		var duration = 0.2;
		var container = $('.col-container');
		var border = $('.border');
		var col1 = $('.col1');
		var portfolioURL = $('.portfolio-item.active').data('item-url');
		var portfolioTitle = $('.portfolio-item.active').data('item-name');
		var backgroundColor = $('.portfolio-item.active').data('background-color');
		var desktopImage = $('#desktop-image, #tablet-image');
		var desktopImageURL = $('.portfolio-item.active').data('desktop-image');
		var tabletImageURL = $('.portfolio-item.active').data('tablet-image');
		var mobileImage = $('#mobile-image');
		var mobileImageURL = $('.portfolio-item.active').data('mobile-image');
		var mobileHeight = ($('#mobile-image').height()) + $(window).height();
		var colors = $('.col-container, .border, li.active');
		$('.portfolio-item').css({'background-color': '#696a69'})


		tl.delay(duration);
		tl.to(border, {height: '0', duration: duration, ease: 'linear'});
		tl.to(col1, {width: '100vw', duration: duration, ease: 'linear'});
		tl.to(col1, {left: '100vw', duration: duration, ease: 'linear'});
		tl.to(col1, {left: 'auto', duration: 0, ease: 'linear'});
		tl.to(col1, {width: '0', duration: 0, ease: 'linear'});
		tl.to(col1, {width: '33.33vw', duration: duration, ease: 'linear'});
		tl.to(border, {height: '100', duration: duration, ease: 'linear'});

		tl2.to(desktopImage, {x: '+=200%', duration: duration, ease: 'linear'});
		tl2.to(desktopImage, {opacity: 0, duration: 0, ease: 'linear'});
		tl2.to(mobileImage, {top: '-' + mobileHeight + 'px', duration: duration, ease: 'linear', onComplete: setImage})
		tl2.to(container, {width: '0', duration: duration, ease: 'linear', onComplete: setText});
		tl2.to(container, {width: '100vw', duration: 0, ease: 'linear'});
		tl2.to(container, {right: '100vw', duration: 0, ease: 'linear'});
		tl2.to(container, {right: '0', duration: duration, ease: 'linear', onComplete: showDesk});
		tl2.to(container, {width: '66.66vw', duration: duration, ease: 'linear'});
		tl2.to(desktopImage, {x: '-=200%', duration: duration, ease: 'linear'});
		tl2.to(mobileImage, {top: 'auto', duration: 0, ease: 'linear'});
		tl2.to(mobileImage, {bottom: '-' + mobileHeight + 'px', duration: 0, ease: 'linear'});
		tl2.to(mobileImage, {bottom: 'auto', duration: duration, ease: 'linear'});
		tl2.to(mobileImage, {top: 'auto', duration: duration, ease: 'linear'})


		if (backgroundColor != '#') {
			colors.css({'background-color': backgroundColor});
		} else {
			colors.css({'background-color': '#1181b2'});
		}
		
		
		function showDesk () {
			gsap.to(desktopImage, {opacity: 1, duration: 0, ease: 'linear'});
		}

		// Setting text
		function setText() {
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
		}

		// Setting image
		function setImage() {
			if (desktopImageURL == '#') {
				$('#desktop-image').css({'display': 'none'});
			} else {
				$('#desktop-image').css({'display': 'block'});
				$('#desktop-image').attr('src', desktopImageURL);
			}
			if (tabletImageURL == '#') {
				$('#tablet-image').css({'display': 'none'});
			} else {
				$('#tablet-image').css({'display': 'block'});
				$('#tablet-image').attr('src', tabletImageURL);
			}
			if (mobileImageURL == '#') {
				$('#mobile-image').css({'display': 'none'});
			} else {
				$('#mobile-image').css({'display': 'block'});
				$('#mobile-image').attr('src', mobileImageURL);
			}
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

		var ts;
		$(document).bind('touchstart', function (e) {
			ts = e.originalEvent.touches[0].clientY;
		});

		$(document).bind('touchend', function (e) {
			if (isScroll == true) {
				var te = e.originalEvent.changedTouches[0].clientY;
				if (ts > te + 5) {
					direction = 'next';
				} else if (ts < te - 5) {
					direction = 'prev';
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
			}, 1500);

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
				}, 1500);
		}
	});

	// Ajax loading
	$('.col2').on('click', function (e) {
		link = $('.col2').data('link');
		ajaxLoading(link);
	});

	$('.col3').on('click', function (e) {
		link = $('.col3').data('link');
		ajaxLoading(link);
	});

	$('.site-title').on('click', function (e) {
		e.preventDefault();
		link = $(e.target).attr('href');
		ajaxLoading(link);
	});


	function ajaxLoading (link) {
		showLoader();
		var link = link;
		$.ajax({
			async: true,
			type: "POST",
			url: link,
			contentType: "application/json",
			success: function(response){
				var newDoc = document.open("text/html", "replace");
				newDoc.write(response);
				newDoc.close();
				window.history.pushState({}, '', link);
			},
			error: function(response){
				console.log(nope);
				console.log(response);
			}
		 });
	}

	window.addEventListener("popstate", function(e) {
		window.location.href = location.href;
	});

	(function() { 
        const classes = document.body.classList;
        let timer = 0;
        window.addEventListener('resize', function () {
            if (timer) {
                clearTimeout(timer);
                timer = null;
            }
            else
                classes.add('stop-transitions');

            timer = setTimeout(() => {
                classes.remove('stop-transitions');
                timer = null;
            }, 100);
        });
    })();

});