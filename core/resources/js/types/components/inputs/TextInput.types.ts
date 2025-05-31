import { TextFieldProps } from '@mui/material';
import { SxProps, Theme } from '@mui/material/styles';

export interface TextInputProps extends Omit<TextFieldProps, 'onChange'> {
    label: string;
    value: string | number;
    onChange: (value: string) => void;
    required?: boolean;
    size?: TextFieldProps['size'];
    width?: string;
    sx?: SxProps<Theme>;
}