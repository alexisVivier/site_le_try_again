$('#fleche').click(function()
{
    var fleche = $ ('#fleche'),
        scroll = $(window).scrollTop();
   
    $('html,body').animate({
        scrollTop: $("#nos_principes").offset().top 
    }, 'slow');
});

$('.autoplay').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
});