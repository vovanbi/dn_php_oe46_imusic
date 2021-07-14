<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group">
                <label for="name"> @lang('category.cateName')</label>
                <input type="text" class="form-control" placeholder="Tên danh mục" value="" name="name" >
               </span>
             </div>
             <button type="submit" class="btn btn-success"> @lang('category.saveBtn')</button>
        </div>
    </div>
</form>

