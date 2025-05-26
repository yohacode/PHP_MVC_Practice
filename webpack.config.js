// webpack.config.js
const path = require('path');

module.exports = {
  entry: './resources/js/app.js',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'public/dist'),
  },
  mode: 'development', // or 'production'
  module: {
    rules: [
      {
        test: /\.scss$/, // or /\.sass$/ for SASS syntax
        use: [
          'style-loader', // 3. Inject CSS into DOM
          'css-loader',   // 2. Turns CSS into CommonJS
          'sass-loader'   // 1. Compiles Sass to CSS
        ],
      },
    ],
  },
};
