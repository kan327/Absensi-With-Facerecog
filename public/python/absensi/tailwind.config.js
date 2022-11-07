/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./Public/*.{php,js,html}"],
  theme: {
    extend: {
      colors: {
        'blue-dark': '#1061FF',
        'blue': '#349DFD',
        'unselect': '#BAC5E7',
        'stroke': '#81B7E9',
        'tet': '#001458',
        'h1': '#1A91FF',
      },
      boxShadow: {
        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
        bxsd: '5px 5px 10px rgba(0, 0, 0, 0.1);',
        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
      }
    },
  },
  plugins: [],
}