/** @type {import('tailwindcss').Config} */

// tailwind.config.js
module.exports = {
  content: [
    "./components/**/*.php",
    "./public/**/*.php",
    "./pages/**/*.php",
    "./*.php",
    "./public/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("tailwindcss-animate"), require("@tailwindcss/forms")],
};
