// components/DateDisplay.tsx
import { toEasternTime } from '../../Utils/date';
import { DateDisplayProps } from '@/types';

function EasternDateDisplay({ utcTime, format = 'yyyy-MM-dd h:mm a' }: DateDisplayProps) {
  return <span>{toEasternTime(utcTime, format)}</span>;
}

export default EasternDateDisplay;