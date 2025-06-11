import '@mui/material/styles';
import '@mui/material';

declare module '@mui/material' {
    interface Theme {
        layouts?: any;
    }

    interface ThemeOptions {
        layouts?: any;
    }
}

declare module '@mui/material/styles' {
    interface Palette {
        primaryText: Palette['primary'];
        secondaryText: Palette['primary'];
    }
  
    interface PaletteOptions {
        primaryText?: PaletteOptions['primary'];
        secondaryText?: PaletteOptions['primary'];
        danger?: PaletteOptions['primary'];
    }
}

declare module '@mui/material/Button' {
    interface ButtonPropsColorOverrides {
        primaryText: true;
        secondaryText: true;
    }

}

declare module '@mui/material/IconButton' {
    interface IconButtonPropsColorOverrides {
        primaryText: true;
        secondaryText: true;
        danger: true;
    }
}

declare module '@mui/material/SvgIcon' {
    interface SvgIconPropsColorOverrides {
        primaryText: true;
        secondaryText: true;
    }
}
