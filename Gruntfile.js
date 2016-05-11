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
            dev: {
                options: {
                    style: "compressed"
                },
                files: {
                    "./dist/css/themes.min.css" : "./src/css/themes.scss"
                }
            }
        },
        concat: {
            dev: {
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
            dev: {
                src: "./dist/js/personal-website.js",
                dest: "./dist/js/personal-website.min.js"
            }
        },
        copy: {
            release: {
                files: [{
                    expand: true,
                    cwd: "./src/",
                    src: [ "**", "!**/*.{scss,css,js}" ],
                    dest: "./dist/"
                }]
            },
            dev:
            {
                files: [{
                    expand: true,
                    cwd: "./src/",
                    src: [ "**", "!**/*.scss" ],
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
        processhtml: {  //processhtml is to make external css and js to be inline, possible faster loading and it looks cooler when the source is looked at, based from http://stackoverflow.com/questions/33666203/grunt-compile-external-js-into-inline-html
            dev: {
                files: {
                    "./dist/format_files/header.php" : "./src/format_files/header.php",
                    "./dist/format_files/footer.php" : "./src/format_files/footer.php"
                }
            }
        },
        clean: {
            release: {
                src: [ "./dist/js/**", "./dist/css/**" ]
            }
        },
        watch: {
            sass: {
                files: [ "./src/css/*.scss" ],
                tasks: [ "sass" ]
            },
            rest: {
                files: [ "./src/**" ],
                tasks: [ "copy:dev" ]
            }
        }
    });

    grunt.loadNpmTasks( "grunt-contrib-sass" );
    grunt.loadNpmTasks( "grunt-contrib-concat" );
    grunt.loadNpmTasks( "grunt-contrib-uglify" );
    grunt.loadNpmTasks( "grunt-contrib-copy" );
    grunt.loadNpmTasks( "grunt-processhtml" );
    grunt.loadNpmTasks( "grunt-contrib-clean" );
    grunt.loadNpmTasks( "grunt-contrib-watch" );

    grunt.registerTask( "release", [ "sass", "concat", "uglify", "copy:release", "processhtml", "clean" ] );
    grunt.registerTask( "default", [ "sass", "copy:dev", "watch" ] );
    grunt.registerTask( "git", [ "copy:git" ] );
};
