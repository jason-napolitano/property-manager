export function useArray() {
  /**
   * Do two arrays have matching keys?
   *
   * @param a {any[]} The first array
   * @param b {any[]} The second array
   */
  const equals = (a: any[], b: any[]): boolean =>
    Array.isArray(a) &&
    Array.isArray(b) &&
    a.length === b.length &&
    a.every((val, index) => val === b[index])

  /**
   * Removes an element from an array
   *
   * @param {any[]} arr
   * @param {any} value
   */
  const remove = (arr: any[], value: any) =>
    arr.filter((element) => element != value)

  return {
    remove,
    equals,
  }
}
