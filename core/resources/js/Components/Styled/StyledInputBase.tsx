import { InputBase } from '@mui/material';

export default function StyledInputBase({ ...props }) {
    const { sx, ...rest } = props;

    return (
        <InputBase
            sx={{
                ml: 1,
                '.MuiInputBase-input:focus': {
                    boxShadow: 'none'
                },
                ...sx
            }}
            {...rest}
        />
    )
}
