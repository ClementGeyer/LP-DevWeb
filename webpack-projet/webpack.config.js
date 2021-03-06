const path = require('path');
const webpack = require('webpack');

module.exports = {
  mode: 'production',
  entry: './src/shuffle.js',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist'),
  },
  plugins: [
      new webpack.ProvidePlugin({
          $: 'jquery',
          jQuery: 'jquery'
      })
    ]
};