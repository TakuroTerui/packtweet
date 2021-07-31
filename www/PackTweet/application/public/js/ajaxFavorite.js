$(function() {
    let csrf_hash = $("#token").val();
    let csrf_name = $("#token").attr('name');
    let tweet_id = $('#tweet_id').val();
    let postdata = {
        tweet_id : tweet_id
      };
    postdata[csrf_name] = csrf_hash;

    $('#favorite-button').on('click', function () {
      $.ajax({
          url : 'tweets/favorite',
          type: 'POST',
          data: postdata
      })
      .done(function(data) {
          alert('OK');
      }).fail(function(data) {
          alert('NG');
      });
    });
});