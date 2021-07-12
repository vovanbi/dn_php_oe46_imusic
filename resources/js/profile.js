$(document).ready (function(){
     $.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    $('#pro_file').on('click', function (e) {
        e.preventDefault()
        var id = $(this).data('user-profile')
        $.ajax({
            method: 'GET',
            url :'/info-profile/'+id,
            data:{'id':id},
            success :function(data)
            {
                $('#profile').html(data)

                $('#changpass').on('click', function(e){
                e.preventDefault()
                var passold  = $('.passold').val()
                var passnew  = $('.passnew').val()
                var passconf = $('.passconfir').val()

                $.ajax({
                    method:"POST",
                    url:'/change-password',
                    data:{
                    'passwordOld':passold,
                    'passwordNew':passnew,
                    'passwordconfirm':passconf,
                    '_token': $('input[name=_token]').val()},
                    success : function (data){
                    if(data.success)
                    {
                         $('#message').html('<div class="alert alert-success" role="alert">' + data.success
                        + '</div>');
                    }
                     else if(data.notrepair)
                    {
                        $('#message').html('<div class="alert alert-warning" role="alert">' + data.notrepair
                        + '</div>');
                    } else {
                         $('#message').html('<div class="alert alert-danger" role="alert">' + data.notpass
                        + '</div>');
                    }
                    $('.passold').val('')
                    $('.passnew').val('')
                    $('.passconfir').val('')
                    }
                })
            });
            }
        })
    });
});

