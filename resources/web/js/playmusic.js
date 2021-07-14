$.ajaxSetup({
    headers :{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function playSong() {
    $('.song-list').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajax({
            type:'get',
            url: '/song/'+id,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
                detailSong();
                actionPlaylist();
            }
        })
    });
}
playSong();

function detailSong() {
    $('.detail-song').on('click', function(e){
        var id = $(this).data('song-detail');
        console.log(id) 
        e.preventDefault()
        $.ajax({
            method:'GET',
            url:'detail-song/'+id,
            success: function(data) {
            $('#detail-song').html(data);


            $("#formButton").click(function(evt) {
                 evt.preventDefault();
                    $("#form1").toggle();
            });
            $('#add_lyric').on('click', function(e){
               e.preventDefault();
               var song_id = $(this).data('song');
               var content = $('.content').val();
               var user_id = $(this).data('user');
               $.ajax({
                    method        : "POST",
                    url         : '/add-lyric',
                    data        : {
                    'song_id': song_id,
                    'content':content,
                    'user_id':user_id,
                    '_token': $('input[name=_token]').val()},
                    success: function(data){
                        alert('Add lyric song success');
                        $('.contend').val("");
                        $("#form1").hide();
                    }
                })
            });

            $(".rating input:radio").attr("checked",false);

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
            });
            });
        }

     });
    });
}

function playMusic() {
    $('.play-music').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajax({
            type:'get',
            url: '/song/'+id,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
                actionPlaylist();
            }
        })
    });
}
playMusic();

var isRepeat = false;
function playMusicEvent() {
    audio.play();
    var isPlaying = false;
    
    $('.play').click(function(e) {
        e.preventDefault();
        if (isPlaying) {
            audio.pause();
            $(this).removeClass('playing');
        } else {
            audio.play();
            $(this).addClass('playing');
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
            url: '/song/'+nextIndex,
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
            url: '/song/'+prevIndex,
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

import { actionPlaylist } from './playlist';
export { playMusicEvent, playSong, playMusic };
