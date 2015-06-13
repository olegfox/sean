$(function () {
  // Video
  $('#video').vide('/bundles/sitemain/frontend/video/video.mp4', {
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
    fade: false
  });

  // Sticky Menu
  $(".menu-left").sticky({topSpacing: 0});

  /* ---------------------------------------------- /*
   * Scroll Animation
   /* ---------------------------------------------- */

  $('.menu-left li a').bind('click', function (e) {
    var anchor = $(this);
    if (!anchor.parent().hasClass('last')) {
      $('.menu-left li').removeClass('current');
      anchor.parent().addClass('current');

      if(anchor.attr('href') == $('.menu-left > ul > li:first > a').attr('href')){
        $('body').stop().animate({
          scrollTop: 0
        }, 1000);
      }else{
        $('body').stop().animate({
          scrollTop: $("*[id='"+anchor.attr('href')+"']").offset().top
        }, 1000);
      }
      if (window.history.pushState) {
        window.history.pushState(null, null, '/' + anchor.attr('href'));
      }
      e.preventDefault();
    }
  });

  $(window).scroll(function(){
    $('.content').each(function(i, e){
      if($(window).scrollTop() >= $(e).offset().top){
        $('.menu-left li').removeClass('current');
        $("a[href='"+$(e).attr('id')+"']").parent().addClass('current');
      }
    });
  });
});
