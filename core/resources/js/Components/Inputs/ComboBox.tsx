import { Autocomplete, Box, TextField } from '@mui/material';
import { SxProps, Theme } from '@mui/material/styles';

interface Option {
    uuid?: string;
    label: string;
    value?: string;
}

interface ComboBoxProps {
    options: Option[];
    inputLabel: string;
    onChange?: (value: Option | null) => void;
    onInputChange?: (value: string) => void;
    value?: Option | null;
    sx?: SxProps<Theme>;
}

export default function ComboBox({ 
    options,
    inputLabel,
    onChange,
    onInputChange,
    value,
    sx 
}: ComboBoxProps) {
    return (
        <Autocomplete
            options={options}
            value={value}
            onChange={(_, newValue) => {
                if (onChange) onChange(newValue);
            }}
            onInputChange={(_, newInputValue) => {
                if (onInputChange) onInputChange(newInputValue);
            }}
            getOptionLabel={(option) => option.label}
            renderOption={(props, option) => {
                const { key, ...optionProps } = props;
                return (
                    <Box
                        key={key}
                        component="li"
                        {...optionProps}
                    >
                        {option.label}
                    </Box>
                );
            }}
            renderInput={(params) => (
                <TextField
                    {...params}
                    label={inputLabel}
                    autoComplete='off'
                    size="small"
                    sx={{
                        width: '440px',
                        '& .MuiOutlinedInput-root': {
                            '&:focus': {
                                borderColor: 'transparent',
                                outline: 'none',
                            },
                        },
                        ...sx
                    }}
                />
            )}
        />
    );
}