<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl">Building Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>

  <section class="" id="table">
    <el-table
      :data="props.buildings.data"
      :default-sort="{ prop: 'created_at', order: 'descending' }"
    >
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('buildings.show', scope.row)"
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
            <div v-else class="flex w-full text-red-500">
              <div class="flex mr-1 mt-1">
                <el-icon>
                  <CircleClose />
                </el-icon>
              </div>
              <div>
                <span>{{ scope.row.name }}</span>
              </div>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Property">
          <template #default="scope">
            <Link
              :href="route('properties.show', scope.row.property)"
              v-text="scope.row.property.name"
              v-if="scope.row.property"
            />
            <span v-else class="text-red-300">Property Unavailable</span>
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Created" sortable>
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
                  :href="route('buildings.destroy', scope.row)"
                  class="w-full text-center"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('buildings.restore', scope.row)"
                  v-if="scope.row.property"
                  class="w-full text-center"
                  method="put"
                  as="button"
                >
                  <el-icon><Refresh /></el-icon>
                </Link>
                <el-tooltip v-else placement="left" content="Locked">
                  <span class="w-full text-center">
                    <el-icon class="text-gray-400"><Lock /></el-icon>
                  </span>
                </el-tooltip>
              </el-tooltip>
            </div>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>
  </section>

  <section class="mt-1" id="pagination">
    <pagination :links="props.buildings.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create Record"
  >
    <el-form @submit.prevent="createBuilding" label-position="top">
      <el-row>
        <el-col :span="11">
          <el-form-item label="Building Name">
            <el-input
              placeholder="Building Name"
              v-model="form.name"
              label="Name"
              size="large"
            />
            <div class="mt-2 text-red-400">
              {{ form.errors.name }}
            </div>
          </el-form-item>
        </el-col>
        <el-col :span="2" />
        <el-col :span="11">
          <el-form-item label="Unit Count">
            <el-input-number
              placeholder="Total Units"
              v-model="form.units"
              class="w-full"
              label="Units"
              size="large"
              :min="1"
            />
            <div class="mt-2 text-red-400">
              {{ form.errors.units }}
            </div>
          </el-form-item>
        </el-col>
      </el-row>
      <el-form-item label="Property">
        <el-select
          placeholder="Select Property"
          v-model="form.property_id"
          class="w-full"
          size="large"
          filterable
        >
          <el-option
            v-for="item in props.properties"
            :label="item.name"
            :value="item.id"
            :key="item.id"
          />
        </el-select>
        <div class="mt-2 text-red-400">
          {{ form.errors.property_id }}
        </div>
      </el-form-item>

      <el-form-item label="Building Description">
        <el-input
          placeholder="Building Description"
          v-model="form.description"
          type="textarea"
          label="Name"
          size="large"
          :rows="4"
        />
        <div class="flex text-red-400">
          {{ form.errors.description }}
        </div>
      </el-form-item>

      <el-form-item>
        <button class="el-button w-full">Submit</button>
      </el-form-item>
    </el-form>
  </el-dialog>
</template>

<script setup lang="ts">
import { IBuildingRecord, IPropertyRecord } from '@/types/app'
import Pagination from '@/components/pagination.vue'
import { useString } from '@/composables/strings'
import { dialogStore } from '@/stores/dialog'
import { useDate } from '@/composables/date'
import { IPaginatedResults } from '@/types'
import { useForm } from '@inertiajs/vue3'
import {
  CircleClose,
  Delete,
  Lock,
  Refresh,
  Search,
} from '@element-plus/icons-vue'

// props
const props = defineProps<{
  buildings: IPaginatedResults
  properties: IPropertyRecord[]
  building: IBuildingRecord
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { timeAgo, fromLaravelDate } = useDate()
const { truncate } = useString()

// form
const form = useForm({
  name: '',
  units: 0,
  description: '',
  property_id: '',
})

// dialog
const createBuilding = () => {
  form.post(route('buildings.store'))
  changeVisibilityState()
  form.reset()
}
</script>
