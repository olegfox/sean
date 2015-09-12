$(function () {
  //// Video Main
  //$('.wrap-video .video').vide('/bundles/sitemain/frontend/video/video2.mp4', {
  //  muted: true,
  //  loop: true,
  //  autoplay: true,
  //  position: '50% 50%', // Similar to the CSS `background-position` property.
  //  resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  //});
  //
  //// Video Main
  //$('.background-video .video').vide('/bundles/sitemain/frontend/video/video2.mp4', {
  //  muted: true,
  //  loop: true,
  //  autoplay: true,
  //  position: '50% 50%', // Similar to the CSS `background-position` property.
  //  resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  //});
  //
  //Video
  $('.line-video-border').vide('/bundles/sitemain/frontend/video/video2.mp4', {
    muted: true,
    loop: true,
    autoplay: true,
    position: '50% 50%', // Similar to the CSS `background-position` property.
    resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  });

  // Review Slider
  $('.reviews').slick({
    dots: false,
    infinite: true,
    speed: 500,
    fade: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000
  });

  // Sticky Menu
  $(".menu-left").sticky({topSpacing: 50});
  $("header .wrap-head2").sticky({topSpacing: 0});
    $("header .wrap-head2").on('sticky-start', function(){
        $("header .wrap-head2 .logo").css({
            'height': '69px'
        });
        $("header .wrap-head2 .logo a").css({
            'height': 0
        });
        $("header .wrap-head2 .top").css({
            'display': 'none'
        });
        $("header .wrap-head2").css({
            'height': '50px'
        });
        $("header .wrap-head2 hr").css({
            'top': '-81px'
        });
    });
    $("header .wrap-head2").on('sticky-end', function(){
        $("header .wrap-head2 .logo").css({
            'height': '130px'
        });
        $("header .wrap-head2 .logo a").css({
            'height': '103px'
        });
        $("header .wrap-head2 .top").css({
            'display': 'block'
        });
        $("header .wrap-head2").css({
            'height': 'auto'
        });
        $("header .wrap-head2 hr").css({
            'top': '0px'
        });
    });

  // Ripple effect
  $('.grid-main').imagesLoaded(function(){
    $('.grid-main .wrap-box a.first').ripples({
      resolution: 256,
      dropRadius: 20,
      perturbance: 0.04,
      interactive: true
    });
  });

  /* ---------------------------------------------- /*
   * Wow Effects
   /* ---------------------------------------------- */

  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) == false){
    function wowInit(){
      var wow = new WOW(
        {
          boxClass: 'wow',      // animated element css class (default is wow)
          animateClass: 'animated', // animation css class (default is animated)
          offset: 0,          // distance to the element when triggering the animation (default is 0)
          mobile: true,       // trigger animations on mobile devices (default is true)
          live: true        // act on asynchronously loaded content (default is true),
        }
      );
      wow.init();
    }

    wowInit();
    $(window).resize(function(){
      wowInit();
    });
  }

  if($(".wrap-container-box").length > 0){
      var scrollable = $('.wrap-container-box');
  }else{
      var scrollable = $('.wrap-st-content .st-content');
  }

  scrollable.on('scroll.wow', function(){
    scrollable.find('.wow:not(.animated):in-viewport').removeAttr('style').addClass('animated');
  });

  /* ---------------------------------------------- /*
   * Portfolio
   /* ---------------------------------------------- */

    if($('.block-portfolio .gallery').length > 0){
        Code.photoSwipe('a', '.inner_block_portfolio');
    }

    /* ---------------------------------------------- /*
     * Forms
     /* ---------------------------------------------- */

    $(".callback").colorbox({
        html: $(".callback-form").html(),
        onComplete: function(){
            $("#cboxContent form").validate({
                messages: {
                    "site_mainbundle_callback[name]": "Введите имя!",
                    "site_mainbundle_callback[phone]": "Введите телефон!"
                },
                showErrors: function(errorMap, errorList) {
                    this.defaultShowErrors();
                    $.colorbox.resize();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        beforeSubmit: function(arr, $form, options) {
                            $("#cboxLoadedContent").html('<div class="alert alert-success" role="alert">Сообщение успешно отправлено!</div>');
                            $.colorbox.resize();
                        }
                    });
                }
            });
        }
    });

    $(".feedback").colorbox({
        html: $(".contact-form").html(),
        onComplete: function(){
            $("#cboxContent form").validate({
                messages: {
                    "site_mainbundle_feedback[name]": "Введите имя!",
                    "site_mainbundle_feedback[email]": "Введите email!"
                },
                showErrors: function(errorMap, errorList) {
                    this.defaultShowErrors();
                    $.colorbox.resize();
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        beforeSubmit: function(arr, $form, options) {
                            $("#cboxLoadedContent").html('<div class="alert alert-success" role="alert">Сообщение успешно отправлено!</div>');
                            $.colorbox.resize();
                        }
                    });
                }
            });
        }
    });

});
