import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: '/wonder_wisata1/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            ssr: false,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'public/build',
        assetsDir: 'assets',
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
