import {
    TableCell,
    TableRow,
    Typography,
} from '@mui/material';
import { SafetyStockReportResource } from '@/types';
import SafetyStockDataCell from './SafetyStockDataCell';

export default function MaterialTableRow({ material }: { material: SafetyStockReportResource }) {
	console.log(material);

	const {
		part_number,
		building_1_safety_stock_formatted,
		building_1_on_hand_formatted,
		building_1_difference,
		building_1_notes,
		building_2_safety_stock_formatted,
		building_2_on_hand_formatted,
		building_2_difference,
		building_2_notes,
		building_3_safety_stock_formatted,
		building_3_on_hand_formatted,
		building_3_difference,
		building_3_notes,
	} = material.computed;

	return (
		<TableRow key={material.uuid}>
			<TableCell sx={{ verticalAlign: 'baseline' }}>
				<Typography variant="subtitle2">{part_number}</Typography>
			</TableCell>
			<SafetyStockDataCell
				safetyStock={building_1_safety_stock_formatted}
				onHand={building_1_on_hand_formatted}
				notes={building_1_notes}
				difference={building_1_difference}
			/>
			<SafetyStockDataCell
				safetyStock={building_2_safety_stock_formatted}
				onHand={building_2_on_hand_formatted}
				notes={building_2_notes}
				difference={building_2_difference}
			/>
			<SafetyStockDataCell
				safetyStock={building_3_safety_stock_formatted}
				onHand={building_3_on_hand_formatted}
				notes={building_3_notes}
				difference={building_3_difference}
			/>
		</TableRow>
	);
}