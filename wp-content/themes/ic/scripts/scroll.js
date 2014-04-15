//scrollspy function used to navigate on the page with easing
$(function() {
  $('ul.navitem a, .more a, .topper, .blognav a.holup, .socialites .icon-bubbles' ).bind('click',function(event){
  var $anchor = $(this);

  $('[data-spy="scroll"]').each(function () {
    var $spy = $(this).scrollspy('refresh')
  });



  $('html, body').stop().animate({
    scrollTop: $($anchor.attr('href')).offset().top
  }, 2500,'easeInOutExpo');

  event.preventDefault();
});

});
