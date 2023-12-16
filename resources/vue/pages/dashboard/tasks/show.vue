<template>
  <section id="heading">
    <h1 class="text-2xl">
      Showing data for record
      <em>
        <strong>{{ props.task.id }}</strong>
      </em>
    </h1>
  </section>
</template>

<script setup lang="ts">
import { ITaskRecord } from '@/types/app'

const props = defineProps<{
  task: ITaskRecord
}>()
</script>

<style scoped lang="scss">
// ...
</style>
