<template>
    <div>
      <h1>{{ message }}</h1>
      <!-- передаємо перемінну message в -->
      <app-input :msg="message" @messChange="message = $event"></app-input>
    </div>
</template>

<script>
  import Input from './Field.vue'

  //для доступу з других файлів
  export default {
    data(){
      return {
        message: 'Пробний текст'
      }
    },
    components:{
      'app-input': Input
    }
  }
</script>

<!--<style scoped> - дані стилі застосовувати тільки в даному компонент і не буде росповсюджувати на весь документ -->
<style scoped>

</style>
