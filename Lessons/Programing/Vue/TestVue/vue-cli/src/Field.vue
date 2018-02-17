<template>
  <div>
    <h3>{{ msg }}</h3>
    <!-- v-model - це практично те саме що v-bind тільки він зразу поміщає будь-яке значення в перемінну -->
    <!-- <input type="text" v-model="mess"> -->
    <input type="text" :value="msg" @input="changeMess"> <!-- @input - означає, що при введені в поле будемо викликати ф-цію -->
    <p>{{ mess }}</p>
  </div>
</template>

<script>
    //для доступу з других файлів
    export default {
      //називаємо атрибут, який хочемо отримати
      props: ['msg'],
      data () {
        return {
          mess: ''
        }
      },
      methods:{
        changeMess(event){
          this.mess = event.target.value;
          this.$emit('messChange',this.mess) //передаємо дані в батьківський елемент
        }
      }
    }
</script>

<style scoped>

</style>
