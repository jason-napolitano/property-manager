// @ts-nocheck
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import DefaultLayout from './layouts/default.vue'
import OpenLayersMap from 'vue3-openlayers'
import { createApp, h } from 'vue'
import { vMaska } from 'maska'

// css
import 'element-plus/theme-chalk/dark/css-vars.css'
import 'vue3-openlayers/styles.css'
import '../assets/scss/app.scss'

const app = createInertiaApp({
  title: (title) =>
    title
      ? `${title} - ` + import.meta.env.VITE_APP_NAME
      : import.meta.env.VITE_APP_NAME,
  resolve: (name) => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    let page = pages[`./pages/${name}.vue`]
    page.default.layout = page.default.layout || DefaultLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      // directives
      .directive('maska', vMaska)
      // components
      .component('Link', Link)
      .use(OpenLayersMap, {
        // ...
      })
      .use(ZiggyVue)
      .use(plugin)
      .mount(el)
  },
  progress: false,
  // progress: {
  //     color: '#dd2222',
  // }
})

app.then(() => {
  // ...
})
