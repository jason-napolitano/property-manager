<template>
  <ShowLayout :heading="fullName(props.user)">
    <template #heading-buttons>
      <el-button @click="editDialog = !editDialog">
        <el-icon>
          <Edit />
        </el-icon>
      </el-button>
      <!--
      <el-button @click="deleteUser">
        <el-icon>
          <Delete />
        </el-icon>
      </el-button>
        -->
    </template>
    <template #details>
      <el-descriptions-item>
        <template #label>
          <div class="cell-item">Name</div>
        </template>
        {{ fullName(props.user) }}
      </el-descriptions-item>
      <el-descriptions-item>
        <template #label>
          <div class="cell-item">Telephone</div>
        </template>
        <PhoneNumber :phone="props.user.phone" />
      </el-descriptions-item>
      <el-descriptions-item>
        <template #label>
          <div class="cell-item">Email</div>
        </template>
        <EmailAddress :email="props.user.email" />
      </el-descriptions-item>
      <el-descriptions-item>
        <template #label>
          <div class="cell-item">Biography</div>
        </template>
        Nothing available
      </el-descriptions-item>
    </template>

    <template #tabs>
      <el-tab-pane>
        <template #label>
          <Badge :count="props.user.properties.length"> Properties </Badge>
        </template>
        <div class="mb-2 text-right">
          <el-button :icon="Plus" @click="propertyDialog = !propertyDialog">
            New Record
          </el-button>
        </div>
        <PropertiesTable :user="props.user" ref="propertiesTable" />
      </el-tab-pane>
    </template>

    <template #footer>
      <!-- Dialog Window -->
      <el-dialog
        :close-auto-focus="(propertyDialog = !propertyDialog)"
        :close="(propertyDialog = !propertyDialog)"
        v-model="propertyDialog"
        title="Create Record"
      >
        <el-form @submit.prevent="createProperty" label-position="top">
          <el-form-item label="Name">
            <el-input
              v-model="propertyForm.name"
              label="Name"
              size="large"
              placeholder="Name"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.name }}
            </div>
          </el-form-item>

          <el-form-item label="Address">
            <el-input
              placeholder="Address"
              v-model="propertyForm.address"
              label="Address"
              size="large"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.address }}
            </div>
          </el-form-item>

          <el-form-item label="Phone">
            <el-input
              placeholder="Phone Number"
              v-maska
              data-maska="1 (###) ###-####"
              v-model="propertyForm.phone"
              label="Phone"
              size="large"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.phone }}
            </div>
          </el-form-item>

          <el-form-item label="Description">
            <el-input
              placeholder="Description"
              v-model="propertyForm.description"
              type="textarea"
              :rows="4"
            />
            <div class="my-2 flex text-stone-400">
              <div class="flex text-red-400">
                {{ propertyForm.errors.description }}
              </div>
            </div>
          </el-form-item>

          <el-form-item label="INSERT">
            <button class="el-button w-full">Submit</button>
          </el-form-item>
        </el-form>
      </el-dialog>

      <!-- Dialog Window -->
      <el-dialog
        :close-auto-focus="(editDialog = !editDialog)"
        :close="(editDialog = !editDialog)"
        v-model="editDialog"
        title="Create User"
      >
        <el-form @submit.prevent="updateUser" label-position="top">
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
      </el-dialog>
    </template>
  </ShowLayout>
</template>

<script setup lang="ts">
import EmailAddress from '@/components/email-address.vue'
import PhoneNumber from '@/components/phone-number.vue'
import { Delete, Edit, Plus } from '@element-plus/icons-vue'
import PropertiesTable from './tables/properties.vue'
import ShowLayout from '@/layouts/dashboard/show.vue'
import { IRoleRecord, IUserRecord } from '@/types'
import { useUser } from '@/composables/user'
import { ElMessageBox } from 'element-plus'
import Badge from '@/components/badge.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

// props
const props = defineProps<{
  roles: IRoleRecord[]
  user: IUserRecord
}>()

// state and composables
const { fullName } = useUser()

// reactive references
let propertyDialog = ref(false)
let editDialog = ref(false)
let propertiesTable = ref()

// forms
const propertyForm = useForm({
  name: '',
  description: '',
  address: '',
  phone: '',
  client_id: props.user.id,
})

// forms

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

// dialog
const createProperty = () => {
  propertyForm.post(route('properties.store'))
  propertyDialog.value = !propertyDialog.value
  propertiesTable.value.getProperties()
  propertyForm.reset()
}

const updateUser = () => {
  // @ts-ignore
  userForm.patch(route('users.update', props.user))
  editDialog.value = !editDialog.value
  userForm.reset()
}

const deleteUser = () => {
  ElMessageBox.confirm(
    'You are about to delete this record. Continue?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'error',
    }
  ).then(() => {
    // @ts-ignore
    userForm.delete(route('users.destroy', props.user))
  })
}
</script>

<style scoped lang="scss">
// ...
</style>
