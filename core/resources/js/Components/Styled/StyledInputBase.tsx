import { InputBase } from '@mui/material';

export default function StyledInputBase({ ...props }) {
    return (
        <InputBase
            sx={{
                ml: 1,
                '.MuiInputBase-input:focus': {
                    boxShadow: 'none'
                }
            }}
            {...props}
        />
    )
}
