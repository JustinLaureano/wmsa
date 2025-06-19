import { ChangeEvent } from "react";

export interface SearchInputProps {
    label?: string;
    value: string;
    onChange: (e: ChangeEvent<HTMLInputElement>) => void;
    placeholder?: string;
}