module.exports = {
  build: {
    src: 'js/mitlibnews.js',
    dest: 'js/build/mitlibnews.min.js'
  },
  loadMore: {
    src: 'js/src/mitlibnews-more.js',
    dest: 'js/build/mitlibnews-more.min.js'
  },
  loader: {
    src: 'js/src/mitlibnews.loader.js',
    dest: 'js/build/mitlibnews.loader.min.js'
  },
  lazyLoad: {
    src: 'node_modules/jquery-lazyload/jquery.lazyload.js',
    dest: 'js/build/jquery.lazyload.min.js'
  }
}