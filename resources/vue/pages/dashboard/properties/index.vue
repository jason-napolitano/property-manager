<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl">Property Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>

  <section class="" id="table">
    <el-table :data="props.properties.data">
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('properties.show', scope.row)"
              v-if="!scope.row.deleted_at"
              class="flex w-full"
            >
              <div class="flex mr-1 mt-1">
                <el-icon class="cursor-pointer">
                  <Search />
                </el-icon>
              </div>
              <div v-text="scope.row.name" />
            </Link>
            <div v-else class="flex w-full text-red-300">
              <div class="flex mr-1 mt-1">
                <el-icon class="cursor-pointer">
                  <CircleClose />
                </el-icon>
              </div>
              <div>
                <span>{{ scope.row.name }}</span>
              </div>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Client">
          <template #default="scope">
            <Link
              :href="route('users.show', scope.row.client)"
              v-text="fullName(scope.row.client)"
              class="w-full"
            />
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Created">
          <template #default="scope">
            {{ fromLaravelDate(scope.row.created_at) }}
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column>
        <el-table-column width="45">
          <template #default="scope">
            <div class="flex">
              <el-tooltip
                v-if="!scope.row.deleted_at"
                content="Disable"
                placement="left"
              >
                <span
                  @click="deleteProperty(scope.row)"
                  class="w-full text-center cursor-pointer"
                >
                  <el-icon><Delete /></el-icon>
                </span>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('properties.restore', scope.row)"
                  class="w-full text-center"
                  method="put"
                  as="button"
                >
                  <el-icon><Refresh /></el-icon>
                </Link>
              </el-tooltip>
            </div>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>
  </section>

  <section class="mt-1" id="pagination">
    <pagination :links="props.properties.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create Record"
  >
    <form @submit.prevent="createProperty">
      <div class="my-2">
        <el-input
          v-model="form.name"
          label="Name"
          size="large"
          :placeholder="props.property ? props.property.name : 'Name'"
        />
        <div class="mt-2 text-red-400">
          {{ form.errors.name }}
        </div>
      </div>

      <div class="my-2">
        <el-input
          :placeholder="props.property ? props.property.address : 'Address'"
          v-model="form.address"
          label="Address"
          size="large"
        />
        <div class="mt-2 text-red-400">
          {{ form.errors.address }}
        </div>
      </div>

      <div class="my-2">
        <el-input
          :placeholder="props.property ? props.property.phone : 'Phone Number'"
          v-maska
          data-maska="1 (###) ###-####"
          v-model="form.phone"
          label="Phone"
          size="large"
        />
        <div class="mt-2 text-red-400">
          {{ form.errors.phone }}
        </div>
      </div>

      <div class="my-2">
        <el-select
          :placeholder="
            props.property ? props.property.client_id : 'Select Client'
          "
          v-model="form.client_id"
          class="w-full"
          size="large"
          filterable
        >
          <el-option
            v-for="item in props.clients"
            :label="fullName(item)"
            :value="item.id"
            :key="item.id"
          />
        </el-select>
        <div class="mt-2 text-red-400">
          {{ form.errors.client_id }}
        </div>
      </div>

      <div class="my-2">
        <el-input
          :placeholder="
            props.property ? props.property.description : 'Description'
          "
          v-model="form.description"
          type="textarea"
          :rows="4"
        />
        <div class="my-2 flex text-stone-400">
          <div class="flex text-red-400">
            {{ form.errors.description }}
          </div>
        </div>
      </div>

      <div class="my-2 text-right">
        <button class="el-button w-full">Submit</button>
      </div>
    </form>
  </el-dialog>
</template>

<script setup lang="ts">
import { CircleClose, Delete, Refresh, Search } from '@element-plus/icons-vue'
import { IPaginatedResults, IUserRecord } from '@/types'
import Pagination from '@/components/pagination.vue'
import { dialogStore } from '@/stores/dialog'
import { IPropertyRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { useUser } from '@/composables/user'
import { ElMessageBox } from 'element-plus'
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

// props
const props = defineProps<{
  properties: IPaginatedResults
  property: IPropertyRecord | null
  clients: IUserRecord[]
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { fromLaravelDate } = useDate()
const { fullName } = useUser()

// form
const form = useForm({
  name: '',
  description: '',
  address: '',
  phone: '',
  client_id: '',
})

// dialog
const createProperty = () => {
  form.post(route('properties.store'))
  changeVisibilityState()
  form.reset()
}

const deleteProperty = (property: IPropertyRecord) => {
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
    router.delete(route('properties.destroy', property))
  })
}
</script>
