$(document).ready(function()
{
    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-delete-artist').on('click', function(e){
         e.preventDefault()
         var option = confirm('Do you want to delete this artist?');
         if(!option) {
            return;
         }
         var id = $(this).data('id')
         $.ajax({
            type:'DELETE',
            url : '/artist/'+id,
            success : function(data)
            {
               $('#artist-' + id).remove()
            }
            error :function(reponses){
               alert(response.responseJSON.errors);
            }

        })
    });
});
