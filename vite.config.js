import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite'
import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
    server: {
        host: 'sw_template.test',
        port: 5174,
        hmr: {
            host: 'sw_template.test',
        },
        cors: true,
    },
    plugins: [
        tailwindcss(),
        vueDevTools(),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
