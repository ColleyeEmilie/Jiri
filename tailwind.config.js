/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/*.blade.php",
        "./resources/views/livewire/*.blade.php",
        "./resources/views/pages/*.blade.php",
    ],
    theme: {
        colors:{
            'yellow': '#E09E50',
            'black' : '#2D3E4E',
            'darkGrey':'#787878',
            'lightGrey': '#D9D9D9',
            'white':'#E7E7E7',
            'lightYellow':'#FDFAF6',
            'inputBackgroundColor':'#F4F5F6',

        },
        extend: {},
    },
    plugins: [],
}

