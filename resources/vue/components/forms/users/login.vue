<template>
  <el-form @submit.prevent="submit" label-position="top">
    <el-form-item label="Email Address">
      <el-input v-model="form.email" id="email" clearable required />
      <div class="text-red-500" v-if="form.errors.email">
        {{ form.errors.password }}
      </div>
    </el-form-item>

    <el-form-item label="Password">
      <el-input
        v-model="form.password"
        type="password"
        id="first_name"
        clearable
        required
      />
      <div class="text-red-500" v-if="form.errors.password">
        {{ form.errors.password }}
      </div>
    </el-form-item>

    <el-form-item>
      <button
        class="el-button w-full"
        :class="{ disabled: form.processing }"
        :disabled="form.processing"
        type="submit"
      >
        Submit
      </button>
    </el-form-item>
  </el-form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  password: null,
  email: null,
})

function submit() {
  // @ts-ignore
  form.post(route('login.index'), form)
}
</script>
