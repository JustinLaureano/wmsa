// components/DateDisplay.tsx
import { toLocalTime } from '../../Utils/date';
import { DateDisplayProps } from '@/types';

function LocalDateDisplay({ utcTime, format = 'yyyy-MM-dd h:mm a' }: DateDisplayProps) {
  return <span>{toLocalTime(utcTime, format)}</span>;
}

export default LocalDateDisplay;