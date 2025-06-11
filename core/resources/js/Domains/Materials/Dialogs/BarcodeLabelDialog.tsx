import { useContext } from 'react';
import {
	Dialog,
	DialogTitle,
	DialogContent,
	Typography,
	Alert,
	IconButton,
	Tooltip,
	Stack,
	Box,
	useTheme,
	Divider,
} from '@mui/material';
import { BarcodeLabelDialogProps } from '@/types';
import { ContentCopy } from '@mui/icons-material';
import LanguageContext from '@/Contexts/LanguageContext';
import { styled, SxProps } from '@mui/material/styles';

const InfoRow = ({ label, content, sx }: { label: string, content: string | number | null, sx?: SxProps }) => {
	return (
		<Stack
			direction="row"
			spacing={2}
			alignItems="center"
			sx={{
				pl: 2,
				...sx
			}}
		>
			<LabelHeaderBox sx={{ py: 1 }}>
				<Typography variant="subtitle2">{label}</Typography>
			</LabelHeaderBox>
			<LabelContentBox sx={{ py: 1 }}>
				<Typography variant="body2">{content}</Typography>
			</LabelContentBox>
		</Stack>
	);
};

const LabelHeaderBox = styled(Box)(({ theme }) => ({
	borderRight: `1px solid ${theme.palette.divider}`,
	width: '33%',
}));

const LabelContentBox = styled(Box)(({ theme }) => ({
	width: '66%',
}));

export default function BarcodeLabelDialog({ open, onClose, barcodeLabel }: BarcodeLabelDialogProps) {
	if ( !barcodeLabel ) return null;

	const { lang } = useContext(LanguageContext);
	const theme = useTheme();
	const handleCopyBarcode = () => {
		navigator.clipboard.writeText(barcodeLabel.barcode);
	};

	const handleCopyHash = () => {
		navigator.clipboard.writeText(barcodeLabel.barcode_hash);
	};

	return (
		<Dialog open={open} onClose={onClose}>
			<DialogTitle>{lang.barcode_label_information}</DialogTitle>
			<DialogContent>
				<Alert
					icon={false}
					severity="info"
					action={
						<Tooltip title={lang.copy_barcode} arrow>
							<IconButton onClick={handleCopyBarcode}>
								<ContentCopy />
							</IconButton>
						</Tooltip>
					}
				>
					<Typography variant="subtitle2">{lang.barcode}</Typography>
					<Typography variant="body2">{barcodeLabel.barcode}</Typography>
				</Alert>

				<Alert
					icon={false}
					severity="info"
					action={
						<Tooltip title={lang.copy_barcode} arrow>
							<IconButton onClick={handleCopyHash}>
								<ContentCopy />
							</IconButton>
						</Tooltip>
					}
					sx={{ mt: 2 }}
				>
					<Typography variant="subtitle2">{lang.barcode_hash}</Typography>
					<Typography variant="body2">{barcodeLabel.barcode_hash}</Typography>
				</Alert>

				<Divider sx={{ my: 3 }} />

				<InfoRow label={lang.barcode_type} content={barcodeLabel.barcode_type} sx={{ mt: 2 }} />
				<InfoRow label={lang.part_number} content={barcodeLabel.part_number} />
				<InfoRow label={lang.manufacture_date} content={barcodeLabel.manufacture_date} />
				<InfoRow label={lang.quantity} content={barcodeLabel.quantity} />
				<InfoRow label={lang.clock_number} content={barcodeLabel.clock_number} />
				<InfoRow label={lang.supplier} content={barcodeLabel.supplier} />
				<InfoRow label={lang.time} content={barcodeLabel.time} />
				<InfoRow label={lang.supplier_part_number} content={barcodeLabel.supplier_part_number} />
				<InfoRow label={lang.serial_number} content={barcodeLabel.serial_number} />
				<InfoRow label={lang.expiration_date} content={barcodeLabel.expiration_date} />
				<InfoRow label={lang.lot_number} content={barcodeLabel.lot_number} />


			</DialogContent>
		</Dialog>
	);
};
