/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      transitionProperty: {
        'width': 'width'
      },
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}
