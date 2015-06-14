$(function(){
  $(".content").css({
    'height' : $(window).height()
  });

  $(".content .wrap_text").each(function(i, e){
    if(i == 0){
      $(e).css({
        'height' : $(window).height() - $(e).parent().find('.wrap_head').height() - $(e).parent().find('.footer').height() - $('.header-top').height()
      });
    }else{
      $(e).css({
        'height' : $(window).height() - $(e).parent().find('.wrap_head').height() - $(e).parent().find('.footer').height()
      });
    }
  });

  disable_scroll(0);

  /* ---------------------------------------------- /*
   * Scroll Animation
   /* ---------------------------------------------- */

  function disable_scroll(top) {
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('body').get(0).onscroll = function () {
        console.log('disable scroll');
        $('body').animate({
          scrollTop: top
        });
      };
    }
  }

  function enable_scroll() {
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('body').get(0).onscroll = function () {
        console.log('enable scroll');
      };
    }
  }

  $('.menu-left li a').bind('click', function (e) {
    var anchor = $(this);
    if (!anchor.parent().hasClass('last')) {
      $('.menu-left li').removeClass('current');
      anchor.parent().addClass('current');
      enable_scroll();
      if(anchor.attr('href') == $('.menu-left > ul > li:first > a').attr('href')){
        $('body').stop().animate({
          scrollTop: 0
        }, 1000, function(){
          disable_scroll($('body').scrollTop());
        });
      }else{
        $('body').stop().animate({
          scrollTop: $("*[id='"+anchor.attr('href')+"']").offset().top
        }, 1000, function(){
          disable_scroll($('body').scrollTop());
        });
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
