<template>
  <a :href="`mailto:${props.email}`">
    <div class="flex">
      <span class="flex">
        <el-icon class="mt-1 mr-2">
          <Message />
        </el-icon>
      </span>
      <span class="flex">
        {{ props.email }}
      </span>
    </div>
  </a>
</template>

<script setup lang="ts">
import { Message } from '@element-plus/icons-vue'

const props = defineProps<{
  email: string
}>()
</script>
