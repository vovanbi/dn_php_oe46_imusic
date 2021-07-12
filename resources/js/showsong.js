$(document).ready (function(){
    $('.get_song').on('click', function () {
         var id = $(this).data('cate-id');
        $.ajax({
            method: 'GET',
            url: '/get-song-by-category/' + id,
            data : {'id' :id},
            success: function (data) {
                var html = '';
                var title = 'Song';
                Object.keys(data).forEach(key => {
                    html += '<a class="box_music song-list" data-id = '+ data[key].id +' >' +
                 '<img src="/storage/'+ data[key].image +'" alt="">'+
                 '<h3>'+data[key].name+'</h3>'+
                 '<h4>'+data[key].artist_name+'</h4>'+
                 '</a>';
                });
                $('.title').html(title)
                $('.list_song').html(html);
                $('.song-list').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        type:'get',
                        url: '/song/'+id,
                        success: function(data) {
                            $('#music-playing').html(data);
                            playMusicEvent();
                        }
                    })
                });
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
                $('.list_song').html(html);
                $('.get_artist').html(html1);
                $('.get_album').html(html2);
            }
        });

    });
    var isRepeat = false;
    function playMusicEvent() {
        audio.play();
        var isPlaying = false;

        $('.play').click(function(e) {
            e.preventDefault();
            if (isPlaying) {
                audio.pause();
                $('.play').removeClass('playing');
            } else {
                audio.play();
                $('.play').addClass('playing');
            }
        });

        audio.onplay = function() {
            isPlaying = true;
        }

        audio.onpause = function() {
            isPlaying = false;
        }

        audio.ontimeupdate = function() {
            if (audio.duration) {
                var progressPercent = Math.floor(audio.currentTime / audio.duration *100);
                $('#progress').val(progressPercent);
                var currentTimeAudio = convertTime(Math.floor(audio.currentTime));
                $('.current-time').html(currentTimeAudio);
                var durationAudio = convertTime(Math.floor(audio.duration));
                $('.audio-duration').html(durationAudio);
            }
        }

        progress.onchange = function (e) {
            var seekTime = audio.duration / 100 * e.target.value
            audio.currentTime = seekTime
        }

        $('#volProgress').on('input', function () {
            audio.volume = $(this).val();
        });

        $('.next-song').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var nextIndex = ++id;

            $.ajax({
                type:'get',
                url: '/songs/'+nextIndex,
                success: function(data)
                {
                    $('#music-playing').html(data);
                    playMusicEvent();
                }
            })
        });

        $('.prev-song').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (id == 1) {
                var prevIndex = 1;
            } else {
                var prevIndex = --id;
            }

            $.ajax({
                type:'get',
                url: '/songs/'+prevIndex,
                success: function(data)
                {
                    $('#music-playing').html(data);
                    playMusicEvent();
                }
            })
        });

        audio.onended = function() {
            $('.next-song').click();
        }

        $('.repeat-song').click(function(e) {
            e.preventDefault();
            if(!isRepeat) {
                $(this).addClass('active');
                isRepeat = true;
                audio.onended = function() {
                    audio.play();
                }
            } else {
                $(this).removeClass('active');
                isRepeat = false;
                audio.onended = function() {
                    $('.next-song').click();
                }
            }
        });

        $('.random-song').click(function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
        });
    }

    function convertTime(sec) {
        var hours = Math.floor(sec/3600);
        (hours >= 1) ? sec = sec - (hours*3600) : hours = '00';
        var min = Math.floor(sec/60);
        (min >= 1) ? sec = sec - (min*60) : min = '00';
        (sec < 1) ? sec='00' : void 0;

        (min.toString().length == 1) ? min = '0'+min : void 0;
        (sec.toString().length == 1) ? sec = '0'+sec : void 0;

        if (hours == '00') {
            return min + ':' + sec;
        } else {
            return hours + ':' + min + ':' + sec;
        }
    }
});
