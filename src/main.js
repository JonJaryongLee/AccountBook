import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import VueFusionCharts from 'vue-fusioncharts'
import FusionCharts from 'fusioncharts'
import Charts from 'fusioncharts/fusioncharts.charts'
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion'
Vue.use(VueFusionCharts, FusionCharts, Charts, FusionTheme)

Vue.config.productionTip = false

new Vue({
  vuetify,
  render: h => h(App)
}).$mount('#app')
