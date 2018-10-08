var webpack = require('webpack');

module.exports = {
    entry: './src/string-additions.js',
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
