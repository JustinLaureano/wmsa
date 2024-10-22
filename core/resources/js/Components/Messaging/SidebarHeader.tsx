import { Stack, Typography, useTheme } from '@mui/material';

interface SidebarHeaderProps {

}

export default function SidebarHeader({ ...props }: SidebarHeaderProps ) {
    const theme = useTheme();

    return (
        <Stack
            direction="row"
            alignItems="center"
        >
            <Typography variant="h6">Messaging</Typography>
        </Stack>
    );
}
