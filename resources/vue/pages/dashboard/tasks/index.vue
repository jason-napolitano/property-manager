<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl">Task Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>

  <section class="" id="records">
    <el-table :data="props.tasks.data">
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            {{ scope.row.name }}
          </template>
        </el-table-column>
        <el-table-column label="Category">
          <template #default="scope">
            {{ scope.row.category.name }}
          </template>
        </el-table-column>
        <el-table-column label="Cost">
          <template #default="scope"> ${{ scope.row.price }}.00 </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Created">
          <template #default="scope">
            {{ fromLaravelDate(scope.created_at) }}
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
                <Link
                  :href="route('tasks.destroy', scope.row)"
                  class="w-full text-center"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('tasks.restore', scope.row)"
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
    <pagination :links="props.tasks.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create Record"
  >
    <el-form @submit.prevent="createRecord" label-position="top">
      <el-form-item label="Task Name">
        <el-input v-model="form.name" type="text" clearable />
        <div class="mt-2 text-red-400">
          {{ form.errors.name }}
        </div>
      </el-form-item>
      <el-form-item label="Task Price">
        <el-input
          v-model="form.price"
          class="w-full"
          :formatter="
            (value) => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
          "
          :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
        />
        <div class="mt-2 text-red-400">
          {{ form.errors.name }}
        </div>
      </el-form-item>

      <el-form-item label="Task Name">
        <el-select
          placeholder="Select Category"
          v-model="form.category_id"
          class="w-full"
          size="large"
          filterable
        >
          <el-option
            v-for="item in props.categories"
            :label="item.name"
            :value="item.id"
            :key="item.id"
          />
        </el-select>
        <div class="mt-2 text-red-400">
          {{ form.errors.category_id }}
        </div>
      </el-form-item>

      <el-form-item label="Task Description">
        <el-input v-model="form.description" type="textarea" :rows="5" />
        <div class="mt-2 text-red-400">
          {{ form.errors.description }}
        </div>
      </el-form-item>

      <el-form-item>
        <button type="submit" class="el-button w-full">Submit</button>
      </el-form-item>
    </el-form>
  </el-dialog>
</template>

<script setup lang="ts">
import { Delete, Refresh } from '@element-plus/icons-vue'
import Pagination from '@/components/pagination.vue'
import { dialogStore } from '@/stores/dialog'
import { ICategoryRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { IPaginatedResults } from '@/types'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{
  categories: ICategoryRecord[]
  tasks: IPaginatedResults
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { timeAgo, fromLaravelDate } = useDate()

// form
const form = useForm({
  description: '',
  category_id: '',
  price: 0,
  name: '',
})

const createRecord = () => {
  form.post(route('tasks.store'))
  form.reset()
  changeVisibilityState()
}
</script>
<style scoped lang="scss">
// ...
</style>
