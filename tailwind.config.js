import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.blade.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palette inspirée de LeetCode
                dark: {
                    50: '#F5F5F5',
                    100: '#E5E5E5',
                    200: '#D4D4D4',
                    300: '#A3A3A3',
                    400: '#737373',
                    500: '#525252',
                    600: '#404040',
                    700: '#2D2D2D',
                    800: '#262626',
                    900: '#1A1A1A',
                },
                // Couleurs de statut
                status: {
                    review: '#EF4743',    // Rouge - À revoir
                    progress: '#FFA116',  // Orange - En cours
                    mastered: '#00B8A3',  // Vert - Maîtrisé
                },
                // Couleurs de difficulté
                difficulty: {
                    junior: '#00B8A3',    // Vert - Junior
                    mid: '#FFA116',       // Orange - Mid
                    senior: '#EF4743',    // Rouge - Senior
                },
            },
        },
    },

    plugins: [forms],
};