(function ($) {
  $(document).ready(function () {
    $(".btn-contact").on("click", function (e) {
      e.preventDefault();
      $(".contact-form").slideDown();
    });

    $(".btn-submit").on("click", function (e) {
      e.preventDefault();
      $("#flatc-contact-form").submit();
    });

    $("#flatc-contact-form").on("submit", function (e) {
      e.preventDefault();

      const form = $(this),
      name = form.find("#form-name").val(),
      email = form.find("#form-email").val(),
      phone = form.find("#form-phone").val(),
      message = form.find("#form-message").val(),
      ajaxurl = form.data('url');
      
      if( name === '' ){
          $('#form-name').addClass('error');
          return;
      }

      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            phone: phone,
            name: name,
            email: email,
            message: message,
            action: 'flatc_save_user_contact_form'
        },
        success: function(res){
            console.log(res);
        },
        error: function(res){
            console.log(res);
        }
      });
    });
  });
})(jQuery);
