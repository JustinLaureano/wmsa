import { SxProps, Theme } from '@mui/material/styles';

export interface LocationScanInputProps {
    onChange: (value: string) => void;
    onKeyDown: (event: React.KeyboardEvent<HTMLInputElement>) => void;
    onButtonClick: (event: React.MouseEvent<HTMLButtonElement>) => void;
    inputRef: React.RefObject<HTMLInputElement> | null;
    value: string;
    placeholder?: string;
    sx?: SxProps<Theme>;
}