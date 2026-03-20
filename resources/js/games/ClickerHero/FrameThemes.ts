// frameThemes.ts

export type FrameTheme = Record<
  '--frame-border' | '--frame-shadow', 
  string
>;

export const FRAME_THEMES: Record<string, FrameTheme> = {
  default: {
    '--frame-border': '0px solid #444',
    '--frame-shadow': 'none'
  },

  common: {
    '--frame-border': '10px solid gold',
    '--frame-shadow': '0 0 15px gold'
  },

  neon: {
    '--frame-border': '10px solid #00ffff',
    '--frame-shadow': '0 0 60px #00ffff'
  }
} as const;

export type FrameThemeKey = keyof typeof FRAME_THEMES