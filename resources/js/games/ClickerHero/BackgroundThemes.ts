


export type BackgroundTheme = Record<
  '--bg-primary' | '--bg-secondary' | '--text-primary' | '--accent',
  string
>;




export const BACKGROUND_THEMES: Record<string, BackgroundTheme> = {
  default: {
    '--bg-primary': '#1e1e1e',
    '--bg-secondary': '#2a2a2a',
    '--text-primary': '#ffffff',
    '--accent': '#4caf50'
  },
  crimson: {
    '--bg-primary': '#2b0000',
    '--bg-secondary': '#3a0000',
    '--text-primary': '#ffe5e5',
    '--accent': '#ff4d4d'
  },
  common: {
    '--bg-primary': '#001f2f',
    '--bg-secondary': '#00334d',
    '--text-primary': '#e0f7ff',
    '--accent': '#00bcd4'
  },
  gold: {
    '--bg-primary': '#2b2400',
    '--bg-secondary': '#3d3300',
    '--text-primary': '#fff6cc',
    '--accent': '#ffcc00'
  }
} as const;

export type BackgroundThemeKey = keyof typeof BACKGROUND_THEMES;