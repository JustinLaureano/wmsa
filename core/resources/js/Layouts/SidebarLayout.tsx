import React from 'react';
import { Head } from '@inertiajs/react';
import { Box, Toolbar, useMediaQuery, useTheme } from '@mui/material';
import { SidebarLayoutProps } from '@/types';
import NavigationDrawer from '@/Components/Navigation/NavigationDrawer';
import TopAppBar from '@/Components/AppBars/TopAppBar';
import BottomNavigationBar from '@/Components/Navigation/BottomNavigationBar';
import BottomAppBar from '@/Components/AppBars/BottomAppBar';

export default function SidebarLayout({ title, children, ...props } : SidebarLayoutProps) {
    const theme = useTheme();

    return (
        <Box sx={{
            display: 'flex',
            minHeight: '99vh',
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