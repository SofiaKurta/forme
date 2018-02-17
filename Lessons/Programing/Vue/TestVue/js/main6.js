//Компонент в Vue (кусок кода)
Vue.component('app-car',{
    //тут дата являється функцією, а не обєктом!
    data: function(){
        return {cars: [
                {model: "BMW"},
                {model: "Audi"},
                {model: "Mercedes-Benz AMG"},
                {model: "Ford"},
                {model: "Volvo"},
                {model: "Fiat"},
                {model: "Siat"}
            ]
        }
    },
    template: '<div><div class="car" v-for="car in cars"><p>{{ car.model }}</p></div></div>' // додаємо обгортку, ще один div, щоб цикл не створював багато div'ів, а вертав тільки один!
});

new Vue({
    el: '#app',
    //Локальний компонент
    components: {
        'app-user': {
            data: function(){
                return {users: [
                        {name: "Ivan"},
                        {name: "Petya.A"},
                        {name: "Metya"},
                        {name: "John"},
                        {name: "Babiy"},
                        {name: "Surgat"},
                        {name: "Cin-Chao"}
                    ]
                }
            },
            template: '<div><div class="user" v-for="user in users"><p>{{ user.name }}</p></div></div>' // додаємо обгортку, ще один div, щоб цикл не створював багато div'ів, а вертав тільки один!
        }
    }
});

new Vue({
    el: '#app2',
    data: {

    }
});