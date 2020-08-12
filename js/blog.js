jQuery(document).ready(function ($) {
    var posts = $('.post-cont');
    var prev = $('.prev svg');
    var next = $('.next svg');
    var paged = $('main').data('page');
    $('html body').css({'overflow': 'scroll'});
    $('.site-header').css({'background-color': 'white', 'z-index': '5', 'width': '66.66vw'});

    if (paged == 1) {
        $(prev).hide();
    }

    function loadPost(paged){
        for (var i = 0; i < 3; i++) {
            var posts = $('.post-cont');
            var title = $(posts[i]).find('h3');
            var excerpt = $(posts[i]).find('p');
            if(posts[i] != undefined) {
                gsap.to(title, {text: 'Loading...'});
                gsap.to(excerpt, {text: 'Loading...'});
            }
        }

        $.ajax({
            type: 'POST',
			url: ajaxpagination.ajax_url,
            data: {
                action: 'ajax_pagination',
                page: paged                
            },
			success: function (response) {
                var link = $('main').data('link');
                let getUrl = window.location;
                let baseUrl = getUrl.protocol + "//" + getUrl.host + "/";
                if (paged != 1) {
                    window.history.pushState({}, '', link + 'page/' + parseInt(paged));
                } else {
                    window.history.pushState({}, '', link );
                }
                $('main').data('page', paged);
                if (paged == 1) {
                    $(prev).hide();
                } else {
                    $(prev).show();
                }

                for (var i = 0; i < 3; i++) {
                    var colors = ['post-blue', 'post-grey', 'post-white'];
                    posts = $('.post-cont');
                    if(response.data[i] != undefined){
                        var newTitle = response.data[i].title;
                        var newExcerpt = response.data[i].excerpt;
                        var newLink = response.data[i].link;
                        if(posts[i]) {
                            var title = $(posts[i]).find('h3');
                            var excerpt = $(posts[i]).find('p');
                            var link = $(posts[i]).find('button');
                            $(link).data('link', newLink);
                            gsap.to(title, {text: newTitle});
                            gsap.to(excerpt, {text: newExcerpt});
                        } else {
                            $(posts[i-1]).after('<div class="post-cont '+colors[i]+'"><h3>'+newTitle+'</h3><p>'+newExcerpt+'</p><button data-link="'+newLink+'" class="readmore">Tovább</button></div>');
                        }
                    } else {
                        posts = $('.post-cont');
                        if(posts[i] != undefined) {
                           $(posts[i]).remove();
                        }
                    }

                  }
			},
			error: function (response) {

			}
		});
    };

    $('.prev').on('click', function(e){
        if (paged > 1){
            paged -= 1;
            loadPost(paged);
        }
        
    });
    $('.next').on('click', function(e){
        paged += 1;
        loadPost(paged);
    });
});