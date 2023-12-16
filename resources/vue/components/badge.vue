<template>
  <span>
    <slot></slot>
  </span>
  <sup>
    <small class="badge"> {{ props.count }}</small>
  </sup>
</template>

<script setup lang="ts">
const props = defineProps<{
  count: number
}>()
</script>

<style scoped>
.badge {
  @apply bg-red-600
    text-stone-100
    text-center
    relative
    ml-1.5
    p-0.5
    px-1;
}
</style>
