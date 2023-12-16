import { createGlobalState } from '@vueuse/core'
import { ref } from 'vue'

export const dialogStore = createGlobalState(() => {
  let dialogVisible = ref(false)

  const changeVisibilityState = (state: boolean | null = null) => {
    dialogVisible.value = state ? state : !dialogVisible.value
  }
  return { dialogVisible, changeVisibilityState }
})
