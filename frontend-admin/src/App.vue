<template>
  <div id="app">
    <navbar  v-if="($route.name!='login')"></navbar>
    <router-view/>
  </div>
</template>

<script>
import navbar from './components/navbar'

export default {
  name: 'App',
  components: {
    navbar
  }
}
</script>

<style>
a:hover {
    text-decoration:none;
}
</style>
