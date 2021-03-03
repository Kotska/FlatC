var pageLoaded = false;
var timeoutElapsed = false;

// Loading animation
function hideLoader() {
	setTimeout(function () {
		jQuery('.loader').addClass('hide');
		jQuery('.loader-gif').addClass('hidden');
		setTimeout(function () {
			jQuery('.loader').css({ 'display': 'none',});
			// jQuery('.loader').css({ 'display': 'none', 'animation': 'fadeOut forwards', 'animation-delay': '500ms', 'animation-duration': '320ms' });
		}, 500);
	}, 500);
}

setTimeout(function () {
	timeoutElapsed = true;
	if (pageLoaded) {
		hideLoader();
	}
}, 350);



jQuery(document).ready(function ($) {

	function htmlDoc(html){
		var parent,
		elems       = $(),
		matchTag    = /<(\/?)(html|head|body|title|base|meta)(\s+[^>]*)?>/ig,
		prefix      = "ss" + Math.round(Math.random() * 100000),
		htmlParsed  = html.replace(matchTag, function(tag, slash, name, attrs) {
			var obj = {};
			if (!slash) {
				$.merge(elems, $("<" + name + "/>"));
				if (attrs) {
					$.each($("<div" + attrs + "/>")[0].attributes, function(i, attr) {
					obj[attr.name] = attr.value;
					});
				}
				elems.eq(-1).attr(obj);
			}
			return "<" + slash + "div" + (slash ? "" : " id='" + prefix + (elems.length - 1) + "'") + ">";
		});
	
	// If no placeholder elements were necessary, just return normal
	// jQuery-parsed HTML.
	if (!elems.length) {
		return $(html);
	}
	// Create parent node if it hasn"t been created yet.
	if (!parent) {
		parent = $("<div/>");
	}
	// Create the parent node and append the parsed, place-held HTML.
	parent.html(htmlParsed);
	
	// Replace each placeholder element with its intended element.
	$.each(elems, function(i) {
		var elem = parent.find("#" + prefix + i).before(elems[i]);
		elems.eq(i).html(elem.contents());
		elem.remove();
	});
	
	return parent.children().unwrap();
	}

	pageLoaded = true;
	if (timeoutElapsed) {
		hideLoader();
	}

	const loadingSVG = $('.loading-svg-front path');

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
	var sizeTime;

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
		
		clearTimeout(sizeTime);
		if ($('#nav-btn').hasClass('open')) return;
		sizeTime = setTimeout(function () {
			
			let maxHeight = $('#nav-overlay').height();
			let maxWidth = $('#nav-overlay').width();
			// let fontSize = $('#menu-main-menu').css('font-size').split('px')[0];
			// let fontInt = parseInt(fontSize);
			console.log(maxWidth);
			let fontInt = 14;
			do {
				textHeight = $('#menu-main-menu').height();
				textWidth = $('#menu-main-menu').width();
				fontInt = fontInt + 1;
				fontSize = fontInt + 'px';
				$('#menu-main-menu').css('font-size', fontSize);
			} while ((textHeight <= maxHeight && textWidth <= maxWidth));

			fontSize = $('#menu-main-menu').css('font-size').split('px')[0];
			fontInt = parseInt(fontSize) - 5;
			if(fontInt > 76) fontInt = 76;
			$('#menu-main-menu').css('font-size', fontInt + 'px');
		}, 300);


	});

	// columns hover text change with gsap
	$('.col2').on('mouseenter', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: 'Mutasd!', ease: 'none' });
	});
	$('.col2').on('mouseleave', function (e) {
		gsap.to($('.col2-title'), { duration: 1, text: col2Title, ease: 'none' });
	});

	$('.col3').on('mouseenter', function (e) {
		gsap.to($('.col3-title'), { duration: 1, text: 'Mivel?', ease: 'none' });
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
		let ajaxTime= new Date().getTime();
		showLoader();
		setTimeout(function(){window.location = link;}, 200)
		
		// $.ajax({
		// 	async: true,
		// 	type: "POST",
		// 	url: link,
		// 	contentType: "application/json",
		// 	success: function (response) {
		// 		let totalTime = new Date().getTime()-ajaxTime;
		// 		setTimeout(function () {
		// 			let newDoc = document.open("text/html");
		// 			newDoc.write(response);
		// 			newDoc.close();
		// 			window.history.pushState({}, '', link);
		// 		}, 1500 - totalTime);	
		// 	},
		// 	error: function (response) {
		// 		console.log(response);
		// 	}
		// });
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