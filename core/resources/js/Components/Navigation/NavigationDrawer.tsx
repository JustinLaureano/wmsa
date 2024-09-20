import React, { useContext, useEffect } from 'react';
import { router } from '@inertiajs/react';
import {
	Box, Drawer, ListItem, ListItemButton,
	ListItemIcon, ListItemText, Tooltip, Typography, useMediaQuery, useTheme
} from '@mui/material';
import { Home, Factory, Inventory, LocalShipping, PrecisionManufacturing, Verified, Warehouse, AssignmentTurnedIn } from '@mui/icons-material';
import UIContext from '@/Contexts/UIContext';
import dimensions from '@/Theme/dimensions';
import StyledNavList from '@/Components/Styled/StyledNavList';

export default function NavigationDrawer(props: Record<string, any>) {
	const theme = useTheme();
	const isDesktop = useMediaQuery(theme.breakpoints.up('md'));
	const { navigationDrawerOpen, setNavigationDrawerOpen } = useContext(UIContext);

	const drawerWidth = navigationDrawerOpen
		? theme.layouts.dashboard.drawerWidth
		: theme.layouts.dashboard.drawerRailWidth;

	const links = [
		{ label: 'Home', icon: <Home />, route: route('home') },
		{ label: 'Production', icon: <PrecisionManufacturing />, route: route('production.requests') },
		{ label: 'IRM', icon: <Factory />, route: route('irm.chemicals.inventory') },
		{ label: 'Receiving', icon: <AssignmentTurnedIn />, route: route('receiving.documents') },
		{ label: 'Shipping', icon: <LocalShipping />, route: route('shipping.requests') },
		{ label: 'Quality', icon: <Verified />, route: route('quality.sort') },
		{ label: 'Materials', icon: <Inventory />, route: route('materials.inventory') },
		{ label: 'Locations', icon: <Warehouse />, route: route('home') },
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
		>

			<Box sx={{ overflow: 'scroll', '::-webkit-scrollbar': { display: 'none' } }}>
				<StyledNavList component="nav">
					{links.map((link, index) => (
						<ListItemWrapper link={link} key={index}>
							<ListItem disablePadding >
								<ListItemButton onClick={() => router.get(link.route)}>
									<ListItemIcon>
										{link.icon}
									</ListItemIcon>
									<ListItemText
										primary={
											<React.Fragment>
											  	<Typography
													component="span"
													variant="body2"
											  	>
													{link.label}
											  	</Typography>

											</React.Fragment>
										}
									/>
								</ListItemButton>
							</ListItem>
						</ListItemWrapper>
					))}
				</StyledNavList>

			</Box>
		</Drawer>
	);
}
