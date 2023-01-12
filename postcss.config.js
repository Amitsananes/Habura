// const purgecss = require('@fullhuman/postcss-purgecss')({
// 	// Specify the paths to all of the template files in your project
// 	content: ['./**/*.php'],
//
// 	// Include any special characters you're using in this regular expression
// 	defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
// });

module.exports = {
    map: { inline: true },
    plugins: [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nested'),
        require('autoprefixer'),
        require('postcss-object-fit-images'),
        // purgecss,
    ],
};
