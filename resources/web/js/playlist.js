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
                $(".playlist").load(location.href+" .playlist>*","");
                playlistSong();
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
                playlistSong();
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
                    $(".playlist").load(location.href+" .playlist>*","");
                    playlistSong();
                }
            });
        });
    }

    function playlistSong() {
        $('.play-playlist').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type:'get',
                url: '/playlist-detail/' + id,
                success: function(data)
                {
                    $('.box_main').html(data);
                    actionPlaylist();
                    showSongList();
                }
            })
        });

        $('.play-favAlbum').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type:'get',
                url: '/favorite-album/' + id,
                success: function(data)
                {
                    $('.box_main').html(data);
                    actionPlaylist();
                }
            })
        });

        $('.del-playlist').click(function() {
            var option = confirm('Are you sure you want to delete this playlist?');
            if (!option) {
                return;
            }
            var id = $(this).data('id');
            $.ajax({
                type:'post',
                url: '/del-playlist/' + id,
                success: function(data)
                {
                    $('#playlist-' + id).remove();
                    $(".playlist").load(location.href+" .playlist>*","");
                }
            })
        });

        $('.del-favAlbum').click(function() {
            var option = confirm('Are you sure you want to delete this playlist?');
            if (!option) {
                return;
            }
            var id = $(this).data('id');
            $.ajax({
                type:'post',
                url: '/del-fav-album/' + id,
                success: function(data)
                {
                    $('#playlist-' + id).remove();
                    $(".playlist").load(location.href+" .playlist>*","");
                }
            });
        });
    }

    function showSongList() {
        $('.add-song-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            $.ajax({
                type:'get',
                url: '/song-list/' + id,
                success: function(data)
                {
                    $('.box_main').html(data);
                    searchSong();
                }
            });
        });
    }

    function searchSong() {
        $('#search-song').on('input', function() {
            var playlistId = $(this).data('id');
            var search = $(this).val();

            $.ajax({
                type:'post',
                url: '/playlist/' + playlistId + '/search/' + search,
                success: function(data)
                {
                    $('#song-search').html(data);
                    actionPlaylist();
                }
            }); 
        });
    }

    function actionPlaylist()
    {
        $('.add-favorite-song').click(function(e) {
            e.preventDefault();
            var song = $(this).data('song');

            $.ajax({
                type:'post',
                url: '/favorite-song/' + song,
                success: function(data)
                {
                    $(".playlist").load(location.href+" .playlist>*","");
                }
            });
        });

        $('.add-playlist-song').click(function(e) {
            e.preventDefault();
            var playlistId = $(this).data('playlist');
            var song = $(this).data('song');

            $.ajax({
                type:'post',
                url: '/playlist/' + playlistId + '/song/' + song,
                success: function(data)
                {
                    $('#song-' + song).remove();
                }
            });
        });

        $('.del-playlist-song').click(function(e) {
            e.preventDefault();
            var playlistId = $(this).data('playlist');
            var song = $(this).data('song');

            $.ajax({
                type:'post',
                url: '/playlist/' + playlistId + '/del-song/' + song,
                success: function(data)
                {
                    $('#songItem-' + song).remove();
                }
            });
        });
    }

    playlistSong();
});
