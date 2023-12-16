// @ts-nocheck
export function useApp() {
  const appName = import.meta.env['VITE_APP_NAME']
  const appSlogan = import.meta.env['VITE_APP_SLOGAN']

  const env = (value: string): any => import.meta.env[value]

  return { appName, appSlogan, env }
}
