// @ts-nocheck
import { usePage } from '@inertiajs/vue3'

export function useAuth() {
  // usePage()
  let page = usePage()

  /** --------------------------------------------
   * Can a user perform a certain action?
   *
   * @param permissions {string|string[]}
   *
   * @returns {boolean}
   */
  function can(permissions: string[] | string): boolean {
    // if the permissions prop passed by inertia is not
    // an empty array
    if (page.props.auth.permissions != []) {
      // generate an empty data array
      let data: string[] = []

      // add permission names to that array
      page.props.auth.permissions.forEach((prop: { name: string }) => {
        data.push(prop.name)
      })

      // if `permissions` is a string
      if (typeof permissions === 'string') {
        // run this check
        return data.includes(permissions) || data.includes('*')
      }
      // otherwise, run this check
      return (
        permissions.every((perm) => data.includes(perm)) || data.includes('*')
      )
    }
    // permissions prop passed by inertia is not set
    // default to false
    return false
  }

  return {
    can,
  }
}
