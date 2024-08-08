import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url'
// export default defineConfig({
//     plugins: [
//         laravel([
//             'resources/css/app.css',
//             'resources/js/app.js',
//         ]),
//         vue(3),
//     ],
//     resolve: {
//         alias: {
//             '@': '/resources/js'
//         }
//     }
// });

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ])
    ],
    resolve: {
      alias: {
        '@': fileURLToPath(new URL('./resources/js', import.meta.url))
      }
    }
  })
  