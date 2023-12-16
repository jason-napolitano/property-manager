import { IUserRecord } from '@/types'
import { computed } from 'vue'

export function useUser() {
  const fullName = (user: IUserRecord) =>
    computed(() => user.first_name + ' ' + user.last_name).value

  return {
    fullName,
  }
}
