module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            options: {
                loadPath: ['_foundation/bower_components/foundation/scss']
            },
            dist: {
                options: {
                    style: 'expanded',
                    sourceMap: true
                },
                files: {
                    'assets/css/override.css': '_foundation/scss/app.scss'
                }
            }
        },

        watch: {
            grunt: {files: ['Gruntfile.js']},

            sass: {
                files: '_foundation/scss/**/*.scss',
                tasks: ['sass']
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('build', ['sass']);
    grunt.registerTask('default', ['build', 'watch']);
}