$(document).ready(function(){
    $('.top_tren').on('click', function(e){
        e.preventDefault()
        $.ajax({
            method:'GET',
            url :'/top-trending-song',
            async: false,
            success: function (data) {
                $('.box_main').html(data)
            }
        })
    });

});
