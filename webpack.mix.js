const mix = require('laravel-mix');

mix.options({
  postCss: [
      require('autoprefixer'),
  ],
});

mix.setPublicPath('public');

mix.webpackConfig({
  resolve: {
      extensions: ['.js', '.jsx', '.vue'],
      alias: {
          '@': __dirname + '/resources'
      }
  },
  output: {
      chunkFilename: 'js/chunks/[name].js',
  },
}).react();

mix.js('resources/js/main.jsx', 'public/js').version();
