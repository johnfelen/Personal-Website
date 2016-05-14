//this function and code will allow me to copy the files from the xampp htdocs to my git repo, based from https://github.com/gruntjs/grunt-contrib-copy/issues/47
var path = require( "path" );
function getHomeDir()
{
    var dirpath = path.join.apply( path, arguments );
    var homepath = process.env[ process.platform === "win32" ? "USERPROFILE" : "HOME" ];
    dirpath = path.resolve( homepath, dirpath );
    return dirpath;
}

module.exports = function( grunt )
{
    grunt.initConfig({
        pkg: grunt.file.readJSON( "package.json" ),
        autoprefixer: {
            dist: {
                src: "./dist/css/*.css"
            }
        },
        sass: {
            release: {
                options: {
                    style: "compressed"
                },
                files: {
                    "./dist/css/themes.min.css" : "./src/css/base64.scss"
                },
            },
            dev: {
                options: {
                    style: "compressed"
                },
                files: {
                    "./dist/css/themes.min.css" : "./src/css/binaries.scss"
                },
                update: true
            },
        },
        jshint: {
            options: {
                force: true
            },
            all: [ "Gruntfile.js", "./dist/js/*.js", "!./dist/js/google-analytics.js" ]
        },
        concat: {
            release: {
                src: [ "./src/js/*.js", "!./src/js/animations.js" ],
                dest: "./dist/js/personal-website.min.js"   //NOTE: it is not minimized yet, just concatted, but it will be at the end
            }
        },
        uglify: {
            dev: {
                options: {
                    compress: true,
                    mangle: true,
                    sourceMap: true
                },
                files: [{   //minifies all javascript files seperatly( it is only animations.js and personal-website.min.js which remember is not minimized until after this step, based on accepted answer here http://stackoverflow.com/questions/13358680/how-to-config-grunt-js-to-minify-files-separately
                    expand: true,
                    cwd: "./dist/js/",
                    src: "./**/*.js",
                    dest: "./dist/js/"
                }]
            }
        },
        copy: {
            release: {
                files: [{
                    expand: true,
                    cwd: "./src/",
                    src: [ "**", "./js/animations.js", "!**/*.{scss,css,js}" ],
                    dest: "./dist/"
                }]
            },
            git: {
                files: [{
                    expand: true,
                    cwd: "./",
                    src: [ "**", "!dist/**", "!node_modules/**", "!.htaccess" ],
                    dest: getHomeDir( "C:/Users/John/Documents/GitHub/Personal-Website/" )
                }]
            }
        },
        sync: {
            dev: {
                files: [{
                    expand: true,
                    cwd: "./src/",
                    src: [ "**", "!**/*.scss" ],
                    dest: "./dist/"
                }]
            }
        },
        processhtml: {  //processhtml is to make external css and js to be inline, possible faster loading and it looks cooler when the source is looked at, based from http://stackoverflow.com/questions/33666203/grunt-compile-external-js-into-inline-html
            dev: {
                files: {
                    "./dist/format_files/header.php" : "./src/format_files/header.php",
                    "./dist/format_files/footer.php" : "./src/format_files/footer.php"
                }
            }
        },
        clean: {
            dist: {
                src: [ "./dist/**" ]
            },
            releaseBefore: {    //release before keeps map files for final round testing, deletes the javascript that goes inline and also deltes the images, but saves the maps
                src: [ "./dist/js/personal-website.min.js", "!**/*.map", "./dist/images/**/*.png" ]
            },
            releaseAfter: { //deletes the maps
                src: [ "./dist/**/*.map" ]
            },
            git: {
                options: {
                    force: true    //allows cleaning of different directories
                },
                src: [ getHomeDir( "C:/Users/John/Documents/GitHub/Personal-Website/src/" ) ]
            }
        },
        watch: {
            sass: {
                files: [ "./src/css/*.scss" ],
                tasks: [ "sass:dev" ]
            },
            rest: {
                files: [ "./src/**" ],
                tasks: [ "sync:dev" ]
            },
            js: {
                files: [ "./dest/css/*.js" ],
                tasks: [ "jshint" ]
            }
        }
    });

    grunt.loadNpmTasks( "grunt-autoprefixer" ); //although depricated, postcss was not working, and --save-dev would not work( probablly because it is deprecated )
    grunt.loadNpmTasks( "grunt-contrib-sass" );
    grunt.loadNpmTasks( "grunt-contrib-jshint" );
    grunt.loadNpmTasks( "grunt-contrib-concat" );
    grunt.loadNpmTasks( "grunt-contrib-uglify" );
    grunt.loadNpmTasks( "grunt-contrib-copy" );
    grunt.loadNpmTasks( "grunt-sync" );
    grunt.loadNpmTasks( "grunt-processhtml" );
    grunt.loadNpmTasks( "grunt-contrib-clean" );
    grunt.loadNpmTasks( "grunt-contrib-watch" );

    grunt.registerTask( "release", [ "clean:dist", "sass:release", "autoprefixer", "concat", "uglify", "copy:release", "processhtml", "clean:releaseBefore" ] );
    grunt.registerTask( "finish", [ "clean:releaseAfter" ] );   //call finish after a quick run through of website to make sure that the release build works properly

    grunt.registerTask( "default", [ "sass:dev", "autoprefixer", "sync:dev", "jshint", "watch" ] );
    grunt.registerTask( "dev", [ "clean:dist", "sass:dev", "autoprefixer", "sync:dev", "jshint", "watch" ] );   //just copy of default but will clean dist first, call this after created release and going back into development
    grunt.registerTask( "git", [ "clean:git", "copy:git" ] );
};
