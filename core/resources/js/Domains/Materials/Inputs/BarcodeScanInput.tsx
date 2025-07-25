import { useState } from 'react';
import {
    Paper,
    Stack,
    Divider,
    IconButton,
    Typography
} from '@mui/material';
import { Send } from '@mui/icons-material';
import StyledInputBase from '@/Components/Styled/StyledInputBase';
import { BarcodeScanInputProps } from '@/types';
import { blue } from '@mui/material/colors';
import { useLanguage } from '@/Providers/LanguageProvider';

export default function BarcodeScanInput({
    onChange,
    onKeyDown,
    onButtonClick,
    inputRef,
    value,
    placeholder = null,
    sx,
    ...rest
}: BarcodeScanInputProps) {
    const { lang } = useLanguage();

    const [isFocused, setIsFocused] = useState(false);

    return (

        <Stack>
            <Typography variant="subtitle2">
                {lang.scan_a_barcode_label}
            </Typography>
            <Paper
                elevation={0}
                variant="outlined"
                sx={{
                    minWidth: '300px',
                    boxShadow: 'none',
                    ...sx
                }}
            >
                <Stack
                    direction="row"
                    alignItems="center"
                >

                    <StyledInputBase
                        inputRef={inputRef}
                        placeholder={placeholder || `${lang.barcode_label}...`}
                        value={value}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => onChange(e.target.value)}
                        onKeyDown={onKeyDown}
                        onFocus={() => setIsFocused(true)}
                        onBlur={() => setIsFocused(false)}
                        sx={{
                            flexGrow: 1,
                            ml: 1,
                            '& .MuiInputBase-input': {
                                '&:focus': {
                                    outline: `2px solid ${blue[500]}`,
                                    outlineOffset: '3px',
                                    borderRadius: '4px 0px 0px 4px',
                                }
                            }
                        }}
                        {...rest}
                    />

                    {!isFocused && (
                        <Divider
                            orientation="vertical"
                                flexItem
                                sx={{ mr: 1 }}
                        />
                    )}

                    <IconButton
                        color="primary"
                        onClick={onButtonClick}
                        sx={{
                            ...(isFocused && {
                                ml: 1,
                                borderRight: `2px solid ${blue[500]}`,
                                borderTop: `2px solid ${blue[500]}`,
                                borderBottom: `2px solid ${blue[500]}`,
                                borderLeft: `2px solid ${blue[500]}`,
                                borderRadius: '0px 4px 4px 0px',
                            })
                        }}
                    >
                        <Send />
                    </IconButton>
                </Stack>
            </Paper>
        </Stack>
    );
}
