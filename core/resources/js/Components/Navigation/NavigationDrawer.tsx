import React, { useContext, useEffect } from 'react';
import {
	Box, Divider, Drawer, IconButton, List, ListItem, ListItemButton,
	ListItemIcon, ListItemText, Toolbar, Tooltip, useMediaQuery, useTheme
} from '@mui/material';
import { Brightness6, LightMode } from '@mui/icons-material';
import InboxIcon from '@mui/icons-material/MoveToInbox';
import ColorModeContext from '@/Contexts/ColorModeContext';
import UIContext from '@/Contexts/UIContext';

export default function NavigationDrawer(props: Record<string, any>) {
	const theme = useTheme();
	const isDesktop = useMediaQuery(theme.breakpoints.up('md'));
	const colorMode = useContext(ColorModeContext);
	const { navigationDrawerOpen, setNavigationDrawerOpen } = useContext(UIContext);

	const drawerWidth = navigationDrawerOpen
		? theme.layouts.dashboard.drawerWidth
		: theme.layouts.dashboard.drawerRailWidth;

	const links = [
		{ label: 'Home', icon: '', route: route('home') },
		{ label: 'Requests', icon: '', route: route('home') },
		{ label: 'Receiving', icon: '', route: route('home') },
		{ label: 'Shipping', icon: '', route: route('home') },
		{ label: 'IRM', icon: '', route: route('home') },
		{ label: 'Materials', icon: '', route: route('home') },
		{ label: 'Quality', icon: '', route: route('home') },
	];

	const handleDrawerToggle = (e: React.MouseEvent<HTMLElement>) => {
		if (isDesktop) return;

		setNavigationDrawerOpen(false);
	}


	useEffect(() => {
		if (!isDesktop && navigationDrawerOpen) {
			setNavigationDrawerOpen(false);
		}
	}, [isDesktop])

	const ListItemWrapper = ({ link, children } : any) => {
		if (navigationDrawerOpen) {
			return (
				<>{children}</>
			)
		}

		return (
			<Tooltip
				title={link.label}
				placement="right"
				arrow
			>
				{children}
			</Tooltip>
		)
	}

	return (
		<Drawer
			variant={isDesktop ? 'permanent' : 'temporary'}
			open={navigationDrawerOpen}
			onClose={handleDrawerToggle}
			elevation={0}
			sx={{
				width: drawerWidth,
				flexShrink: 0,
				transition: theme.transitions.create('width', {
					easing: theme.transitions.easing.easeOut,
					duration: theme.transitions.duration.standard,
				}),
				[`& .MuiDrawer-paper`]: {
					borderRight: 'none',
					boxSizing: 'border-box',
					width: drawerWidth,
					transition: theme.transitions.create('width', {
						easing: theme.transitions.easing.easeOut,
						duration: theme.transitions.duration.standard,
					})
				},
			}}
		>
			<Toolbar variant="dense" />

			<Box sx={{ overflow: 'hidden' }}>
				<List>
					{links.map((link, index) => (
						<ListItemWrapper link={link} key={index}>
							<ListItem disablePadding >
								<ListItemButton>
									<ListItemIcon>
										{index % 2 === 0 ? <InboxIcon /> : <Brightness6 />}
									</ListItemIcon>
									<ListItemText
										primary={link.label}
									/>
								</ListItemButton>
							</ListItem>
						</ListItemWrapper>
					))}
				</List>

				{/* <Divider /> */}

				<Box>
					<IconButton sx={{ ml: 1 }} onClick={colorMode.toggleColorMode}>
						{theme.palette.mode === 'dark' ? <Brightness6 /> : <LightMode />}
					</IconButton>
				</Box>

			</Box>
		</Drawer>
	);
}
