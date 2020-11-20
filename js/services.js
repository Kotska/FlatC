jQuery(document).ready(function ($) {
    var desc = $('.desc > p');
    var descH3 = $('.desc > h3');
    var descCont = $('li.active').data('srv-content');
    var descTitle = $('li.active').html();
    var descImage = $('li.active').data('srv-image');

    $(desc).html(descCont);
    $(descH3).html(descTitle);
    $('.desc .background').css('background-image', 'url("' + descImage + '")');
    function render(content, title, target, descImage) {
        var cont = $('.desc');
        var tl = gsap.timeline();
        var duration = 0.5;
        var height = $(cont).outerHeight();

        if (window.matchMedia('(max-width: 768px)').matches) {
            $('.active').removeClass('active');
            $(target).addClass('active');
            tl.to(cont, {top: -height, duration: duration });
            $(desc).html(content);
            $(descH3).html(title);
            $('.desc .background').css('background-image', 'url("' + descImage + '")');
            tl.to(cont, {top: 'auto', duration: duration });
        }

        if (window.matchMedia('(min-width: 768px)').matches) {
            $('.active').removeClass('active');
            $(target).addClass('active');
            gsap.to(desc, {text: content});
            gsap.to(descH3, {text: title});
            $('.desc .background').css('background-image', 'url("' + descImage + '")');
        }


    };

    $('.name').on('click', function(e){
        if($(e.target).hasClass('srv-item')) {
            var content = $(e.target).data('srv-content');
            var title = $(e.target).html();
            var descImage = $(e.target).data('srv-image');
            var target = e.target;
            render(content, title, target, descImage);
        }
    });

    $(window).bind('wheel', function (e) {
        var direction = e.originalEvent.wheelDelta;
        if (direction > 0) {
            direction = -1;
        } else {
            direction = 1;
        }
        index = $('.srv-item.active').index() + direction;
        if(index  + 1 > $('.srv-item').length){
            index = 0;
        } else if (index < 0) {
            index = $('.srv-item').length - 1;
        }
        $('.srv-item').eq(index).trigger('click');
    });
    
});