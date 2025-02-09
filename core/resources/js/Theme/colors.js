import { deepOrange, green, purple, teal, amber, pink, cyan } from '@mui/material/colors';

export const blue = {
    50: "#e3f2ff",
    100: "#bbdeff",
    200: "#8dcaff",
    300: "#5cb5ff",
    400: "#34a4ff",
    500: "#0095ff",
    600: "#1386fc",
    700: "#1a73e8",
    800: "#1d61d5",
    900: "#1f41b6",
    gradient: "linear-gradient(195deg, rgb(73, 163, 241), rgb(26, 115, 232))"
};


export const avatarBadgeColors = [
  deepOrange[500],
  blue[600],
  green[500],
  purple[500],
  teal[600],
  amber[500],
  pink[500],
  cyan[600],
];

export const lightMode = {
  background: 'rgb(251, 251, 251)',
  textPrimary: 'rgb(38, 38, 38)',
  textSecondary: 'rgb(140, 140, 140)',
};

export const darkMode = {
  textPrimary: 'rgba(255, 255, 255, 0.87)',
  textSecondary: 'rgba(255, 255, 255, 0.75)',
  background: 'rgb(18, 18, 18)',
  backgroundPaper: 'rgb(30, 30, 30)',
  backgroundPaperHover: 'rgba(255, 255, 255, .08)',
};

export const getRandomAvatarBadgeColor = () => {
    const randomIndex = Math.floor(Math.random() * avatarBadgeColors.length);

    return avatarBadgeColors[randomIndex];
};