var pageLoaded = false;
var timeoutElapsed = false;

// Loading animation
function hideLoader() {
	setTimeout(function () {
		jQuery('.loader').addClass('hide');
		jQuery('.loader-gif').addClass('hidden');
		setTimeout(function () {
			jQuery('.loader').css({ 'display': 'none' });
		}, 500);
	}, 500);
}

setTimeout(function () {
	timeoutElapsed = true;
	if (pageLoaded) {
		hideLoader();
	}
}, 1000);


jQuery(document).ready(function ($) {

	pageLoaded = true;
	if (timeoutElapsed) {
		hideLoader();
	}

	const loadingSVG = $('.loading-svg-front path');

	for(let i = 0; i<loadingSVG.length; i++){
		console.log(`Letter ${i} is ${loadingSVG[i].getTotalLength()}`);
	}

	$('.site-branding svg').attr('preserveAspectRatio', 'xMinYMin meet');

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




	function showLoader() {
		$('.loading-svg-front').removeClass('forwards');
		$('.loading-svg-front').addClass('backwards');
		$('.loader').css({ 'display': 'flex' });
		setTimeout(function () {
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
	$('.col2').on('mouseenter', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: 'What?', ease: 'none' });
	});
	$('.col2').on('mouseleave', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: col2Title, ease: 'none' });
	});

	$('.col3').on('mouseenter', function (e) {
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

	$('.blog-text').on('click', function(){
		link = $('.blog-text').data('link');
		ajaxLoading(link);
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


	function ajaxLoading(link) {
		showLoader();
		var ajaxTime= new Date().getTime();
		var link = link;
		$.ajax({
			async: true,
			type: "POST",
			url: link,
			contentType: "application/json",
			success: function (response) {
				var totalTime = new Date().getTime()-ajaxTime;
				setTimeout(function () {
					var newDoc = document.open("text/html", "replace");
					newDoc.write(response);
					newDoc.close();
					window.history.pushState({}, '', link);
				}, 1500 - totalTime);
			},
			error: function (response) {
				console.log(nope);
				console.log(response);
			}
		});
	}

	window.addEventListener("popstate", function (e) {
		window.location.href = location.href;
	});

	(function () {
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