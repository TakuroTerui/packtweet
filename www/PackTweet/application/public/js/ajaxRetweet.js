$(function() {
  let csrf_hash = $("#token").val();
  let csrf_name = $("#token").attr('name');
  let tweet_id = $('#tweet_id').val();
  let postdata = {};
  postdata[csrf_name] = csrf_hash;

  $('#retweet-button').on('click', function () {
    e.preventDefault();
    $.ajax({
        url : 'tweets/retweet/' . tweet_id,
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