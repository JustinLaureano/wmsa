import { TextField } from '@mui/material';
import { TextInputProps } from '@/types';

export default function TextInput({ 
    label, 
    value, 
    onChange,
    required = false,
    size = 'small',
    width = '100%',
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