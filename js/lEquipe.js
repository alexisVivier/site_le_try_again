$(".flip-container").one("mouseover", function() {
  $(".flip-container[id="+$(this).index()+"] .flipper").addClass('isFlipped');
}); 