import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            // custom changes by kavita
            input: 'resources/js/app1.jsx',
            refresh: true,
        }),
        react(),
    ],
});
