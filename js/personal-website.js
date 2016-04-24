/*bundle and minify my javascript files, based on http://stackoverflow.com/questions/36520632/how-to-concat-and-minify-javascript-files-really-easily run command: browserify personal-website.js | uglifyjs > personal-website.min.js
However, it is a bit difficult to find anything that will use watchify( watching browserify ), uglify and map the minimized file it easily without learning grunt/gulp, the tutorials don't work/the needed npm modules do not install correctly on my machine */
require( "./themes.js" );
require( "./tour.js" );
require( "./index.js" );
require( "./portfolio.js" );
require( "./contact.js" );
