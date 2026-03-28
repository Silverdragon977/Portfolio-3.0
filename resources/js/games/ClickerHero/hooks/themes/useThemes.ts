import { useState, useEffect, useRef } from "react";
import { BACKGROUND_THEMES, BackgroundThemeKey } from "./BackgroundThemes";
import { FRAME_THEMES, FrameThemeKey } from "./FrameThemes";
console.log("useThemes.ts Hook loaded");

export const useThemes = () => {

    // Adding UI Themes
    const [backgroundColor, setBackgroundColor] = useState<BackgroundThemeKey>('default');  
    const [frameChoice, setFrameChoice] = useState<FrameThemeKey>('default');

    useEffect(() => {
        // Sets Background Theme based on user selection
        const theme = BACKGROUND_THEMES[backgroundColor] || BACKGROUND_THEMES.default;
        
        Object.entries(theme).forEach(([key, value]) => {
            document.documentElement.style.setProperty(key, value);
        });
    }, [backgroundColor]);    
    useEffect(() => {
        const theme = FRAME_THEMES[frameChoice] || FRAME_THEMES.default;    
        Object.entries(theme).forEach(([key, value]) => {
          document.documentElement.style.setProperty(key, value);
        });
    }, [frameChoice]);

    return {
      backgroundColor,
      frameChoice,
        setBackgroundColor,
        setFrameChoice,
    };
};  