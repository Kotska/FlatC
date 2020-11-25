jQuery(document).ready(function ($) {
    let themeColorName = "theme_"+Math.floor((Math.random() * 4) + 1);
    $('body').addClass(themeColorName);

    new Splide( '.splide', {
        type: 'slide',
        perPage: 4,
        pagination: false,
        gap: 30,
        lazyLoad: true,
    }).mount();

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
});