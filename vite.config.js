import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
export default defineConfig({
    plugins: [
        laravel({
            input: [
               
                'resources/js/app.js',
            ],
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
    resolve: {
        alias: {
           
                '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            
        
          
           '~slick-carousel': path.resolve(__dirname, 'node_modules/slick-carousel'),
            '@': './resources/js',
            '~images':'./resources/images'
        }
    },
    server: {
      
        watch: {
            usePolling: true,
        },
    },
});