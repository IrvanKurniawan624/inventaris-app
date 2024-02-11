import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // refresh: true,
        }),
    ],

    optimizeDeps: {
        include: ['jquery'], // Include your vendor JS dependencies here
    },

    build: {
        outDir: 'public/build', // Specify the output directory
    },
});
