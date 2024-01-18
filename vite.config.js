import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
               
            ['resources/css/app.css', 'resources/js/app.js'],
            ],
            refresh: true,
        }),
       
    ],
    resolve: {
        alias: {
           
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
          
           '~slick-carousel': path.resolve(__dirname, 'node_modules/slick-carousel'),
           '@': path.resolve(__dirname, './resources/js'),
           '~images': path.resolve(__dirname, './resources/images'), 
        },
    
    },
   
});