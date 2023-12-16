<template>
  <el-row>
    <el-col :span="8"></el-col>
    <el-col :span="8">
      <CreateUserForm to="register" />
    </el-col>
    <el-col :span="8"></el-col>
  </el-row>
</template>

<script setup lang="ts">
import CreateUserForm from '@/components/forms/users/create.vue'
import LoginForm from '@/components/forms/users/login.vue'
</script>

<style scoped></style>
