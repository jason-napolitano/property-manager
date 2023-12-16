<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl">Project Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>

  <section class="" id="records">
    <el-table :data="props.projects.data">
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            {{ scope.row.name }}
          </template>
        </el-table-column>
        <el-table-column label="Property">
          <template #default="scope">
            <Link
              :href="route('properties.show', scope.row.property)"
              v-text="scope.row.property.name"
            />
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Scheduled">
          <template #default="scope">
            {{ fromLaravelDate(scope.row.scheduled_at) }}
          </template>
        </el-table-column>
        <el-table-column label="Last Updated">
          <template #default="scope">
            {{ timeAgo(scope.row.updated_at) }}
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
                  :href="route('projects.destroy', scope.row)"
                  class="w-full text-center"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('projects.restore', scope.row)"
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
    <pagination :links="props.projects.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create Record"
  >
    <el-form @submit.prevent="createProject" label-position="top">
      <el-form-item label="Project Name">
        <el-input v-model="form.name"></el-input>
      </el-form-item>

      <el-form-item label="Property Selection">
        <el-col :span="11">
          <el-select
            @change="getBuildingData($event)"
            v-model="form.property_id"
            style="width: 100%"
          >
            <el-option
              v-for="item in props.properties"
              :label="item.name"
              :value="item.id"
              :key="item.id"
            />
          </el-select>
        </el-col>
        <el-col :span="2" class="" />
        <el-col :span="11">
          <el-select v-model="form.building_id" style="width: 100%">
            <el-option
              v-for="item in buildings"
              :label="item.name"
              :value="item.id"
              :key="item.id"
            />
          </el-select>
        </el-col>
      </el-form-item>

      <el-form-item label="Scheduled For">
        <el-col :span="11">
          <el-date-picker
            style="width: 100%"
            v-model="scheduledDate"
            type="date"
            placeholder="Pick a date"
            @change="generateDate"
            value-format="YYYY-MM-DD"
          />
        </el-col>
        <el-col :span="2" class="" />
        <el-col :span="11">
          <el-time-picker
            style="width: 100%"
            v-model="scheduledTime"
            @change="generateDate"
            placeholder="Pick a time"
            format="hh:mm A"
            value-format="hh:mm"
          />
        </el-col>
        <el-input class="hidden" v-model="form.scheduled_at" />
      </el-form-item>

      <el-form-item label="Description">
        <el-input
          placeholder="Please Enter a Description"
          v-model="form.description"
          type="textarea"
          :rows="4"
        />
        <div class="text-red-400">
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
import Pagination from '@/components/pagination.vue'
import { Calendar, Delete, Refresh } from '@element-plus/icons-vue'
import { dialogStore } from '@/stores/dialog'
import { IPropertyRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { IPaginatedResults } from '@/types'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import axios from 'axios'

const props = defineProps<{
  properties: IPropertyRecord[]
  projects: IPaginatedResults
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { timeAgo, fromLaravelDate } = useDate()

// reactive data
const scheduledDate = ref('')
const scheduledTime = ref('')
const humanReadable = ref('')

const buildings = ref([])
const property = ref({})

// form
const form = useForm({
  name: null,
  description: null,
  scheduled_at: '',
  exemptable: null,
  building_id: null,
  property_id: null,
})

const createProject = () => {
  form.post(route('projects.store'))
  changeVisibilityState()
  form.reset()
}

const generateDate = () => {
  form.scheduled_at = scheduledDate.value + ' ' + scheduledTime.value
  humanReadable.value = scheduledDate.value + ' at ' + scheduledTime.value
}

const getBuildingData = (e: any) => {
  const request = axios.get(route('properties.buildings', e.target.value))
  request
    .then((response) => {
      buildings.value = response.data
    })
    .catch((error) => {
      throw new error()
    })
}
</script>
<style scoped lang="scss">
.select-menu {
  @apply px-3 py-2 border rounded dark:bg-neutral-900 border-neutral-500 bg-gray-200 w-full;
}
</style>
