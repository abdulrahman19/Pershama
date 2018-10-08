var webpack = require('webpack');

module.exports = {
    entry: './src/promises.js',
    devtool: 'source-map',
    output: {
        filename: './main.js'
    },
    module: {
        rules: [
            {
                test:/\.js$/,
                loader: 'buble-loader',
            }
        ]
    }
};
