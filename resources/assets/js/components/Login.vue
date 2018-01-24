<template>
    <div>
        <div>
            ログインページ
        </div>
        <div>
            <button @click="login()">ログイン</button>
        </div>
    </div>
</template>
<script>
  import http from '../services/http'

  export default {
    mounted() {
      this.fetchTasks()
    },
    data() {
      return {
        tasks: [],
        name: '',
        showAlert: false,
        alertMessage: '',
      }
    },
    methods: {
      fetchTasks () {
        http.get('company', res => {
          this.tasks = res.data
        })
      },
      login () {
        http.get('company', () => {
          alert('成功')
        }, () => {
          alert('失敗')
        })
      },
    }
  }
</script>