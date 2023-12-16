import { useDark, useToggle } from '@vueuse/core'

export function useDarkMode() {
  // is dark mode activated?
  const isDark = useDark()

  // toggle dark mode
  const toggleDarkMode = useToggle(isDark)

  return { isDark, toggleDarkMode }
}
