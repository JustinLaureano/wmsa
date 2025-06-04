import { SxProps, Theme } from '@mui/material/styles';

export interface BarcodeScanInputProps {
    onChange: (value: string) => void;
    onKeyDown: (event: React.KeyboardEvent<HTMLInputElement>) => void;
    onButtonClick: (event: React.MouseEvent<HTMLButtonElement>) => void;
    value: string;
    placeholder?: string;
    sx?: SxProps<Theme>;
}