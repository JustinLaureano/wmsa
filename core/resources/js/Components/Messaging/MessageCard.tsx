import { MessageResource } from '@/types/messaging';
import { Box, Card, Paper, useTheme } from '@mui/material';
import { blue, blueGrey, grey, indigo, lightBlue } from '@mui/material/colors';
import { useMemo } from 'react';
import { inflate } from 'zlib';

interface MessageCardProps {
    justify: string;
    message: MessageResource;
}

export default function MessageCard({ justify, message,...props }: MessageCardProps) {
    const theme = useTheme();

    let backgroundColor = theme.palette.background.default;

    if ( theme.palette.mode == 'light' ) {
        backgroundColor = justify == 'left'
            ? lightBlue[50]
            : indigo[50];
    }
    else {
        backgroundColor = justify == 'left'
            ? lightBlue[800]
            : indigo[500];
    }

    return (
        <Paper
            elevation={0}
            sx={{
                px: 2,
                py: 1.5,
                borderRadius: 2,
                boxShadow: 'none',
                background: backgroundColor,
                ...(
                    theme.palette.mode == 'light' && {
                        background: backgroundColor,
                    }
                )
            }}
        >
            {message.computed.filtered_content}
        </Paper>
    );
}
