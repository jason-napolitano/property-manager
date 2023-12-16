<template>
  <a :href="`tel:${props.phone}`">
    <div class="flex">
      <span class="flex">
        <el-icon class="mt-1 mr-2">
          <Phone />
        </el-icon>
      </span>
      <span class="flex">
        {{ props.phone }}
      </span>
    </div>
  </a>
</template>

<script setup lang="ts">
import { Phone } from '@element-plus/icons-vue'

const props = defineProps<{
  phone: string
}>()
</script>
