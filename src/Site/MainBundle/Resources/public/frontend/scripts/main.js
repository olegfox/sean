$(function(){
  init();
});

$(window).resize(function(){
  init();
});

function disable_scroll(top) {
  if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('.st-pusher').get(0).onscroll = function () {
      console.log('disable scroll');
      $('.st-pusher').animate({
        scrollTop: top
      });
    };
  }
}

function enable_scroll() {
  if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('.st-pusher').get(0).onscroll = function () {
      console.log('enable scroll');
    };
  }
}

function init(){
  /* ---------------------------------------------- /*
   * Gallery
   /* ---------------------------------------------- */

  $('.image-link').magnificPopup({type:'image'});

  /* ---------------------------------------------- /*
   * Validate Form Feedback
   /* ---------------------------------------------- */

  $("#form-feedback").validate({
    submitHandler: function(form) {
      $.post($("#form-feedback").attr('action'), $("#form-feedback").serialize(), function(){
        $("#form-feedback").prepend("<div class='hint'>Спасибо! Письмо успешно отправлено!</div>");
        $("#form-feedback").find("input[type=text], input[type=email], textarea").val("");
        setTimeout(function(){
          $("#form-feedback").find(".hint").remove();
        }, 4000);
      }).fail(function(){
        $("#form-feedback").prepend("<div class='hint hint-error'>Ошибка отправки!</div>");
        setTimeout(function(){
          $("#form-feedback").find(".hint").remove();
        }, 4000);
      });
    }
  });

  /* ---------------------------------------------- /*
   * Scroll Animation
   /* ---------------------------------------------- */

  $('.nav li a').bind('click', function(e) {
    var anchor = $(this);
    if(!anchor.parent().hasClass('last')){
      $('.nav li').removeClass('current');
      anchor.parent().addClass('current');
      enable_scroll();
      console.log($(anchor.attr('href')).index());
      if(anchor.attr('href') != "#glavnaia"){
        $(".nav").switchClass('black', 'white', 1000, "easeInOutQuad");
        $(".footer").switchClass('black', 'white', 1000, "easeInOutQuad");
        $("div.header").switchClass('black', 'white', 1000, "easeInOutQuad");
      }else{
        $(".nav").switchClass('white', 'black', 1000, "easeInOutQuad");
        $(".footer").switchClass('white', 'black', 1000, "easeInOutQuad");
        $("div.header").switchClass('white', 'black', 1000, "easeInOutQuad");
      }
      $('.wrap-st-content').stop().animate({
        scrollTop: $(anchor.attr('href')).index() * $('.wrap-st-content').height()
      }, 1000, function(){
        disable_scroll($('.wrap-st-content').scrollTop());
      });
      if (window.history.pushState) {
        if(anchor.attr('href').replace('#', '') != 'glavnaia'){
          window.history.pushState(null, null, '/' + anchor.attr('href').replace('#', ''));
        }else{
          window.history.pushState(null, null, '/');
        }
      }
      e.preventDefault();
    }
  });
}
