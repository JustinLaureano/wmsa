import { useContext } from "react";
import {
    Card,
    CardContent,
    Grid,
} from "@mui/material";
import { UserProfileCardProps } from "@/types";
import LanguageContext from "@/Contexts/LanguageContext";
import { 
    PersonOutlineOutlined,
    Settings,
    WorkOutline,
} from "@mui/icons-material";
import UserProfileCardHeader from "./UserProfileCardHeader";
import UserListItem from "./UserListItem";
import UserInfoCard from "./UserInfoCard";
import SystemListItem from "./SystemListItem";

export default function UserProfileCard({ user }: UserProfileCardProps) {
    const { lang } = useContext(LanguageContext);

    const {
        clock_number,
        department,
        description,
        display_name,
        email,
        first_name,
        hire_date,
        last_name,
        title,
        user_uuid,
        domain_account_guid
    } = user.computed;

    const handleCopyToClipboard = (text: string) => {
        navigator.clipboard.writeText(text);
    }

    return (
        <Card
            sx={{
                maxWidth: 'lg',
                mx: 'auto',
            }}
            elevation={2}
        >
            <UserProfileCardHeader />

            <CardContent>
                <Grid container spacing={2}>
                    <Grid size={{ xs: 12, md: 6 }}>
                        <UserInfoCard
                            icon={<PersonOutlineOutlined color="primary" />}
                            title={lang.personal_information}
                        >
                            <UserListItem
                                label={lang.first_name}
                                value={first_name}
                            />

                            <UserListItem
                                label={lang.last_name}
                                value={last_name}
                            />

                            <UserListItem
                                label={lang.display_name}
                                value={display_name}
                            />

                            <UserListItem
                                label={lang.hire_date}
                                value={hire_date}
                            />
                        </UserInfoCard>
                    </Grid>

                    <Grid size={{ xs: 12, md: 6 }}>
                        <UserInfoCard
                            icon={<WorkOutline color="primary" />}
                            title={lang.work_information}
                        >
                            <UserListItem
                                label={lang.clock_number}
                                value={clock_number}
                            />

                            <UserListItem
                                label={lang.job_title}
                                value={title}
                            />

                            <UserListItem
                                label={lang.department}
                                value={department}
                            />

                            <UserListItem
                                label={lang.description}
                                value={description}
                            />

                            <UserListItem
                                label={lang.email}
                                value={email}
                            />
                        </UserInfoCard>
                    </Grid>

                    <Grid size={12}>
                        <UserInfoCard
                            icon={<Settings color="primary" />}
                            title={lang.system_information}
                        >
                            <Grid container spacing={2}>
                                <Grid
                                    size={{
                                        xs: 12,
                                        md: 6,
                                    }}
                                >
                                    <SystemListItem
                                        label={lang.user_uuid}
                                        text={user_uuid}
                                        onCopyClick={handleCopyToClipboard}
                                    />
                                </Grid>

                                <Grid
                                    size={{
                                        xs: 12,
                                        md: 6,
                                    }}
                                >
                                    <SystemListItem
                                        label={lang.domain_account_guid}
                                        text={domain_account_guid}
                                        onCopyClick={handleCopyToClipboard}
                                    />
                                </Grid>
                            </Grid>
                        </UserInfoCard>
                    </Grid>
                </Grid>
            </CardContent>
        </Card>
    )
}
