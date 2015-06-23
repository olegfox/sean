$(function () {
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
});
