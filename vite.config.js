import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('react') || id.includes('react-dom')) {
                            return 'react';
                        }
                        if (id.includes('react-router')) {
                            return 'router';
                        }
                        if (id.includes('react-icons')) {
                            return 'icons';
                        }
                        return 'vendor';
                    }
                },
            },
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/main.jsx',
            refresh: true,
        }),
        react(),
    ],
});