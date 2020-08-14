jQuery(document).ready(function ($) {
    $('html body').css({'overflow': 'scroll'});
    $('.site-header').css({'background-color': 'white', 'z-index': '10', 'width': '66.66vw'});
    $('.post-cont').css({'left': 'auto'});

    function loadPost(paged){
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

    var catClick = true;
    
    function loadCat (cat){
        $.ajax({
            type: 'POST',
			url: ajaxpagination.ajax_url,
            data: {
                action: 'ajax_categories',
                postType: cat
            },
			success: function (response) {
                var parsed = $.parseHTML(response);
                $('.blog-list').append(parsed);
                var posts = $('.post-cont');
                gsap.to(posts, {left: 'auto', onComplete: function(){ catClick = true; }});
			},
			error: function (response) {
                console.log('Error: ' + response);
			}
		});
    }

    $('.cat-item').on('click', function(e){
        e.preventDefault();
        if(catClick == true){
            catClick = false;
            var link = e.target.href;
            var cat = e.target.innerHTML;
            var posts = $('.post-cont');
            gsap.to(posts, {left: '65vw', onComplete: function(){ $('.blog-list').empty(); loadCat(cat); }});
        }
    });
});