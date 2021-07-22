$(document).ready(function(){
    $.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
    var star;
    $('input:radio').change(
      function(){
        star = this.value;
    });
    $('#submit_c').on('click', function(evt){

       evt.preventDefault();
       var song_id = $(this).data('song');
       var content = $('#_contend').val();
       var user_id = $(this).data('user');
       $.ajax({
            method: "POST",
            url   : '/song-comment',
            data  : {
            'song_id': song_id,
            'rate_star':star,
            'content':content,
            'user_id':user_id,
            '_token': $('input[name=_token]').val()},
            success: function(data){
                alert('Comment song success');
                location.reload();
                $('#_contend').val("");
                $(".rating span").removeClass('checked');
            }
        })
    });
});
