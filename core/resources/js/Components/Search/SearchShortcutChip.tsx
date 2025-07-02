import { KeyboardOptionKey } from "@mui/icons-material";
import { Box, Stack, useTheme } from "@mui/material";
import { grey } from "@mui/material/colors";

export default function SearchShortcutChip() {
    const theme = useTheme();

    return (
        <Stack sx={{ ml: 6 }}>
            <Box
                component="span"
                sx={{
                    background: grey[200],
                    padding: '1px 8px',
                    marginLeft: theme.spacing(2),
                    borderRadius: 2,
                    fontSize: '.675rem',
                    ...(
                        theme.palette.mode == 'dark' && {
                            background: theme.palette.background.default,
                        }
                    )
                }}
            >
                <KeyboardOptionKey fontSize="small" /> + K
            </Box>
        </Stack>
    );
}