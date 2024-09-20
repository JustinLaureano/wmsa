import React, { useContext, useEffect } from 'react';
import {
    Drawer,
    useMediaQuery,
    useTheme
} from '@mui/material';
import UIContext from '@/Contexts/UIContext';
import dimensions from '@/Theme/dimensions';

interface StyledNavDrawerProps {
    children: React.ReactNode;
}

export default function StyledNavDrawer({ children, ...props } : StyledNavDrawerProps) {
	const theme = useTheme();
	const isDesktop = useMediaQuery(theme.breakpoints.up('md'));
	const { navigationDrawerOpen, setNavigationDrawerOpen } = useContext(UIContext);

	const drawerWidth = navigationDrawerOpen
		? theme.layouts.dashboard.drawerWidth
		: theme.layouts.dashboard.drawerRailWidth;

	const handleDrawerToggle = (e: React.MouseEvent<HTMLElement>) => {
		if (isDesktop) return;

		setNavigationDrawerOpen(false);
	}

	useEffect(() => {
		if (!isDesktop && navigationDrawerOpen) {
			setNavigationDrawerOpen(false);
		}
	}, [isDesktop])

    return (
		<Drawer
			variant={isDesktop ? 'permanent' : 'temporary'}
			open={navigationDrawerOpen}
			onClose={handleDrawerToggle}
			elevation={0}
			sx={{
				width: `calc(${drawerWidth} + ${theme.spacing(2)})`,
				flexShrink: 0,
				transition: theme.transitions.create('width', {
					easing: theme.transitions.easing.easeOut,
					duration: theme.transitions.duration.standard,
				}),
				[`& .MuiDrawer-paper`]: {
					backgroundImage: 'linear-gradient(rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.05))',
					borderRadius: 4,
					height: `calc(100vh - ${dimensions.topAppBarHeight} - ${dimensions.bottomAppBarHeight} - ${theme.spacing(2)})`,
					marginLeft: theme.spacing(2),
					marginTop: `calc(${dimensions.topAppBarHeight} + ${theme.spacing(1)})`,
					borderRight: 'none',
					boxSizing: 'border-box',
					width: drawerWidth,
					transition: theme.transitions.create('width', {
						easing: theme.transitions.easing.easeOut,
						duration: theme.transitions.duration.standard,
					})
				},
			}}
            {...props}
		>
            {children}
		</Drawer>
    )
}
