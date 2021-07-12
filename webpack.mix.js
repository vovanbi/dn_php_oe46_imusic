const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/app.js')
    .postCss('resources/css/app.css', 'public/css', [
    ]).scripts('resources/theme_admin/js/jquery.dataTables.min.js','public/js/jquery.dataTables.min.js')
    .scripts('resources/theme_admin/js/dataTables.bootstrap4.min.js','public/js/dataTables.bootstrap4.min.js')
    .js('resources/js/showimg.js','public/js/showimg.js')
    .js('resources/theme_admin/js/jquery-3.5.1.js','public/js/jquery-3.5.1.js')
    .styles(['resources/theme_admin/css/bootstrap.min.css',
         'resources/theme_admin/css/sb-admin.css',
         'resources/theme_admin/css/font-awesome.min.css',
         'resources/theme_admin/css/dataTables.bootstrap4.min.css'
        ],'public/css/styles.css')
    .styles('resources/css/app.css','public/css/app.css')
    .js('resources/js/delartis.js','public/js/delartis.js')
    .js('resources/js/delCategory.js', 'public/js/delCategory.js');
