$('#fleche').click(function()
{
    var fleche = $ ('#fleche'),
        scroll = $(window).scrollTop();
   
    $('html,body').animate({
        scrollTop: $("#nos_principes").offset().top 
    }, 'slow');
    
 
    
    
});

 $("#slider").slick({
        infinite : false
  });

$('.autoplay').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  arrows : false
});


/*  Tentative d'animation en fonction du scroll
    sur la page 
    
   $(window).scroll(function()
{
    var sticky = $ ('#trait'),
        bool = false,
        posScroll = $(document).scrollTop(),
        possCamion = $('#nos_partenaires').position().top,
        windowHeight = $(window).height();
       console.log($(window).height());
    console.log("tamere"+$('#nos_partenaires').position().top);
       console.log('srcoll : '+ posScroll);
        
    
    if( posScroll > windowHeight - possCamion +200) sticky.removeClass('bouge'),sticky.addClass('stop');
    else sticky.removeClass('stop'), sticky.addClass('bouge');
})*/
   
   
   
