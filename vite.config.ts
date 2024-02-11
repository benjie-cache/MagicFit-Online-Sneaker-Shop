import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin';
import path from 'path';
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue(),laravel(
    {
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }
  )],
  resolve: {
    alias: {
        '@': "/resources/js/",
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
      '~images': path.resolve(__dirname, './resources/images'),
    },
  },
})

