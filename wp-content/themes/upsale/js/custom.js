jQuery(window).load(function() {
    /*
    Loader
    ----------------*/
    jQuery('.loader').fadeOut(1000);
});

jQuery(document).ready(function($) {
    /*
    Sticky Header
    -----------------*/
    $('.site-header').addClass("sticky-header");
    // $(window).scroll(function() {
    // 	if ($(this).scrollTop() > 100){  
    // 	    $('.site-header').addClass("sticky-header");
    // 	  }
    // 	  else{
    // 	    $('.site-header').removeClass("sticky-header");
    // 	  }
    // });

    /*
    Carousel
    ---------------*/
    $(".images-carousel .panel-grid-cell").slick({
        dots: true,
        arrows: false,
        infinite: true,
        // centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        // variableWidth: true,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 780,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /*
    Testimonial Carousel
    --------------*/
    $(".testimonial-carousel .panel-grid-cell").slick({
        dots: true,
        arrows: false,
        infinite: true,
        // centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // variableWidth: true,
        autoplay: true,
        autoplaySpeed: 8000,
    });

    /*
    Slider Carousel
    --------------*/
    $(".post-slider").slick({
        dots: true,
        arrows: false,
        infinite: true,
        // centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // variableWidth: true,
        autoplay: true,
        autoplaySpeed: 8000,
        adaptiveHeight: true,
    });


    /*
    Popup
    --------------------*/
    $('.open-popup .textwidget > p > a, .blog-subscriber').magnificPopup({
        type: 'inline',
        midClick: true
    });

    /*
    Share
    -----------------*/
    $('.blog-share').click(function() {
        $('#custom-share').fadeToggle(500);
    });

    /*
    Search Form
    -----------------*/
    if ($('#searchform').length > 0) {
        $('#searchform').submit(function(e) {
            e.preventDefault();


            var search = $('#searchform .field').val();

            jQuery.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: "upsale_search_ajax",
                    's': search,
                },
                success: function(response) {
                    // if (data.success) {
                    $('#searchform').trigger('reset');
                    var obj = $.parseJSON(response);
                    console.log(obj.result);
                    setTimeout(function() {
                        $('.cont-post').html(obj.result);
                        $('.c-pagination').html('');
                    }, 100);
                    // } else {
                    //     // show data.message for error
                    // }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // server unknow error
                }
            });
        });

        // close validation message
        $('.sef-val-close').click(function(e) {
            e.preventDefault();
            $(this).parent().fadeOut();
        });
    }
});

jQuery('.anchor-link').click(function (e) {
    e.preventDefault();
    var target = jQuery(jQuery(this).attr('href'));
    if (target.length) {
        var scrollTo = target.offset().top;
        jQuery('body, html').animate({ scrollTop: scrollTo + 'px' }, 800);
    }
});