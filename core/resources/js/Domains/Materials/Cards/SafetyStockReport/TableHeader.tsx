import { TableCell, TableHead, TableRow, Typography, useTheme } from '@mui/material';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function TableHeader() {
    const { lang } = useLanguage();
    const theme = useTheme();

	return (
		<TableHead>
			<TableRow>
				<TableCell sx={{ borderBottom: 'none' }} />
				<TableCell
					align="center"
					colSpan={3}
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
						borderBottom: 'none'
					}}
				>
					<Typography
						variant="overline"
						fontWeight="bold"
						color="primary"
					>
						{lang.plant_2}
					</Typography>
				</TableCell>
				<TableCell
					align="center"
					colSpan={3}
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
						borderBottom: 'none'
					}}
				>
					<Typography
						variant="overline"
						fontWeight="bold"
						color="primary"
					>
						{lang.blackhawk}
					</Typography>
				</TableCell>
				<TableCell
					align="center"
					colSpan={3}
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
						borderBottom: 'none'
					}}
				>
					<Typography
						variant="overline"
						fontWeight="bold"
						color="primary"
					>
						{lang.defiance}
					</Typography>
				</TableCell>
			</TableRow>
			<TableRow>
				<TableCell>
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.part_number}
					</Typography>
				</TableCell>

				<TableCell
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
					}}
				>
				</TableCell>
				<TableCell
					align="center"
				>
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.safety_stock}
					</Typography>
				</TableCell>
				<TableCell align="center">
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.on_hand}
					</Typography>
				</TableCell>

				<TableCell
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
					}}
				>
				</TableCell>
				<TableCell
					align="center"
				>
					<Typography
						variant="subtitle2"
						fontWeight="bold">{lang.safety_stock}</Typography>
				</TableCell>
				<TableCell align="center">
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.on_hand}
					</Typography>
				</TableCell>

				<TableCell
					sx={{
						borderLeft: `1px solid ${theme.palette.divider}`,
					}}
				>
				</TableCell>
				<TableCell
					align="center"
				>
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.safety_stock}
					</Typography>
				</TableCell>
				<TableCell align="center">
					<Typography
						variant="subtitle2"
						fontWeight="bold"
					>
						{lang.on_hand}
					</Typography>
				</TableCell>
			</TableRow>
		</TableHead>
	);
}