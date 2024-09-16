import React from 'react';
import { Box, Toolbar, useMediaQuery, useTheme } from '@mui/material';
import NavigationDrawer from '@/Components/Navigation/NavigationDrawer';
import TopAppBar from '@/Components/AppBars/TopAppBar';
import BottomNavigationBar from '@/Components/Navigation/BottomNavigationBar';
import BottomAppBar from '@/Components/AppBars/BottomAppBar';
import { Head } from '@inertiajs/react';

interface DashboardLayoutProps {
    title: string;
    children: React.ReactNode;
}

export default function DashboardLayout({ title, children, ...props } : DashboardLayoutProps) {
    const theme = useTheme();

    return (
        <Box sx={{
            display: 'flex',
            height: '100vh',
        }}>

            <Head title={title} />

            <TopAppBar title={title} />

            <NavigationDrawer />

            <Box
                component="main"
                sx={{ flexGrow: 1, px: 2, pt: 2 }}
            >
                {/* This toolbar is just a spacer */}
                <Toolbar variant="dense" />
                {children}
            </Box>

            <BottomNavigationBar />

            <BottomAppBar />
        </Box>
    );
}