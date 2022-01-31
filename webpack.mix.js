const mix = require('laravel-mix');

mix.setPublicPath('assets')
    .js('src/js/app.js', 'js/all.min.js')
    .sass('src/scss/app.scss', 'css/all.min.css')
    .options({
        processCssUrls: false
    })
    .disableNotifications();
