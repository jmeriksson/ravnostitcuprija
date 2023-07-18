let mix = require( 'laravel-mix' );

mix.copyDirectory( 'src/images', 'assets/images' );

mix.js( 'src/javascript/main.js', 'assets/javascript' ).setPublicPath( 'assets' )
    .sass( 'src/sass/main.scss', 'assets/css' )
    .sass( 'src/sass/editor-styles.scss', 'assets/css')
