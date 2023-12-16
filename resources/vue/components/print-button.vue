<script setup lang="ts">
const print = () => window.print()
</script>

<template>
  <span @click="print">
    <span class="pi pi-print text-xs"></span> <slot name="text"></slot>
  </span>
</template>

<style scoped></style>
