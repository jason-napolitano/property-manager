<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl-2xl">Category Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>

  <section class="" id="records">
    <el-table :data="props.categories.data">
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('categories.show', scope.row)"
              v-text="scope.row.name"
            />
          </template>
        </el-table-column>
        <el-table-column label="Description">
          <template #default="scope">
            {{ truncate(scope.row.description, 45) }}
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Created">
          <template #default="scope">
            {{ fromLaravelDate(scope.created_at) }}
          </template>
        </el-table-column>
        <el-table-column label="Updated">
          <template #default="scope">
            {{ timeAgo(scope.updated_at) }}
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
                  :href="route('categories.destroy', scope.row)"
                  class="w-full text-center"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('categories.restore', scope.row)"
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
    <pagination :links="props.categories.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create Record"
  >
    <el-form @submit.prevent="createRecord" label-position="top">
      <el-form-item label="Category Name">
        <el-input v-model="form.name" type="text" clearable />
        <div class="mt-2 text-red-400">
          {{ form.errors.name }}
        </div>
      </el-form-item>

      <el-form-item label="Category Description">
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
import { useString } from '@/composables/strings'
import { dialogStore } from '@/stores/dialog'
import { useDate } from '@/composables/date'
import { IPaginatedResults } from '@/types'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{
  categories: IPaginatedResults
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { timeAgo, fromLaravelDate } = useDate()
const { truncate } = useString()

// form
const form = useForm({
  name: '',
  description: '',
})

const createRecord = () => {
  form.post(route('categories.store'))
  form.reset()
  changeVisibilityState()
}
</script>
<style scoped lang="scss">
// ...
</style>
