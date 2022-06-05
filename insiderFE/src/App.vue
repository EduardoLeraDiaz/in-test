<script setup>
import { RouterLink, RouterView } from "vue-router";

</script>

<template>
  <div class="container">
    <header>
      <h1 class="header-banner">Insider test</h1>
    </header>
    <RouterView />
  </div>

</template>

<style lang="less">
@import "@/assets/bootstrap.css";
.container {
  .header-banner {
    text-align: center;
  }
  .btn {
    border-radius: 0;
    padding: 0.2rem 0.75rem
  }
}

</style>
