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
    WorkOutline,
} from "@mui/icons-material";
import UserProfileCardHeader from "./UserProfileCardHeader";
import UserListItem from "./UserListItem";
import UserInfoCard from "./UserInfoCard";

export default function UserProfileCard({ user }: UserProfileCardProps) {
    const { lang } = useContext(LanguageContext);

    console.log(user)
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
    } = user.computed;

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
                            icon={<PersonOutlineOutlined />}
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
                            icon={<WorkOutline />}
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
                </Grid>
            </CardContent>
        </Card>
    )
}