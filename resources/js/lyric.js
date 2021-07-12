$(document).ready(function(){
    $("#formButton").click(function(evt) {
         evt.preventDefault();
            $("#form1").toggle();
    });

    $.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    $('#add_lyric').on('click', function(evt){
       evt.preventDefault();
       var song_id = $(this).data('song');
       var content = $('.content').val();
       var user_id = $(this).data('user');
       $.ajax({
            method : "POST",
            url    : '/add-lyric',
            data   : {
            'song_id': song_id,
            'content':content,
            'user_id':user_id,
            '_token': $('input[name=_token]').val()},
            success: function(data){
                console.log(data);
                alert('Add lyric song success');
                location.reload();
                $('.contend').val("");
            }
        })
    });
});
