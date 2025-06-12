import StyledInputBase from "@/Components/Styled/StyledInputBase";
import { Done } from "@mui/icons-material";
import { Box, Divider, IconButton, Paper, Stack } from "@mui/material";
import { QuantityUpdateInputProps } from "@/types";

export default function QuantityUpdateInput({
    quantity,
    onHandleQuantityChange,
    onSaveQuantityChange,
    container
} : QuantityUpdateInputProps) {

    const iconColor = container?.quantity_updated
        ? 'success'
        : container?.quantity_edited
            ? 'danger'
            : 'default';

    return (
        <Paper
            elevation={0}
            variant="outlined"
            sx={{
                p: '3px 8px',
                width: '90%',
                maxWidth: '120px',
                boxShadow: 'none'
            }}
        >
            <Stack
                direction="row"
                alignItems="center"
            >
                <StyledInputBase
                    type="number"
                    value={quantity}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) => {
                        onHandleQuantityChange(e, container);
                    }}
                />
                <Divider
                    orientation="vertical"
                    flexItem
                />
                <Box>
                    <IconButton
                        color={iconColor}
                        disabled={!container.quantity_edited}
                        onClick={() => {
                            onSaveQuantityChange(container);
                        }}
                    >
                        <Done fontSize="small" />
                    </IconButton>
                </Box>
            </Stack>
        </Paper>
    )
}