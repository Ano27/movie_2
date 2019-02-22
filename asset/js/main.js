$(document).ready(function() {
  $('.filtre').on('click', function(){
    if($(this).hasClass('menuopen')) {
      $('.menufiltre').fadeOut(500)
    } else {
      $('.menufiltre').fadeIn(500)
    }
    $(this).toggleClass('menuopen');
  })
})
