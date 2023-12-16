<template>
  <section>
    <el-table v-loading="loading" :data="projects" fit>
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('projects.show', scope.row)"
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
        <el-table-column label="Building">
          <template #default="scope">
            <Link
              :href="route('buildings.show', scope.row.building[0])"
              v-text="scope.row.building[0].name"
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
        <el-table-column label="Scheduled For">
          <template #default="scope">
            {{ fromLaravelDate(scope.row.scheduled_at) }}
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column>
        <el-table-column width="45">
          <template #default="scope">
            <div class="flex">
              <el-tooltip content="Disable" placement="left">
                <Link
                  :href="route('projects.destroy', scope.row)"
                  class="w-full text-center"
                  @click="getProjects"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
            </div>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>
  </section>

  <section class="mt-4">
    <el-pagination
      :total="props.property.projects.length"
      @current-change="getProjects"
      layout="prev, pager, next"
      :page-size="5"
      background
    />
  </section>
</template>

<script setup lang="ts">
import { IPropertyRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { onBeforeMount, ref } from 'vue'
import axios from 'axios'
import { CircleClose, Delete, Search } from '@element-plus/icons-vue'

// props
const props = defineProps<{
  property: IPropertyRecord
}>()

// state and composables
const { timeAgo, fromLaravelDate } = useDate()

// reactive data
const projects = ref([])
const loading = ref(true)

// data
const getProjects = async (page: number = 1): Promise<any> => {
  // @ts-ignore
  const url = route('properties.projects', props.property)
  loading.value = true
  const request = axios.get(url, {
    params: {
      page: page,
    },
  })
  return await request
    .then((response) => {
      projects.value = response.data['data']
      console.log(projects.value)
    })
    .then(() => (loading.value = false))
    .catch((error) => console.error(error.message))
}

// setup functionality
onBeforeMount(() => getProjects())

defineExpose({
  getProjects,
})
</script>

<style scoped lang="scss"></style>
