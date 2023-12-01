<script setup>
  import {useFakeImageStore} from "@/stores/fakeImage";
  const fakeImageStore = useFakeImageStore()

  const doStartProcess = () => {
    fakeImageStore.doStartProcess();
  }

</script>

<template>
  <h1> Fake Image </h1>
  <button @click="doStartProcess"> Start Process  </button>
</template>

<style scoped>

</style>
