$(document).ready(function() {
    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn_playlist').click(function(e) {
        e.preventDefault();
        
        $.ajax({
            type:'get',
            url: '/create-playlists',
            success: function(data)
            {
                $('.box_main').html(data);
                submitForm();
            }
        });
    });

    $('.add-album-btn').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            type:'post',
            url: '/add-album/'+id,
            success: function(data)
            {
                $('.add-album-btn').addClass('active');
            }
        });
    });

    $('.manage-playlist').click(function(e) {
        e.preventDefault();

        $.ajax({
            type:'get',
            url: '/playlists',
            success: function(data)
            {
                $('.box_main').html(data);
            }
        });
    });

    function submitForm() {
        $('#create-playlist').submit(function(e) {
            e.preventDefault();
            var name = $('#playlist-name').val();
            $.ajax({
                type:'post',
                url: '/store-playlists',
                data: {
                    name: name,
                },
                success: function(data)
                {
                    $('.box_main').html(data);
                }
            })
        });
    }
});
