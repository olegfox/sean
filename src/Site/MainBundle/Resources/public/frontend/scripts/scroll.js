$(function(){
  $(".content").each(function(i, e){
    if(i == 0){
      $(e).css({
        'min-height' : $(window).height() - $('.header-top').height()
      });
    }else{
      $(e).css({
        'min-height' : $(window).height()
      });
    }
  });

  $(".content .wrap_text").each(function(i, e){
    if(i == 0){
      $(e).css({
        'min-height' : $(e).parent().height() - $(e).parent().find('.wrap_head').height() - $(e).parent().find('.footer').height()
      });
    }else{
      $(e).css({
        'min-height' : $(e).parent().height() - $(e).parent().find('.wrap_head').height() - $(e).parent().find('.footer').height()
      });
    }
  });

  /* ---------------------------------------------- /*
   * Scroll Animation
   /* ---------------------------------------------- */

  $('.menu-left li a').bind('click', function (e) {
    var anchor = $(this);
    $prev = $(".content:visible");

    $("*[id='"+anchor.attr('href')+"']").show();

    if($prev.index() > $("*[id='"+anchor.attr('href')+"']").index()){
      $(window).scrollTop($(window).scrollTop() + $("*[id='"+anchor.attr('href')+"']").height());
    }
    if (!anchor.parent().hasClass('last')) {
      $('.menu-left li').removeClass('current');
      anchor.parent().addClass('current');
      if(anchor.attr('href') == $('.menu-left > ul > li:first > a').attr('href')){
        $('body').stop().animate({
          scrollTop: 0
        }, 1000, function(){
          $prev.hide();
        });
      }else{
        $('body').stop().animate({
          scrollTop: $("*[id='"+anchor.attr('href')+"']").offset().top
        }, 1000, function(){
          $prev.hide();
        });
      }
      if (window.history.pushState) {
        window.history.pushState(null, null, anchor.attr('href'));
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
