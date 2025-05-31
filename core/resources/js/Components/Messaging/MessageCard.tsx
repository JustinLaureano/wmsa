import { MessageCardProps } from '@/types';
import { Paper, useTheme } from '@mui/material';
import { indigo, lightBlue } from '@mui/material/colors';

export default function MessageCard({ justify, message,...props }: MessageCardProps) {
    const theme = useTheme();

    if ( !message.computed ) return null;

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
