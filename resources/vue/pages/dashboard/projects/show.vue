<template>
  <section id="heading">
    <h1 class="text-2xl">
      Showing data for record
      <em>
        <strong>{{ props.project.id }}</strong>
      </em>
    </h1>
  </section>
</template>

<script setup lang="ts">
import { IProjectRecord } from '@/types/app'

const props = defineProps<{
  project: IProjectRecord
}>()
</script>

<style scoped lang="scss">
// ...
</style>
