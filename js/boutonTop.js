$(window).scroll(function(){
    var boutonTop = $('.co_hiddenBoutonTop');
    var scroll = $(window).scrollTop();
    
    if(scroll>=100) boutonTop.addClass('co_apparentBoutonTop');
    else  boutonTop.removeClass('co_apparentBoutonTop');
});

$(".co_hiddenBoutonTop").click(function(){
    $('html,body').animate({
        scrollTop: 0
    }, 'slow');
});