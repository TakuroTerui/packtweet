$(function() {
  $('.tweet-textarea').on('input', function() {
    var input = $(this).val();
    if(input) {
      $('.tweet-btn').prop('disabled', false);
    } else {
      $('.tweet-btn').prop('disabled', true);
    }
  });
});
