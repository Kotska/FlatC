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
});