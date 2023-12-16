<template>
  <section class="mb-4">
    <el-table v-loading="loading" :data="buildings" fit>
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
            <div v-else class="flex w-full text-red-400">
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
        <el-table-column label="Units">
          <template #default="scope">
            {{ scope.row.units }}
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
              <el-tooltip content="Disable" placement="left">
                <span
                  class="w-full text-center"
                  @click="deleteBuilding(scope.row)"
                >
                  <el-icon><Delete /></el-icon>
                </span>
              </el-tooltip>
            </div>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>
  </section>

  <section class="mt-2">
    <el-pagination
      :total="props.property.buildings.length"
      @current-change="getBuildings"
      layout="prev, pager, next"
      :page-size="5"
      background
    />
  </section>
</template>

<script setup lang="ts">
import { CircleClose, Search, Delete } from '@element-plus/icons-vue'
import { IPropertyRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { IPaginatedResults } from '@/types'
import { ElMessageBox } from 'element-plus'
import { onBeforeMount, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

// props
const props = defineProps<{
  property: IPropertyRecord
}>()

// state and composables
const { timeAgo, fromLaravelDate } = useDate()

// refs
const buildings = ref<IPaginatedResults>()
const loading = ref<boolean>(true)

const getBuildings = async (page: number = 1): Promise<any> => {
  // @ts-ignore
  const url = route('properties.buildings', props.property)
  loading.value = true
  const request = axios.get(url, {
    params: {
      page: page,
    },
  })
  return await request
    .then((response) => {
      buildings.value = response.data['data']
    })
    .then(() => (loading.value = false))
    .catch((error) => console.error(error.message))
}

const deleteBuilding = (building: IPropertyRecord) => {
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
    router.delete(route('buildings.destroy', building))
    loading.value = !loading.value
    getBuildings()
  })
}

// setup functionality
onBeforeMount(() => getBuildings())

console.log(props.property.buildings.length)

defineExpose({
  getBuildings,
})
</script>
