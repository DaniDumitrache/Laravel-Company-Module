const mix = require("laravel-mix");

mix.sass('resources/scss/app.scss', 'public/css');
mix.styles(["resources/css/app.css"], "public/css/app.css");
mix.scripts(["resources/js/app.js"], "public/js/app.js");
