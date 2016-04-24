/*bundle and minify( and mangle most of it ) my javascript files, based on http://stackoverflow.com/questions/36520632/how-to-concat-and-minify-javascript-files-really-easily run command: browserify personal-website.js | uglifyjs --mangle > personal-website.min.js
watchfiy with uglifyjs did not work and I did not figure out how to map the files in time*/
require( "./themes.js" );
require( "./tour.js" );
require( "./index.js" );
require( "./portfolio.js" );
require( "./contact.js" );
