//Глобальний фільтер
Vue.filter('capatilize', function(value){
    if(!value) return '';
    value = value.toString();
    return value.replace(/\b\w/g,function(l){ return l.toUpperCase()});
});

new Vue({
    el: '#app',
    data: {
        show: false,
        message: "Hello world, bla bla bla...",
        cars: [
            {model: "BMW", speed: 250.8},
            {model: "Audi", speed: 240.21},
            {model: "Mercedes-Benz AMG", speed: 350.4},
            {model: "Ford", speed: 160.5}
        ]
    },
    methods: {},
    computed: {
        showMess(){
            return this.message.toUpperCase();
        }
    },
    //Локальний фільтер
    filters: {
        lowercase (value){
            return value.toLowerCase();
        }
    }
});