


export type BackgroundTheme = Record<
  '--bg-primary' | '--bg-secondary' | '--text-primary' | '--accent',
  string
>;




export const BACKGROUND_THEMES: Record<string, BackgroundTheme> = {
  default: {
    '--bg-primary': '#271b1b',  // background color
    '--bg-secondary': '#2f582f', // contrasts background
    '--text-primary': '#ffffff', // readable behind background
    '--accent': '#3a2ac9'       
  },
  softSlate: {
  '--bg-primary': '#1f2329',
  '--bg-secondary': '#2a2f36',
  '--text-primary': '#d6dde6',
  '--accent': '#4f8cff'
},
  warmCharcoal: {
  '--bg-primary': '#262220',
  '--bg-secondary': '#332d2a',
  '--text-primary': '#e6dcd3',
  '--accent': '#c48a5a'
},
  coolFog: {
  '--bg-primary': '#e7eaee',
  '--bg-secondary': '#d4d9df',
  '--text-primary': '#2f3540',
  '--accent': '#5a7bd8'
},


common: {
    '--bg-primary': '#001f2f',
    '--bg-secondary': '#00334d',
    '--text-primary': '#e0f7ff',
    '--accent': '#00bcd4'
},
  crimson: {
    '--bg-primary': '#2b0000',
    '--bg-secondary': '#3a0000',
    '--text-primary': '#ffe5e5',
    '--accent': '#ff4d4d'
},

  gold: {
    '--bg-primary': '#2b2400',
    '--bg-secondary': '#3d3300',
    '--text-primary': '#fff6cc',
    '--accent': '#ffcc00'
},


  oceanTeal: {
  '--bg-primary': '#0f2f36',
  '--bg-secondary': '#15424c',
  '--text-primary': '#d9f2f5',
  '--accent': '#2dd4bf'
},
  forestNight: {
  '--bg-primary': '#1a2e22',
  '--bg-secondary': '#243f2e',
  '--text-primary': '#e4f3e7',
  '--accent': '#6fcf97'
},
  royalIndigo: {
  '--bg-primary': '#1c1f3a',
  '--bg-secondary': '#2a2e57',
  '--text-primary': '#e4e7ff',
  '--accent': '#7c5cff'
},
  auroraBorealis: {
  '--bg-primary': 'linear-gradient(135deg, #455c75, #2b366b)',
  '--bg-secondary': 'rgba(255,255,255,0.05)',
  '--text-primary': '#eaf6ff',
  '--accent': '#4fd1c5'
},
  sunsetEmber: {
  '--bg-primary': 'linear-gradient(135deg, #2b0f0f, #402020)',
  '--bg-secondary': 'rgba(255,180,120,0.08)',
  '--text-primary': '#ffe7d1',
  '--accent': '#ff7a45'
}, 
  cosmicAmethyst: {
  '--bg-primary': 'linear-gradient(135deg, #1a0f2e, #2e1f4d)',
  '--bg-secondary': 'rgba(140, 100, 255, 0.08)',
  '--text-primary': '#f0eaff',
  '--accent': '#a78bfa'
},


celestialDrift: {
  '--bg-primary': `
    linear-gradient(
      135deg,
      #0f2027 0%,
      #203a43 35%,
      #2c5364 70%,
      #1a2a33 100%
    )
  `,
  '--bg-secondary': `
    linear-gradient(
      135deg,
      #162d3b 0%,
      #1f3f50 100%
    )
  `,
  '--text-primary': '#f1fbff',
  '--accent': '#38d9ff'
},
crimsonMonarch: {
  '--bg-primary': `
    linear-gradient(
      140deg,
      #1a0000 0%,
      #3a0d0d 35%,
      #5c1a1a 65%,
      #7a2e1f 100%
    )
  `,
  '--bg-secondary': `
    linear-gradient(
      135deg,
      #2a0a0a 0%,
      #4a1a1a 100%
    )
  `,
  '--text-primary': '#fff4f0',
  '--accent': '#ff784f'
},
arcaneViolet: {
  '--bg-primary': `
    linear-gradient(
      135deg,
      #14001f 0%,
      #2a0845 40%,
      #3a0ca3 75%,
      #560bad 100%
    )
  `,
  '--bg-secondary': `
    linear-gradient(
      135deg,
      #1e0030 0%,
      #3c096c 100%
    )
  `,
  '--text-primary': '#f5ecff',
  '--accent': '#c77dff'
}



} as const;

export type BackgroundThemeKey = keyof typeof BACKGROUND_THEMES;