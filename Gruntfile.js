module.exports = function(grunt) {

  // Utility to load the different option files
  // based on their names
  function loadConfig(path) {
    var glob = require('glob');
    var object = {};
    var key;

    glob.sync('*', {cwd: path}).forEach(function(option) {
      key = option.replace(/\.js$/,'');
      object[key] = require(path + option);
    });

    return object;
  }

  // Initial config
  var config = {
    pkg: grunt.file.readJSON('package.json')
  };

  // Load tasks from the tasks folder
  grunt.loadTasks('tasks');

  // Load all the tasks options in tasks/options base on the name:
  // watch.js => watch{}
  grunt.util._.extend(config, loadConfig('./tasks/options/'));

  grunt.initConfig(config);

  require('load-grunt-tasks')(grunt);

  // There are basically three phases of building the production theme:
  // 1) Javascript preparation (concatenating and uglifying scripts)
  grunt.registerTask('javascript', ['uglify'])
  // 2) Stylesheet preparation (SASS, autoprefixing, and minification)
  // (coming soon)
  // 3) Appending the most recent git commit to the theme version
  grunt.registerTask('release', ['gitinfo', 'replace']);
  // The default task performs all three phases.
  grunt.registerTask('default', ['javascript', 'release']);

};
