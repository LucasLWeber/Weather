/** @type {import('tailwindcss').Config} */

module.exports = {
    presets: [
        require("./vendor/wireui/wireui/tailwind.config.js")
    ],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/resources/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins'],
            }
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
