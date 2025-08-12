/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",

  ],
  theme: {
    fontFamily: {
	  	'lato': ['Lato', 'sans-serif'],
    },

    extend: {},
  },
  plugins: [],
}

