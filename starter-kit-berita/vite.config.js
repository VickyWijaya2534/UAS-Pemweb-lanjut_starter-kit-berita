import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // MODIFIKASI BAGIAN INPUT DI BAWAH INI
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

            ],
            refresh: true,
        }),
    ],
});