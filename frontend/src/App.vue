<template>
  <div id="app">
    <navbar v-if="($route.name!='login' && $route.name!='register')"></navbar>
    <router-view/>
  </div>
</template>

<script>
import navbar from './components/navbar'

export default {
  name: 'App',
  components: {
    navbar
  },
  mounted() {
    if (localStorage.getItem('tkn') == null) {
      window.location.assign('#/login')
    }
  }
}
</script>

<style>
a:hover {
    text-decoration:none;
}
</style>
