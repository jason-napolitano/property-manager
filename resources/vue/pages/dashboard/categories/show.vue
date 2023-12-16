<template>
  <ShowLayout
    :heading="`Category Index for ${props.category.name}`"
    :show-tabs="false"
  >
  </ShowLayout>
</template>

<script setup lang="ts">
import ShowLayout from '@/layouts/dashboard/show.vue'
import { ICategoryRecord } from '@/types/app'

const props = defineProps<{
  category: ICategoryRecord
}>()
</script>

<style scoped lang="scss">
// ...
</style>
