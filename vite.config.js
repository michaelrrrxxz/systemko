import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '192.168.1.78', // Your local IP address:
        port: 5173,              // Default Vite port
        cors: true,              // Enable CORS
        hmr: {
            host: '192.168.1.78', // HMR host to match the IP
            protocol: 'ws',          // or 'wss' if you're using HTTPS
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
});
