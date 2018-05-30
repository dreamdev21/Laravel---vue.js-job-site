let mix = require("laravel-mix");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your application.
 |
 */

/*
 * npm i jquery --save or yarn add jquery
 * commentout below code to enable juery autoloading
 * this allows you to use $() in all files.
 */

// mix.autoload({
//     jquery: ['$', 'window.jQuery', 'jQuery']
// });

//====set alias for isotope
mix.webpackConfig({
  resolve: {
    alias: {
      masonry: "masonry-layout",
      isotope: "isotope-layout",
      // custom aliases for easy reference
      src: path.resolve(__dirname, "resources/assets/"),
      assets: path.resolve(__dirname, "resources/assets/assets/"),
      components: path.resolve(__dirname, "resources/assets/components/"),
      pages: path.resolve(__dirname, "resources/assets/components/pages/"),
      img: path.resolve(__dirname, "resources/assets/assets/img/")
    }
  },
  // https://github.com/JeffreyWay/laravel-mix/issues/936#issuecomment-331418769
  output: {
    publicPath: "/",
    chunkFilename: mix.inProduction()
      ? "js/[name].[chunkhash].js"
      : "js/[name].js"
  }
});

// Setup Autoprefixer
mix.options({
  postCss: [
    require("autoprefixer")()
    /**
     * Automatically create rtl css
     * applies styles based on the 'dir' attribute on <html></html>
     * eg: <html dir="ltr"></html>
     * experimental, broken
     */
    // require('postcss-rtl')()
  ]
});

// ===public path
// mix.setPublicPath("/");

// ===compile our main.js file
mix
  .js("resources/assets/main.js", "public/")
  // Add any additional vendor modules that need to be cached
  // remove any unused libraries in the array as they will be included in the vendor bundle
  .extract([
    "vue",
    "bootstrap-vue",
    "animejs",
    "axios",
    "vue-echarts-v3/src/full.js",
    "vue2-dropzone",
    "moment"
  ])
  .version();

// set path for production link
mix.setResourceRoot("/");

// Disable all OS notifications
// mix.disableNotifications()

// Disable all Success notifications
// mix.disableSuccessNotifications()
