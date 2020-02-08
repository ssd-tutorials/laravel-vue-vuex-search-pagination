const mix = require('laravel-mix');

const postCssConfig = [require('tailwindcss')('./tailwind.config.js')];

if (process.env.NODE_ENV === 'production') {
    postCssConfig.push(
        require('@fullhuman/postcss-purgecss')({
            content: [
                './resources/js/**/*.vue',
                './resources/js/**/*.js',
                './resources/sass/**/*.scss',
                './resources/views/**/*.php'
            ],
            defaultExtractor: content =>
                content.match(/[A-Za-z0-9-_:/]+/g) || []
        })
    );
}

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                exclude: /(node_modules\/(?!(strict-uri-encode|query-string)\/).*|bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: Config.babel()
                    }
                ]
            }
        ]
    }
});

mix.js('resources/js/app.js', 'public/assets/js')
    .sass('resources/sass/app.scss', 'public/assets/css')
    .options({
        processCssUrls: false,
        postCss: postCssConfig
    })
    .sourceMaps()
    .version();
