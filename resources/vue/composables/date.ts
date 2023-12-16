import relativeTime from 'dayjs/plugin/relativeTime'
import dayjs from 'dayjs'

export function useDate() {
  /** --------------------------------------------
   * Formats a laravel date and returns it in the
   * `days ago` format
   *  - EG: `12 minutes ago`
   *
   * @param value
   *
   * @returns {string}
   */
  const timeAgo = (value: string): string => {
    dayjs.extend(relativeTime)
    return dayjs(value).fromNow()
  }

  /** --------------------------------------------
   * Return a formatted date from a laravel backend
   *
   * @param value
   * @param format
   * @returns {string}
   */
  const fromLaravelDate = (value: string, format = null): string =>
    dayjs(value).format(format ?? 'dddd MMM DD, YYYY h:mm A')

  /**
   * Converts a date into a laravel format
   *
   * @param value
   *
   * @returns {string}
   */
  const toLaravelDate = (value: string): string =>
    dayjs(value).format('YYYY-mm-DD h:mm:ss')

  /**
   * Returns the current year
   *
   * @returns {string}
   */
  const currentYear: string = new Date().getFullYear().toString()

  return {
    fromLaravelDate,
    toLaravelDate,
    currentYear,
    timeAgo,
  }
}
