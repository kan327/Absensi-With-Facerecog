/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
          'bg-blue-dark': '#2C3E50',
          'dark-data': '#393939',
          'placeholder': '#A0A0A0',
          'bg': '#FCFCFF',
          'blue-dark': '#1061FF',
          'blue': '#349DFD',
          'blue-table': '#002C9D',
          'unselect': '#BAC5E7',
          'stroke': '#81B7E9',
          'tet': '#001458',
          'tet-x': '#5A5A5A',
        },
        boxShadow: {
          nav: '2px 3px 3px 1px rgba(0, 0, 0, 0.1);',
          side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
          stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
          box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
        },
        screens: {
          'lgs': '1150px',
          'mds': '833px',
          'vp-860': '860px'
        },
    },
  },
  plugins: [],
}