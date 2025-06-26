import { UserProfileProps } from "@/types";
import { useLanguage } from "@/Providers/LanguageProvider";
import SidebarLayout from "@/Layouts/SidebarLayout";
import UserProfileCard from "@/Domains/Auth/Cards/UserProfile/UserProfileCard";

export default function UserProfile({ user }: UserProfileProps) {
    const { lang } = useLanguage();

    return (
        <SidebarLayout title={lang.user_profile}>
            <UserProfileCard user={user} />
        </SidebarLayout>
    );
}
