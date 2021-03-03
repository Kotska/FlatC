(function ($) {
    $(document).ready(function() {

        let size = null;
        const white = '#fff';
        const black = '#404040';
        function whiteOn () {
            $('h1').css({'color': white});
            $('h2').css({'color': white});
            $('.email').css({'color': white});
            $('.phone-number').css({'color': white});
            $('.btn-contact').css({'border-color': white});
            $('.email-image').css({'filter': 'invert(1)'});
            $('.phone-image').css({'filter': 'invert(1)'});
        }

        function whiteOff () {
            $('h1').css({'color': black})
            $('h2').css({'color': black})
            $('.email').css({'color': black});
            $('.phone-number').css({'color': black});
            $('.btn-contact').css({'border-color': 'black'});
            $('.background-overlay').css({'width': '0', 'height': '0'});
            $('.email-image').css({'filter': 'invert(0)'});
            $('.phone-image').css({'filter': 'invert(0)'});
        }

        $('.btn-contact').on('mouseover', function(e) {
            if($(e.target).hasClass('background-overlay')){
                whiteOff();
                return
            }
            if($(window).width() > $(window).height()){
                size = $(window).innerWidth();
            } else {
                size = $(window).innerHeight();
            }
            size = size * 2.5
            $('.background-overlay').css({'width': size, 'height': size});
            whiteOn();

        });
        $('.btn-contact').on('mouseleave', function() {
            whiteOff();
        });

        $('.btn-contact').on('click', function(e){
            e.preventDefault();
            whiteOff();
            $('.contact-form').slideDown();
        })

        $('.close').on('click', function(e) {
            $('.contact-form').slideUp();
        })
    });
})(jQuery);