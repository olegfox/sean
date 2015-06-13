$(function(){
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
});
