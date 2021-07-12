$(document).ready (function(){
    $('#get_song').on('click', function () {
         var id = $(this).data('cate-id');
        $.ajax({
            method: 'GET',
            url: '/get-song-by-category/' + id,
            success: function (data) {
                var html = '';
                Object.keys(data).forEach(key => {
                    html += '<a class="box_music" href="#" id="play">' +
                 '<img src="/storage/'+ data[key].image +'" alt="">'+
                 '<h3>'+data[key].name+'</h3>'+
                 '<h4>'+data[key].artist_name+'</h4>'+
                 '</a>';
                });
                $('.get_song').html(html);
                $('.artists').hide();
                $('.daily-mix').hide();
            }
        });
    });

    $('._home').click(function (e) {
        e.preventDefault()
        $.ajax({
            method :'GET',
            url:'/show-category',
            success : function(data) {
                var html = html1 =html2 = ''
                Object.keys(data['songs']).forEach(key => {
                   html += '<a class="box_music" href="#" id="play">' +
                 '<img src="/storage/'+ data['songs'][key].image +'" alt="">'+
                 '<h3>'+data['songs'][key].name+'</h3>'+
                 '<h4>'+data['songs'][key].artist_name+'</h4>'+
                 '</a>';
                });

                Object.keys(data['artists']).forEach(key => {
                   html1 += '<a class="box_music" href="#" id="play">' +
                 '<img src="/storage/'+ data['artists'][key].image +'" alt="">'+
                 '<h3>'+data['artists'][key].name+'</h3>'+
                 '</a>';
                });
                Object.keys(data['albums']).forEach(key => {
                   html2 += '<a class="box_music" href="#" id="play">' +
                 '<h3>'+data['albums'][key].name+'</h3>'+
                 '</a>';
                });
                $('.get_song').html(html);
                $('.get_artist').html(html1);
                $('.get_album').html(html2);
            }
        });

    });
});
