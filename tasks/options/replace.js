module.exports = {
  dist: {
    options: {
      patterns: [
        {
          match: 'branch',
          replacement: '<%= gitinfo.local.branch.current.name %>'
        },
        {
          match: 'commit',
          replacement: '<%= gitinfo.local.branch.current.shortSHA %>'
        }
      ]
    },
    files: [{
      expand: true,
      flatten: true,
      src: ['css/style.css'],
      dest: '',
    }]
  }
}
