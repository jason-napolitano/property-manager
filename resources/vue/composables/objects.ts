export function useObjects() {
  function clear(obj: object): void {
    for (const key in obj) {
      // @ts-ignore
      delete obj[key]
    }
  }

  return {
    clear,
  }
}
