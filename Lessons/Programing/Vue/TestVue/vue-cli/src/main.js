import Vue from 'vue'
import App from './App.vue'
import Example from './Example.vue'

Vue.component('app-example', Example)

new Vue({
  el: '#app',
  //App імпортований App.vue
  render: h => h(App)
})
