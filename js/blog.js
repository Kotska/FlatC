(function ($) {
  function init() {
    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty("--vh", `${vh}px`);

    // We listen to the resize event
    window.addEventListener("resize", () => {
      // We execute the same script as before
      let vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty("--vh", `${vh}px`);
    });

    // let themeColorName = "theme_"+Math.floor((Math.random() * 4) + 1);
    // $('body').addClass(themeColorName);
    $("body").addClass("theme_3");
  }

      // Post list background hover
      function initPost() {
        $(".post-cont").on("mouseenter", function (e) {
          $(this).addClass("hovered");
          $(this).find(".post-cont-bg").css({ left: "40%" });
          $(this)
            .find(".post-cont-bg")
            .finish()
            .animate({ right: "0%" }, { duration: 400, easing: "easeOutCubic" });
        });
        $(".post-cont").on("mouseleave", function (e) {
          $(this)
            .find(".post-cont-bg")
            .finish()
            .animate(
              { left: "100%" },
              {
                duration: 400,
                easing: "easeOutCubic",
                complete: function () {
                  $(this).css({ left: "40%", right: "100%" });
                },
              }
            );
          $(this).removeClass("hovered");
        });
        $(".post-cont").on("click", function (e) {
          e.preventDefault();
          if (
            !$(e.target).hasClass("post-category") &&
            !$(e.target).hasClass("post-thumbnail") &&
            !$(e.target).hasClass("bg-image") &&
            !$(e.target).hasClass("categories")
          ) {
            console.log($(e.target));
            $(this).find(".post-thumbnail").trigger("click");
          }
        });
      }

  $(document).ready(function () {
    init();
    initPost();

    // Scroll category
    // Variable to store current X scrolled position.
    var toScroll = 0;
    // Pixel increment you wish on each wheel spin.
    var ScrollX_pixelPer = 40;

    var totalScrollLeft = $('.category-list').width() - $('.cat-asd').width();
    var scrollSpeed = $('.category-list').width()/1;
    //Hide arrow if list doesn't overflow
    if($('.cat-asd')[0].scrollWidth > $('.category-list').width()){
      $('.arrow-right').hide();
      $('.arrow-left').hide();
    }

    // Clicking nav
    $('.arrow-left').on({'mousedown touchstart': function(){
      $('.arrow-right').css({visibility: 'visible'});
      $('.cat-asd').animate({scrollLeft: 0}, scrollSpeed, function(){$('.arrow-left').css({visibility: 'hidden'});});
    },
    'mouseup touchend': function () {
      $('.cat-asd').stop(true);
    }
    });
    $('.arrow-right').on({'mousedown touchstart': function(){
      $('.arrow-left').css({visibility: 'visible'});
      $('.cat-asd').animate({scrollLeft: totalScrollLeft}, scrollSpeed, function(){$('.arrow-right').css({visibility: 'hidden'});});
    },
    'mouseup touchend': function () {
      $('.cat-asd').stop(true);
    }
    });

    // Scrolling nav
    $('.cat-asd').on('mouseenter', function(e){
      let current = $('body').scrollTop();

      $('body').on('scroll', function(e) {
        $('body').scrollTop(current);
      });

      var $target = $(this);

      $('body').on('wheel', function(e){
        var delta = ScrollX_pixelPer*(parseInt(e.originalEvent.deltaY)/100);
        toScroll += delta;
        if(toScroll < 0){
          toScroll = 0
          $('.arrow-left').css({visibility: 'hidden'});
        } else {
          $('.arrow-left').css({visibility: 'visible'});
        }
        if(toScroll > ($($target)[0].scrollWidth - $($target).width())){
          toScroll = $($target)[0].scrollWidth - $($target).width()
          $('.arrow-right').css({visibility: 'hidden'});
        } else {
          $('.arrow-right').css({visibility: 'visible'});
        }
        $($target).scrollLeft(toScroll);
      });

    }).on('mouseleave', function(e){
      $('body').off('scroll').off('wheel');
      $("body").scroll(function () {
        didScroll = true;
      });
    });

    if ($(".splide").length) {
      new Splide(".splide", {
        type: "slide",
        perPage: 4,
        pagination: false,
        gap: 30,
        lazyLoad: true,
        fixedWidth: 255,
        breakpoints: {
          1024: {
            perPage: 3,
            fixedWidth: 289,
          },
          768: {
            perPage: 2,
            fixedWidth: false,
          },
          480: {
            perPage: 1,
            fixedWidth: false,
          },
        },
      }).mount();
    }

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $("#masthead").outerHeight();
    $("body").scroll(function () {
      didScroll = true;
    });

    setInterval(function () {
      if (didScroll) {
        hasScrolled();
        didScroll = false;
      }
    }, 250);

    function hasScrolled() {
      var st = $("body").scrollTop();
      if (Math.abs(lastScrollTop - st) <= delta) return;

      if (st > lastScrollTop && st > navbarHeight) {
        $("#masthead").removeClass("nav-down").addClass("nav-up");
      } else {
        if (st + $(window).height() < $(document).height()) {
          $("#masthead").removeClass("nav-up").addClass("nav-down");
        }
      }

      lastScrollTop = st;
    }

    var inputTimeOut;
    $(".search-input").on("input", function () {
      $(".searching-results").css("display", "flex");
      $(".slider-list").hide();
      $(".latest-post").hide();
      $(".latest-post-list").hide();
      $(".no-results").css("display", "none");
      clearTimeout(inputTimeOut);
      inputTimeOut = setTimeout(function () {
        var searchTerm = $(".search-input").val();
        if (searchTerm != "" && searchTerm != undefined && searchTerm != null) {
          $.ajax({
            url: ajax.url,
            data: {
              action: "flatc_ajax_search",
              search_term: searchTerm,
            },
            success: function (res) {
              $(".searching-results").css("display", "none");
              if ($(res.data)[0] == undefined) {
                $(".no-results").css("display", "flex");
              } else {
                $(".no-results").css("display", "none");
                $(".latest-post-list")[0].after($(res.data)[0]);
                initPost();
              }
            },
            error: function (res) {
              console.log(res);
            },
          });
        } else {
          $(".slider-list").show();
          $(".latest-post").show();
          $(".latest-post-list").show();
          $(".search-results").remove();
          $(".no-results").css("display", "none");
          $(".searching-results").css("display", "none");
        }
      }, 1000);
    });

    function closePost() {
      $(".post-container").remove();
      $(".post-overlay").remove();
      window.history.pushState({}, "", window.location.origin + "/blog");
    }

    $("main a").on("click", function openLink(e) {
      if (
        $(e.target).parents().hasClass("menu-item") ||
        $(e.target).hasClass("post-category")
      )
        return;
      e.preventDefault();
      let url =
        $(e.target).parents("a").attr("href") ?? $(e.target).attr("href");
      $("main").append(
        '<div class="post-container" style="display: none;"><div class="post-modal"><div class="post-content-container"></div></div></div>'
      );
      $("main").append(
        '<div class="post-overlay" style="display: none;"></div>'
      );
      $(".post-overlay").fadeIn();
      $(".post-container").fadeIn();
      $.ajax({
        url: url,
        dataType: "html",
        success: function (res) {
          var matches = res.match(/<article\b[^>]*[^>]*>([\s\S]*?)<\/article>/);
          let htmlObj = $(matches[0]);
          $(".post-content-container").html(htmlObj);
          window.history.pushState({}, "", url);
        },
        errorr: function (res) {
          console.log(res);
        },
      });
      $(".post-modal").append('<button class="post-close">✕</button>');
      $(".post-close").on("click", function (e) {
        closePost();
      });
      $(".post-container").on("click", function (e) {
        if ($(e.target).hasClass("post-container")) closePost();
      });
    });
  });
})(jQuery);
