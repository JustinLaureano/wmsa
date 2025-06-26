import {
    Alert,
    IconButton,
    Tooltip,
    Typography,
} from "@mui/material";
import { SystemListItemProps } from "@/types";
import { useLanguage } from "@/Providers/LanguageProvider";
import { 
    ContentCopy,
} from "@mui/icons-material";

export default function SystemListItem({ label, text, onCopyClick }: SystemListItemProps) {
    const { lang } = useLanguage();

    return (
        <> 
            <Typography
                variant="body2"
                color="text.secondary"
                gutterBottom
            >
                {label}:
            </Typography>
            <Alert
                icon={false}
                severity="info"
                action={
                    <Tooltip title={lang.copy_to_clipboard} arrow>
                        <IconButton onClick={() => onCopyClick(text || '')}>
                            <ContentCopy />
                        </IconButton>
                    </Tooltip>
                }
            >
                <Typography variant="body2">
                    {text || lang.na}
                </Typography>
            </Alert>
        </>
    )
}