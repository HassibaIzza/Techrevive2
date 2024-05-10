const mix = require('laravel-mix');


   
   mix.sass('resources/sass/app.scss', 'public/css')
   .styles([
       'resources/css/bootstrap.min.css',
       'resources/css/font-awesome.min.css',
       'resources/css/elegant-icons.css',
       'resources/css/nice-select.css',
       'resources/css/jquery-ui.min.css',
       'resources/css/owl.carousel.min.css',
       'resources/css/slicknav.min.css',
       'resources/css/styles.css',
   ], 'public/css/all.css');

   mix.js('resources/js1/app.js', 'public/js')
   .scripts([
       'resources/js1/jquery-3.3.1.min.js',
       'resources/js1/bootstrap.min.js',
       'resources/js1/jquery.nice-select.min.js',
       'resources/js1/jquery-ui.min.js',
       'resources/js1/jquery.slicknav.js',
       'resources/js1/mixitup.min.js',
       'resources/js1/owl.carousel.min.js',
       'resources/js1/main.js',
   ], 'public/js/all.js');