jQuery(document).ready(function ($) {
    var desc = $('.desc > p');
    var descH3 = $('.desc > h3');
    var descCont = $('li.active').data('srv-content');
    var descTitle = $('li.active').html();

    $(desc).html(descCont);
    $(descH3).html(descTitle);

    function render(content, title, target) {
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
            tl.to(cont, {top: 'auto', duration: duration });
        }

        if (window.matchMedia('(min-width: 768px)').matches) {
            $('.active').removeClass('active');
            $(target).addClass('active');
            gsap.to(desc, {text: content});
            gsap.to(descH3, {text: title});
        }


    };

    $('.name').on('click', function(e){
        if($(e.target).hasClass('srv-item')) {
            var content = $(e.target).data('srv-content');
            var title = $(e.target).html();
            var target = e.target;
            render(content, title, target);
        }
    });
});