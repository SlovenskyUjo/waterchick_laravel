import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: "class",
    theme: {
        extend: {
            container: {
                center: true,
            },
            fontFamily: {
                Oswald: ["Oswald", "sans serif"],
                Inter: ["Inter"],
                Poppins: ["Poppins"],
            },
            backgroundImage: {
                heroLight:
                    "url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')",
                heroDark:
                    "url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')",
            },
            colors: {
                primary: "#0C85D3",
            },
        },
    },
    plugins: [forms],
};
