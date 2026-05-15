import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

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
                status: {
                    review: '#EF4743',
                    progress: '#FFA116',
                    mastered: '#00B8A3',
                },
                difficulty: {
                    junior: '#00B8A3',
                    mid: '#FFA116',
                    senior: '#EF4743',
                },
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.3s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    safelist: [
        // Status colors - bg
        'bg-status-review', 'bg-status-review/10', 'bg-status-review/20',
        'bg-status-progress', 'bg-status-progress/10', 'bg-status-progress/20',
        'bg-status-mastered', 'bg-status-mastered/10', 'bg-status-mastered/20',
        // Status colors - text
        'text-status-review', 'text-status-progress', 'text-status-mastered',
        // Status colors - border
        'border-status-review', 'border-status-progress', 'border-status-mastered',
        // Status colors - hover
        'hover:bg-status-review', 'hover:bg-status-progress', 'hover:bg-status-mastered',
        'hover:bg-status-review/80', 'hover:bg-status-progress/80', 'hover:bg-status-mastered/80',
        'hover:border-status-review', 'hover:border-status-progress', 'hover:border-status-mastered',
        'hover:text-status-review', 'hover:text-status-progress', 'hover:text-status-mastered',
        'hover:bg-status-review/20', 'hover:bg-status-progress/20', 'hover:bg-status-mastered/20',
        // Difficulty colors - bg
        'bg-difficulty-junior', 'bg-difficulty-junior/10', 'bg-difficulty-junior/20',
        'bg-difficulty-mid', 'bg-difficulty-mid/10', 'bg-difficulty-mid/20',
        'bg-difficulty-senior', 'bg-difficulty-senior/10', 'bg-difficulty-senior/20',
        // Difficulty colors - text
        'text-difficulty-junior', 'text-difficulty-mid', 'text-difficulty-senior',
        // Difficulty colors - border
        'border-difficulty-junior', 'border-difficulty-mid', 'border-difficulty-senior',
        // Difficulty colors - hover
        'hover:bg-difficulty-junior', 'hover:bg-difficulty-mid', 'hover:bg-difficulty-senior',
        'hover:bg-difficulty-junior/10', 'hover:bg-difficulty-mid/10', 'hover:bg-difficulty-senior/10',
        'hover:border-difficulty-junior', 'hover:border-difficulty-mid', 'hover:border-difficulty-senior',
        // Status hover border classes used in concepts/index
        'hover:border-status-review/50',
        'hover:border-status-progress/50',
        'hover:border-status-mastered/50',
        // Ring focus classes
        'focus:ring-status-mastered',
    ],

    plugins: [forms],
};
