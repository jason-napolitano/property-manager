<template>
  <section class="mb-2 text-lg text-justify">
    In order to contact {{ appName }}, use the following form. Please try to be
    as descriptive as possible when stating your inquiry, as it will help me
    better assist you.
  </section>
  <section class="my-2">
    <el-form label-position="top" @submit.prevent="submitForm">
      <el-form-item label="Full Name">
        <el-input type="text" v-model="form.name" required />
      </el-form-item>
      <el-form-item label="Email Address">
        <el-input type="text" v-model="form.email" required />
      </el-form-item>
      <el-form-item label="Select Category">
        <el-select
          placeholder="Select"
          v-model="form.category"
          class="w-full"
          required
        >
          <el-option
            v-for="(item, index) in options"
            :key="index"
            :label="item.label"
            :value="item.label"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="Inquiry Description">
        <el-input
          type="textarea"
          :rows="5"
          v-model="form.description"
          required
        />
      </el-form-item>
      <el-form-item>
        <button type="submit" class="el-button w-full">Submit Inquiry</button>
      </el-form-item>
    </el-form>
  </section>
</template>
<script setup lang="ts">
import { useApp } from '@/composables/app'
import { useForm } from '@inertiajs/vue3'

// state and composables
const { appName } = useApp()

// form
const form = useForm({
  name: '',
  email: '',
  category: '',
  description: '',
})

const options = [
  {
    label: 'Pricing Assistance',
  },
  {
    label: 'Volunteering Inquiry',
  },
  {
    label: 'Other / Misc.',
  },
]

const submitForm = () => {
  alert('Form submitted')
  form.reset()
}
</script>
<style scoped lang="scss">
// ...
</style>
