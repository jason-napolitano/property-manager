<template>
  <el-form @submit.prevent="submitForm" label-position="top">
    <el-row>
      <el-col :span="11">
        <el-form-item label="First Name">
          <el-input
            :placeholder="user ? user.first_name : null"
            v-model="userForm.first_name"
            name="first_name"
            id="first_name"
            type="text"
            :required="!props.user"
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.first_name }}
          </div>
        </el-form-item>
      </el-col>
      <el-col :span="2"></el-col>
      <el-col :span="11">
        <el-form-item label="Last Name">
          <el-input
            :placeholder="user ? user.last_name : null"
            v-model="userForm.last_name"
            name="last_name"
            id="last_name"
            type="text"
            :required="!props.user"
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.last_name }}
          </div>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row>
      <el-col :span="11">
        <el-form-item label="Email Address">
          <el-input
            :placeholder="user ? user.email : null"
            v-model="userForm.email"
            name="email"
            type="text"
            id="email"
            :required="!props.user"
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.email }}
          </div>
        </el-form-item>
      </el-col>
      <el-col :span="2"></el-col>
      <el-col :span="11">
        <el-form-item label="Phone Number">
          <el-input
            :placeholder="user ? user.phone : null"
            data-maska="+1 (###) ###-####"
            v-model="userForm.phone"
            name="phone"
            type="text"
            id="phone"
            v-maska
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.phone }}
          </div>
        </el-form-item>
      </el-col>
    </el-row>

    <el-form-item label="Select  Role">
      <el-select
        v-model="userForm.role_id"
        value-key="id"
        placeholder="Select Role"
        class="w-full"
      >
        <el-option
          v-for="item in props.roles"
          :label="item.name"
          :value="item.id"
          :key="item.id"
        />
      </el-select>

      <div class="mt-1 text-red-400">
        {{ userForm.errors.phone }}
      </div>
    </el-form-item>

    <el-row>
      <el-col :span="11">
        <el-form-item label="Password">
          <el-input
            :placeholder="user ? user.password : null"
            v-model="userForm.password"
            type="password"
            name="password"
            id="password"
            :required="!props.user"
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.password }}
          </div>
        </el-form-item>
      </el-col>
      <el-col :span="2"></el-col>
      <el-col :span="11">
        <el-form-item v-if="!props.user" label="Password Confirmation">
          <el-input
            :placeholder="user ? user.password_confirmation : null"
            v-model="userForm.password_confirmation"
            name="password_confirmation"
            id="password_confirmation"
            type="password"
            :required="!props.user"
          />

          <div class="mt-1 text-red-400">
            {{ userForm.errors.password_confirmation }}
          </div>
        </el-form-item>
      </el-col>
    </el-row>

    <el-form-item>
      <button
        :disabled="userForm.processing"
        type="submit"
        class="el-button w-full"
      >
        {{ props.user ? 'Update Account' : 'Create Account' }}
      </button>
    </el-form-item>
  </el-form>
</template>

<script setup lang="ts">
import { IRoleRecord, IUserRecord } from '@/types'
import { dialogStore } from '@/stores/dialog'
import { useForm } from '@inertiajs/vue3'

// props
const props = withDefaults(
  defineProps<{
    user?: IUserRecord | null
    roles: IRoleRecord[]
    to: string
  }>(),
  {
    user: null,
  }
)

// state and composables
// ...

// form
const userForm = useForm({
  first_name: null,
  last_name: null,
  role_id: null,
  email: null,
  address: null,
  phone: null,
  password: null,
  password_confirmation: null,
})

// create user form
const submitForm = () => {
  if (props.user) {
    // @ts-ignore
    userForm.patch(route(`${props.to}.update`, props.user))
  } else {
    userForm.post(route(`${props.to}.store`))
  }
  userForm.reset()
}
</script>
