import { format, toZonedTime, fromZonedTime } from 'date-fns-tz';
import { isValid, parseISO } from 'date-fns';

/**
 * Convert UTC timestamp to Eastern Time (America/New_York) and format it
 * @param utcString - UTC timestamp string
 * @param formatString - Format string
 * @returns Formatted date string
 */
export function toEasternTime(
	utcString: string,
	formatString: string
): string {
	try {
		const date = parseISO(utcString); // Parse ISO 8601 string (e.g., 2025-06-03T14:34:00.000Z)
		if (!isValid(date)) return 'Invalid Date';

		const easternDate = toZonedTime(date, 'America/New_York');

		return format(easternDate, formatString, { timeZone: 'America/New_York' });
	}
	catch (error) {
		return 'Invalid Date';
	}
}

/**
 * Convert UTC timestamp to the user's local timezone (detected from browser) and format it
 * @param utcString - UTC timestamp string
 * @param formatString - Format string
 * @returns Formatted date string
 */
export function toLocalTime(
	utcString: string,
	formatString: string
): string {
	try {
		const date = parseISO(utcString);
		if (!isValid(date)) return 'Invalid Date';

		// Use Intl API to detect user's timezone
		const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
		const localDate = toZonedTime(date, userTimeZone);

		return format(localDate, formatString, { timeZone: userTimeZone });
	}
	catch (error) {
		return 'Invalid Date';
	}
}

/**
 * Convert a local time (in America/New_York or user’s timezone) to UTC for backend submission
 * @param localDate - Local date string or Date object
 * @param timeZone - Timezone string (default: 'America/New_York')
 * @returns UTC timestamp string or null if invalid
 */
export function toUtcTime(
	localDate: string | Date,
	timeZone: string = 'America/New_York'
): string | null {
	try {
		const date = localDate instanceof Date ? localDate : parseISO(localDate);
		if (!isValid(date)) return null;

		const utcDate = fromZonedTime(date, timeZone);

		return format(utcDate, "yyyy-MM-dd'T'HH:mm:ss.SSS'Z'");
	}
	catch (error) {
		return null;
	}
}
