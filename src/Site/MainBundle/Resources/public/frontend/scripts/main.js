$(function () {
  // Video Main
  $('.wrap-video .video').vide('/bundles/sitemain/frontend/video/video2.mp4', {
    muted: true,
    loop: true,
    autoplay: true,
    position: '50% 50%', // Similar to the CSS `background-position` property.
    resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  });

  // Video Main
  $('.background-video .video').vide('/bundles/sitemain/frontend/video/video2.mp4', {
    muted: true,
    loop: true,
    autoplay: true,
    position: '50% 50%', // Similar to the CSS `background-position` property.
    resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  });

  // Video
  //$('.block2 .video').vide('video/video.mp4', {
  //  muted: true,
  //  loop: true,
  //  autoplay: true,
  //  position: '50% 50%', // Similar to the CSS `background-position` property.
  //  resizing: true // Auto-resizing, read: https://github.com/VodkaBears/Vide#resizing
  //});

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
  $(".menu-left").sticky({topSpacing: 0});

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

  var scrollable = $('.wrap-st-content, .wrap-st-content .st-content');
  scrollable.on('scroll.wow', function(){
    scrollable.find('.wow:not(.animated):in-viewport').removeAttr('style').addClass('animated');
  });

  /* ---------------------------------------------- /*
   * Portfolio
   /* ---------------------------------------------- */

    if($('.block-portfolio').length > 0){
        Code.photoSwipe('a', '.block-portfolio');
    }

});
