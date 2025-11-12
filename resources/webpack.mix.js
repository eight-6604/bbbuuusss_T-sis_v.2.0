const mix = require('laravel-mix');

// Compile the JS file
mix.js('resources/js/sidebar.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ]);
