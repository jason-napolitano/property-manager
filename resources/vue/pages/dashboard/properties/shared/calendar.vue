<template></template>

<script setup lang="ts">
import { onBeforeMount, ref } from 'vue'
import axios from 'axios'

let projects = ref([])
let loading = ref(true)

const getCalendarData = async () => {
  // @ts-ignore
  const url = route('projects.calendar')
  loading.value = true
  const request = axios.get(url)
  return await request
    .then((response) => {
      projects.value = response.data['data']
      console.log(projects.value)
    })
    .then(() => (loading.value = false))
    .catch((error) => console.error(error.message))
}

onBeforeMount(() => {
  getCalendarData()
})

defineExpose({ getCalendarData })
</script>

<style scoped lang="scss">
// ...
</style>
