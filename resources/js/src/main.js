import '@/plugins/vue-composition-api'
import '@resources/sass/styles/styles.scss'
import '@resources/sass/styles/variables.scss'
import Vue from 'vue'
import vuetify from './plugins/vuetify'
import "vuetify/dist/vuetify.min.css"
import "@resources/fonts/style.css"
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
import mixins from './mixins/global'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
  resolve: name => require(`../Pages/${name}`),
  setup({ el, App, props, plugin }) {
    Vue.config.productionTip = false
    Vue.use(plugin)
    Vue.use(VueIziToast, {
      rtl: true,
      position: "bottomCenter"
    })
    Vue.prototype.$route = route
    Vue.mixin(mixins)
    new Vue({
      vuetify,
      render: h => h(App, props),
    }).$mount(el)
  },
})
InertiaProgress.init()
