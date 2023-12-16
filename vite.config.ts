import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'
import Components from 'unplugin-vue-components/vite'
import AutoImport from 'unplugin-auto-import/vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { defineConfig } from 'vite'
import path from 'path'

export default defineConfig({
  resolve: {
    alias: {
      'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
      ziggy: '/vendor/tightenco/ziggy/src/js',
      '@': path.resolve(__dirname, './resources/vue'),
    },
  },
  plugins: [
    // ...
    AutoImport({
      resolvers: [ElementPlusResolver()],
    }),
    Components({
      resolvers: [
        ElementPlusResolver(),
      ],
    }),
    laravel({
      input: ['resources/vue/app.ts', 'resources/assets/scss/app.scss'],
      refresh: true,
    }),
    vue(),
  ],
})
