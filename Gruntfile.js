//this function and code will allow me to copy the files from the xampp htdocs to my git repo, based from https://github.com/gruntjs/grunt-contrib-copy/issues/47
var path = require( "path" );
function getHomeDir() {
    var dirpath = path.join.apply( path, arguments );
    var homepath = process.env[ process.platform === "win32" ? "USERPROFILE" : "HOME" ];
    dirpath = path.resolve( homepath, dirpath );
    return dirpath;
}

module.exports = function( grunt )
{
    grunt.initConfig({
        pkg: grunt.file.readJSON( "package.json" ),
        sass: {
            dist: {
                options: {
                    style: "compressed"
                },
                files: {
                    "./dist/css/themes.min.css" : "./src/css/themes.scss"
                }
            }
        },
        concat: {
            dist: {
                src: "./src/js/*.js",
                dest: "./dist/js/personal-website.js"
            }
        },
        uglify: {
            options: {
                compress: true,
                mangle: true,
                sourceMap: true
            },
            dist: {
                src: "./dist/js/personal-website.js",
                dest: "./dist/js/personal-website.min.js"
            }
        },
        processhtml: {  //http://stackoverflow.com/questions/33666203/grunt-compile-external-js-into-inline-html
            dist: {
                files: {
                    "./dist/format_files/header.php" : "./src/format_files/header.php",
                    "./dist/format_files/footer.php" : "./src/format_files/footer.php"
                }
            }
        },
        watch: {
            sass: {
                files: [ "./src/css/*.scss" ],
                tasks: [ "sass", "processhtml" ]
            },
            js: {
                files: [ "./src/js/*.js" ],
                tasks: [ "concat", "uglify", "processhtml" ]
            }
        },
        copy: {
            dist: {
                files: [{
                    expand: true,
                    cwd: "./src/",
                    src: [ "**", "!**/*.{scss,css,js}" ],
                    dest: "./dist/"
                }]
            },
            git: {
                files: [{
                    expand: true,
                    cwd: "./",
                    src: [ "**", "!dist/**", "!node_modules/**", "!.htaccess" ],
                    dest: getHomeDir( "C:/Users/jtfel/Documents/GitHub/Personal-Website/" )
                }]
            }
        },
        clean: {
            dist: {
                src: [ "./dist/js/*.js", "!./dist/js/*.min.js" ]
            }
        }
    });

    grunt.loadNpmTasks( "grunt-contrib-uglify" );
    grunt.loadNpmTasks( "grunt-contrib-watch" );
    grunt.loadNpmTasks( "grunt-contrib-concat" );
    grunt.loadNpmTasks( "grunt-processhtml" );
    grunt.loadNpmTasks( "grunt-contrib-sass" );
    grunt.loadNpmTasks( "grunt-contrib-copy" );
    grunt.loadNpmTasks( "grunt-contrib-clean" );

    grunt.registerTask( "release", [ "sass", "concat", "uglify", "copy:dist", "clean", "processhtml" ] );
    grunt.registerTask( "default", [ "sass", "concat", "uglify", "copy", "clean", "watch" ] );
    grunt.registerTask( "git", [ "copy:git" ] );
};
