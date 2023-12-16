<template>
  <section class="mb-2">
    <h1 class="text-2xl">About {{ appName }}</h1>
  </section>
</template>

<script setup lang="ts">
import { useApp } from '@/composables/app'

// state and composables
const { appName } = useApp()
</script>
