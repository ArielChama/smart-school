const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#0062FF',
                'secondary': '#7E84A3'
              },
            backgroundImage: {
                'backgroundLogin': "url('/images/Banner-image.jpg')",
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
};