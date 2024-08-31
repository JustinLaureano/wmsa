import React from 'react';
import { Link } from '@inertiajs/react';
import { useTheme } from '@mui/material/styles';
import Paper from '@mui/material/Paper';
import BottomNavigation from '@mui/material/BottomNavigation';
import BottomNavigationAction from '@mui/material/BottomNavigationAction';

import DashboardIcon from '@mui/icons-material/Dashboard';
import DashboardOutlinedIcon from '@mui/icons-material/DashboardOutlined';

export default function BottomNavigationBar(props: Record<string, any>) {
    const theme = useTheme();

    let value = 0;

    if (window.location.pathname.includes('dashboard')) {
        value = 0;
    }

    return (
        <Paper
            sx={(theme) => ({
                display: 'block',
                position: 'fixed',
                bottom: 0,
                left: 0,
                right: 0,
                [theme.breakpoints.up('md')]: {
                    display: 'none'
                }
            })}
            elevation={3}
        >
            <BottomNavigation
                showLabels
                value={value}
            >
                <BottomNavigationAction
                    component={Link}
                    href={route('home')}
                    label="Home"
                    icon={
                        value == 0 
                            ? <DashboardIcon/>
                            : <DashboardOutlinedIcon />
                    }
                />

            </BottomNavigation>
        </Paper>
    );
}
