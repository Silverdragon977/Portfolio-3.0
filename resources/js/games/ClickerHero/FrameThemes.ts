// frameThemes.ts

export type FrameTheme = {
  '--frame-border': string
  '--frame-shadow': string
};

export const FRAME_THEMES: Record<string, FrameTheme> = {
  default: {
    '--frame-border': '2px solid #444',
    '--frame-shadow': 'none'
  },

  common: {
    '--frame-border': '4px solid gold',
    '--frame-shadow': '0 0 15px gold'
  },

  neon: {
    '--frame-border': '3px solid #00ffff',
    '--frame-shadow': '0 0 20px #00ffff'
  }
};