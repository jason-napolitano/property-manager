<template>
  <el-row>
    <el-col :span="8"></el-col>
    <el-col :span="8">
      <LoginForm />
    </el-col>
    <el-col :span="8"></el-col>
  </el-row>
</template>

<script setup lang="ts">
import LoginForm from '@/components/forms/users/login.vue'
</script>
