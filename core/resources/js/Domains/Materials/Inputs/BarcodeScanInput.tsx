import {
    Paper,
    Stack,
    Divider,
    IconButton,
} from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '@/Components/Styled/StyledInputBase';
import { BarcodeScanInputProps } from '@/types';

export default function BarcodeScanInput({
    onChange,
    onKeyDown,
    onButtonClick,
    value,
    placeholder = 'barcode',
    sx,
    ...rest
}: BarcodeScanInputProps) {
    return (
        <Paper
            elevation={0}
            variant="outlined"
            sx={{
                p: '3px 8px',
                minWidth: '300px',
                boxShadow: 'none',
                ...sx
            }}
        >
            <Stack
                direction="row"
                alignItems="center"
            >
                <StyledInputBase
                    placeholder={placeholder}
                    value={value}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) => onChange(e.target.value)}
                    onKeyDown={onKeyDown}
                    sx={{ flexGrow: 1 }}
                    {...rest}
                />

                <Divider
                    orientation="vertical"
                    flexItem
                    sx={{ mr: 1 }}
                />

                <IconButton
                    color="primary"
                    onClick={onButtonClick}
                >
                    <Send />
                </IconButton>
            </Stack>
        </Paper>
    );
}
