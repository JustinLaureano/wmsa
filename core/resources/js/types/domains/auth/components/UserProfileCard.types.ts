import { ReactNode } from "react";
import { UserDetailResource } from "@/types";

export type UserProfileCardProps = {
    user: UserDetailResource;
}

export type UserInfoCardProps = {
    icon: ReactNode;
    title: string;
    children: ReactNode;
}


export type UserListItemProps = {
    label: string;
    value: string;
}

export type SystemListItemProps = {
    label: string;
    text: string;
    onCopyClick: (text: string) => void;
}
