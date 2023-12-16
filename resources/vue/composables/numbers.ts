export function useNumber() {
  /** --------------------------------------------
   * Parses a number value and returns the
   * corresponding comma-delineated string value
   *
   * @param number {number} The value to parse
   *
   * @returns {string}
   */
  function thousandsSeparator(number: number): string {
    const num_parts = number.toString().split('.')
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    return num_parts.join('.')
  }
  return {
    thousandsSeparator,
  }
}
