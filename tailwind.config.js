/** @type {import('tailwindcss').Config} */
export default {
    content: ['./resources/views/**/*.blade.php',],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',

            },
        },
    },
    plugins: [],
};
