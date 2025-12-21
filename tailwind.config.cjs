module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './node_modules/preline/dist/*.js', // include Preline
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('preline/plugin'), // add Preline plugin
  ],
};
