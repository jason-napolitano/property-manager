<template>
  <ShowLayout
    :heading="`${props.building.property.name} - ${props.building.name}`"
    :show-tabs="false"
  >
    <template #heading-buttons>
      <el-button @click="buildingDialog = !buildingDialog">
        <el-icon>
          <Edit />
        </el-icon>
      </el-button>
      <el-button @click="deleteBuilding">
        <el-icon>
          <Delete />
        </el-icon>
      </el-button>
    </template>
    <template #details>
      <el-descriptions-item label="Property">
        <Link
          class="w-full"
          :href="route('properties.show', props.building.property)"
          v-text="props.building.property.name"
        />
      </el-descriptions-item>
      <el-descriptions-item label="Telephone">
        <PhoneNumber :phone="props.building.property.phone" />
      </el-descriptions-item>
      <el-descriptions-item label="Address">
        <Address :address="props.building.property.address" />
      </el-descriptions-item>
      <el-descriptions-item label="Description">
        <div
          class="text-justify"
          :class="{ 'text-red-400': !props.building.description }"
        >
          {{ buildingDescription }}
        </div>
      </el-descriptions-item>
    </template>

    <template #tabs>
      <el-tab-pane>
        <template #label>
          <Badge :count="props.building.projects.length"> Projects </Badge>
        </template>
        <div class="mb-2 text-right">
          <el-button-group>
            <el-button>
              <el-icon>
                <Refresh />
              </el-icon>
            </el-button>
            <el-button :icon="Plus"> New Record </el-button>
          </el-button-group>
        </div>
        <div class="mt-2">
          <ProjectsTable :building="props.building" ref="projectsTable" />
        </div>
      </el-tab-pane>
    </template>
  </ShowLayout>
</template>

<script setup lang="ts">
import { Delete, Edit, Plus, Refresh } from '@element-plus/icons-vue'
import PhoneNumber from '@/components/phone-number.vue'
import ShowLayout from '@/layouts/dashboard/show.vue'
import ProjectsTable from './tables/projects.vue'
import Address from '@/components/address.vue'
import { IBuildingRecord } from '@/types/app'
import Badge from '@/components/badge.vue'
import { ref, computed } from 'vue'

// props
const props = defineProps<{
  building: IBuildingRecord
}>()

// reactive references
let buildingDialog = ref(false)

const deleteBuilding = () => {
  alert('clicked')
}

// computed
const buildingDescription = computed(
  () => props.building.description ?? 'No description available'
)
</script>

<style scoped lang="scss">
// ...
</style>
