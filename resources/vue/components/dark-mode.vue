<template>
  <span @click.prevent="toggleDarkMode()">
    <span v-if="isDark">
      <slot name="dark">
        <el-icon class="mt-1 cursor-pointer"><Sunny /></el-icon>
      </slot>
    </span>
    <span v-else>
      <slot name="light">
        <el-icon class="mt-0.5 cursor-pointer"><Moon /></el-icon>
      </slot>
    </span>
  </span>
</template>

<script setup>
import { useDarkMode } from '@/composables/dark-mode'
import { Sunny, Moon } from '@element-plus/icons-vue'
import { ref } from 'vue'

// is dark mode enabled?
const { isDark, toggleDarkMode } = useDarkMode()

// is dark mode enabled?
const enabled = ref(!!isDark)
</script>
