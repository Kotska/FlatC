jQuery(document).ready(function ($) {
    if ( $('body').hasClass('page-template-page-portfolio') ){
        
	function portfolioRender() {
		var tl = gsap.timeline();
		var tl2 = gsap.timeline();
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
		if (backgroundColor == '#'){
			backgroundColor = '#1181b2';
		}
		$('#nav-overlay li a').css({'color': backgroundColor});
		$('html').get(0).style.setProperty('--navColor', backgroundColor);
		console.log(backgroundColor);


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
		tl2.to(container, {right: '100vw', duration: 0, ease: 'linear', onComplete: setBackground});
		tl2.to(container, {right: '0', duration: duration, ease: 'linear', onComplete: showDesk});
		tl2.to(container, {width: '66.66vw', duration: duration, ease: 'linear'});
		tl2.to(desktopImage, {x: '-=200%', duration: duration, ease: 'linear'});
		tl2.to(mobileImage, {top: 'auto', duration: 0, ease: 'linear'});
		tl2.to(mobileImage, {bottom: '-' + mobileHeight + 'px', duration: 0, ease: 'linear'});
		tl2.to(mobileImage, {bottom: 'auto', duration: duration, ease: 'linear'});
		tl2.to(mobileImage, {top: 'auto', duration: duration, ease: 'linear'})

		
		function setBackground () {
			colors.css({'background-color': backgroundColor});
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
    
    $('.portfolio-list').on('click', function (e) {
		if (isScroll == true) {
			isScroll = false;
			var clicked = e.target;
			if ($(clicked).hasClass('portfolio-item')) {
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
});