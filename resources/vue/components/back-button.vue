<script setup>
const goBack = () => history.back()

const props = defineProps({
  showIcon: {
    type: Boolean,
    default: true,
  },
})
</script>

<template>
  <span @click="goBack">
    <span
      class="pi pi-chevron-left text-xs"
      v-if="props.showIcon ?? true"
    ></span>
    <slot name="text"> GO BACK </slot>
  </span>
</template>

<style scoped></style>
