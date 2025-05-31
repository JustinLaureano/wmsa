import { SxProps, Theme } from '@mui/material/styles';

export interface Option {
    uuid?: string;
    label: string;
    value?: string;
}

export interface ComboBoxProps {
    options: Option[];
    inputLabel: string;
    onChange?: (value: Option | null) => void;
    onInputChange?: (value: string) => void;
    value?: Option | null;
    width?: string;
    sx?: SxProps<Theme>;
}
