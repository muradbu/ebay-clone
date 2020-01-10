var star_rating = $('.star');

var SetRatingStar = function() {
  return star_rating.each(function() {
    if (parseInt(star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {        
      return $(this).empty().text('star');      
    } else {        
      return $(this).empty().text('star_border');
    }
  });
};

star_rating.on('click', function() {
  star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();
$(document).ready(function() {
    star_rating.on('click', function() {
  star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});
});
