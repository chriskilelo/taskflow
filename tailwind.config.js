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

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'greenium': {
                    50: "#EFF6F0",
                    100: "#DEECDF",
                    200: "#CCE2CE",
                    300: "#B7D7BA",
                    400: "#A1CCA5", // Default
                    500: "#95BD99",
                    600: "#89AD8C",
                    700: "#7D9E80",
                    800: "#6B886E",
                    900: "#5A715C",
                    950: "#485B4A",
                },
                'purplium': {
                    50: "#E6E6E9",
                    100: "#D2D2D8",
                    200: "#BFBDC7",
                    300: "#ABA9B6",
                    400: "#8A869E",
                    500: "#6A6485",
                    600: "#49416D", // Default
                    700: "#413A61",
                    800: "#393254",
                    900: "#2D2843",
                    950: "#211D31",
                }
            },
        },
    },

    plugins: [forms],
};
