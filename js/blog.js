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
    
    let themeColorName = "theme_"+Math.floor((Math.random() * 4) + 1);
    $('body').addClass(themeColorName);

    if ($( ".splide" ).length) {
        new Splide( '.splide', {
            type: 'slide',
            perPage: 4,
            pagination: false,
            gap: 30,
            lazyLoad: true,
            fixedWidth: 255,
            breakpoints: {
                1024: {
                    perPage: 3,
                    fixedWidth: 289
                },
                768: {
                    perPage: 2,
                    fixedWidth: false,
                },
                480: {
                    perPage: 1,
                    fixedWidth: false
                }
            }
        }).mount();
    }

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#masthead').outerHeight();
    $('body').scroll(function(){
        didScroll = true;
    });

    setInterval(function() {
        if(didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $('body').scrollTop();
        if(Math.abs(lastScrollTop - st) <= delta ) return;

        if(st > lastScrollTop && st > navbarHeight){
            $('#masthead').removeClass('nav-down').addClass('nav-up');
        } else {
            if(st + $(window).height() < $(document).height()) {
                $('#masthead').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }

    var inputTimeOut;
    $('.search-input').on('input', function(){
        $('.searching-results').css('display', 'flex');
        $('.slider-list').hide();
        $('.latest-post').hide();
        $('.latest-post-list').hide();
        $('.no-results').css('display', 'none');
        clearTimeout(inputTimeOut);
        inputTimeOut = setTimeout(function(){
            var searchTerm = $('.search-input').val();
            if (searchTerm != '' && searchTerm != undefined && searchTerm != null) {
                $.ajax({
                    url: ajax.url,
                    data: {
                        action: 'flatc_ajax_search',
                        search_term: searchTerm
                    },
                    success: function(res){
                        $('.searching-results').css('display', 'none');
                        if($(res.data)[0] == undefined ) {
                            $('.no-results').css('display', 'flex');
                        } else {
                            $('.no-results').css('display', 'none');
                            $('.latest-post-list')[0].after($(res.data)[0]);
                        }
                    },
                    error: function(res){
                        console.log(res);
                    }
                });
            } else {
                $('.slider-list').show();
                $('.latest-post').show();
                $('.latest-post-list').show();
                $('.search-results').remove();
                $('.no-results').css('display', 'none');
                $('.searching-results').css('display', 'none');
            }
        }, 1000);
    });
});