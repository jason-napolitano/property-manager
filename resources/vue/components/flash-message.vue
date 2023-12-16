<template>
  <div
    :class="`alert-${$page.props.flash.context} flex`"
    v-if="$page.props.flash.message"
  >
    <el-icon class="mt-1 mr-1" size="large"><InfoFilled /></el-icon>
    <span class="">{{ $page.props.flash.message }}</span>
  </div>
</template>

<script setup lang="ts">
import { InfoFilled } from '@element-plus/icons-vue'
</script>

<style scoped></style>
