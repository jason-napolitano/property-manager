<template>
  <section>
    <el-table :data="properties" v-loading="loading" fit>
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('properties.show', scope.row)"
              v-text="scope.row.name"
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
        <el-table-column label="Updated">
          <template #default="scope">
            {{ fromLaravelDate(scope.row.updated_at) }}
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column>
        <el-table-column width="45">
          <template #default="scope">
            <div class="flex">
              <el-tooltip content="Disable" placement="left">
                <span
                  class="w-full text-center cursor-pointer"
                  @click="deleteProperty(scope.row)"
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

  <section class="mt-4">
    <el-pagination
      :total="props.user.properties.length"
      @current-change="getProperties"
      layout="prev, pager, next"
      :page-size="5"
      background
    />
  </section>

  <section></section>
</template>

<script setup lang="ts">
import { Delete } from '@element-plus/icons-vue'
import { IPropertyRecord } from '@/types/app'
import { useDate } from '@/composables/date'
import { ElMessageBox } from 'element-plus'
import { onBeforeMount, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { IUserRecord } from '@/types'
import axios from 'axios'

const props = defineProps<{
  user: IUserRecord
}>()

// state and composables
const { fromLaravelDate } = useDate()

// reactive references
let propertyDialog = ref(false)
let properties = ref([])
let loading = ref(true)

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
    getProperties()
  })
}

// data
const getProperties = async (page: number = 1): Promise<any> => {
  // @ts-ignore
  const url = route('users.properties', props.user)
  loading.value = true
  const request = axios.get(url, {
    params: {
      page: page,
    },
  })
  return await request
    .then((response) => {
      properties.value = response.data['data']
    })
    .then(() => (loading.value = false))
    .catch((error) => console.error(error.message))
}

//
onBeforeMount(() => getProperties())

defineExpose({
  getProperties,
})
</script>

<style scoped lang="scss">
// ...
</style>
