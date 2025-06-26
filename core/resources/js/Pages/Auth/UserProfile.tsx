import { useContext } from "react";
import { UserProfileProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";
import SidebarLayout from "@/Layouts/SidebarLayout";
import UserProfileCard from "@/Domains/Auth/Cards/UserProfile/UserProfileCard";

export default function UserProfile({ user }: UserProfileProps) {
    const { lang } = useContext(LanguageContext);

    return (
        <SidebarLayout title={lang.user_profile}>
            <UserProfileCard user={user} />
        </SidebarLayout>
    );
}
