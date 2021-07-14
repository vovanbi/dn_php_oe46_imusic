const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/app.js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]).scripts('resources/theme_admin/js/jquery.dataTables.min.js','public/js/jquery.dataTables.min.js')
    .scripts('resources/theme_admin/js/dataTables.bootstrap4.min.js','public/js/dataTables.bootstrap4.min.js')
    .js('resources/js/showimg.js','public/js/showimg.js')
    .js('resources/theme_admin/js/jquery-3.5.1.js','public/js/jquery-3.5.1.js')
    .styles('resources/theme_admin/css/sb-admin.css','public/css/sb-admin.css')
    .styles('resources/theme_admin/css/bootstrap.css','public/css/bootstrap.css')
    .styles('resources/theme_admin/css/bootstrap.min.css','public/css/bootstrap.min.css')
    .styles('resources/css/app.css','public/css/app.css')
    .scripts(['resources/js/bootstrap.min.js','resources/js/jquery-3.2.1.slim.min.js','resources/popper.min.js'],'public/js/lib.js');
