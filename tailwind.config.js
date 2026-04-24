import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: [
        'bg-surface-container-lowest',
        'bg-surface-container-low',
        'bg-surface-container',
        'bg-surface',
    ],

    theme: {
        extend: {
            colors: {
                'tempo-bg': '#F5F0E8',
                'tempo-sidebar': '#FAF8F5',
                'tempo-accent': '#F5D142',
                'tempo-text': '#2D2A26',
                'tempo-muted': '#6B6661',
                'tempo-border': '#E8E0D5',
                'primary': '#705d00',
                'primary-container': '#f5d142',
                'on-primary-container': '#6c5900',
                'on-surface': '#1d1c17',
                'on-surface-variant': '#4c4634',
                'surface': '#fef9f1',
                'surface-container-lowest': '#ffffff',
                'surface-container-low': '#f8f3eb',
                'surface-container': '#f2ede5',
                'surface-dim': '#ded9d2',
                'secondary': '#625e59',
                'tertiary': '#635e55',
                'error': '#ba1a1a',
                'error-container': '#ffdad6',
                'outline': '#7e7762',
                'outline-variant': '#cfc6ae',
            },
            spacing: {
                'container-padding': '32px',
                'section-margin': '48px',
                'bento-gutter': '24px',
                'element-gap': '16px',
                'unit': '8px',
            },
            fontSize: {
                'body-md': ['16px', { lineHeight: '1.6', fontWeight: '400' }],
                'body-lg': ['18px', { lineHeight: '1.6', fontWeight: '400' }],
                'headline-md': ['24px', { lineHeight: '1.3', fontWeight: '600' }],
                'headline-lg': ['32px', { lineHeight: '1.2', letterSpacing: '-0.01em', fontWeight: '600' }],
                'label-clean': ['13px', { lineHeight: '1.4', fontWeight: '300' }],
                'label-caps': ['12px', { lineHeight: '1.4', letterSpacing: '0.05em', fontWeight: '600' }],
                'display-num': ['48px', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '700' }],
            },
            fontFamily: {
                epilogue: ['Epilogue', 'sans-serif'],
                manrope: ['Manrope', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};