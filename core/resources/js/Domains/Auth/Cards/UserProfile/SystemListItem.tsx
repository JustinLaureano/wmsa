import { useContext } from "react";
import {
    Alert,
    IconButton,
    Tooltip,
    Typography,
} from "@mui/material";
import { SystemListItemProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";
import { 
    ContentCopy,
} from "@mui/icons-material";

export default function SystemListItem({ label, text, onCopyClick }: SystemListItemProps) {
    const { lang } = useContext(LanguageContext);

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