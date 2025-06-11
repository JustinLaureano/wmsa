import {
	Dialog,
	DialogTitle,
	DialogContent,
	Typography,
} from '@mui/material';

export default function BarcodeLabelDialog({ open, onClose, barcodeLabel }: any) {
	return (
		<Dialog open={open} onClose={onClose}>
			<DialogTitle>Barcode Label Information</DialogTitle>
			<DialogContent>
				<Typography variant="body1">{barcodeLabel}</Typography>
			</DialogContent>
		</Dialog>
	);
};
