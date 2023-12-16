<template>
  <span class="flex cursor-pointer" @click="changeVisibilityState">
    <span class="flex">
      <el-icon class="mt-1 mr-2">
        <Place />
      </el-icon>
    </span>
    <span class="flex">
      {{ props.address }}
    </span>
  </span>

  <el-dialog v-model="dialogVisible" :title="props.address">
    <div class="text-center map-body">
      <ol-map
        :loadTilesWhileInteracting="true"
        :loadTilesWhileAnimating="true"
        class="h-80"
        v-if="true"
      >
        <ol-view
          :projection="projection"
          :center="center"
          :zoom="zoom"
          ref="view"
        />
        <ol-tile-layer>
          <ol-source-osm />
        </ol-tile-layer>
      </ol-map>
      <el-image v-else>
        <template #error>
          <div class="image-slot">
            <el-icon><MapLocation /></el-icon>
          </div>
        </template>
      </el-image>
    </div>
  </el-dialog>
</template>

<script setup lang="ts">
import { MapLocation, Place } from '@element-plus/icons-vue'
import { dialogStore } from '@/stores/dialog'
import { ref } from 'vue'

// refs
const center = ref([-117.17041, 33.71568])
const projection = ref('EPSG:4326')
const zoom = ref(16)

// props
const props = defineProps<{
  address: string
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
</script>

<style scoped lang="scss">
.map-body {
  @apply bg-stone-300 text-stone-600 w-full;
}
.image-slot {
  display: flex;
  justify-content: center;
  align-items: center;
  @apply h-80 w-full text-6xl;
}
.image-slot .el-icon {
  @apply text-6xl;
}
</style>
