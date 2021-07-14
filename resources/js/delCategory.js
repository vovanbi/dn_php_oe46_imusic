$(document).ready(function()
{
    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.del-cate-btn').on('click', function(){
         var option = confirm('Do you want to delete this category?');
         if(!option) {
            return;
         }
         var id = $(this).data('id')
         $.ajax({
            type:'DELETE',
            url: '/admin/categories/'+id,
            success: function(data)
            {
                $('#category-' + id).remove()
            }
        })
    });
});
