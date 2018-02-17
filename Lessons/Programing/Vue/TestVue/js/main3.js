new Vue({
    el: '#app',
    data: {
        value: 1
    },
    methods: {
        increment (value){
            this.value = value

        }
    },
    //Computed properties - оброблені властивості
    computed:{
        doubleValue (){
            return this.value * 2
        }
    }
});