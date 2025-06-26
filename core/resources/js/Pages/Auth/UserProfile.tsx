import { useContext } from "react";
import { UserProfileProps } from "@/types";
import SidebarLayout from "@/Layouts/SidebarLayout";
import LanguageContext from "@/Contexts/LanguageContext";

export default function UserProfile({ user }: UserProfileProps) {
    const { lang } = useContext(LanguageContext);
    
    console.log(user);

    return (
        <SidebarLayout title={lang.user_profile}>
            <div>
                <h1>User Profile</h1>
            </div>
        </SidebarLayout>
    );
}