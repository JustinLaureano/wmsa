import { TextField, TextFieldProps } from '@mui/material';
import { SxProps, Theme } from '@mui/material/styles';

interface TextInputProps extends Omit<TextFieldProps, 'onChange'> {
    label: string;
    value: string;
    onChange: (value: string) => void;
    required?: boolean;
    size?: TextFieldProps['size'];
    width?: string;
    sx?: SxProps<Theme>;
}

export default function TextInput({ 
    label, 
    value, 
    onChange,
    required = false,
    size = 'small',
    width = '400px',
    sx,
    ...rest
}: TextInputProps) {
    return (
        <TextField
            variant="outlined"
            label={label}
            value={value}
            onChange={(e) => onChange(e.target.value)}
            size={size}
            required={required}
            sx={{
                width: width,
                '& .MuiOutlinedInput-input': {
                    '&:focus': {
                        boxShadow: 'none',
                        borderColor: 'transparent',
                        outline: 'none',
                    },
                },
                ...sx
            }}
            {...rest}
        />
    );
} 