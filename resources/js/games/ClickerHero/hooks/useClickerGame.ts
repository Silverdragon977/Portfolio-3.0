import { useState, useEffect, useRef } from "react";
import { BACKGROUND_THEMES } from "../BackgroundThemes";
import { FRAME_THEMES } from "../FrameThemes";
console.log("useClickerGame.ts Hook loaded")


export function useClickerGame() {

  const MAX_SCORE = 999999999;
  const AUTOSAVE_INTERVAL = 30000;
  const MULTIPLIER_COSTS = [10, 30, 90, 270, 810, 2430, 7290, 21870, 65610, 131220, 262440, 524880, 1049760, 2099520, 4199040, 8398080, 12597120, 18895680, 28343520, 34012224, 40814669, 48977603, 58773124, 70527749, 84672000]; // Costs for each multiplier level (x2, x4, x8, etc.)
  const PASSIVE_INCOME_COSTS = [100, 250, 500, 750, 1000];

  const lastSavedData = useRef({
    score: 0,
    multiplier: 1,
    passiveIncomeLevel: 0,
    prestigeLevel: 0,
    backgroundColor: 'default',
    frameChoice: 'default'
  });

  const [score, setScore] = useState(0);
  const [multiplier, setMultiplier] = useState(1);
  const [passiveIncomeLevel, setPassiveIncomeLevel] = useState(0);
  const [prestigeLevel, setPrestigeLevel] = useState(0);
  const [bulkAmountPassiveIncome, setBulkAmountPassiveIncome] = useState(1);
  const [bulkAmountDoubleIncome, setBulkAmountDoubleIncome] = useState(1);

  // Adding UI Themes
  const [backgroundColor, setBackgroundColor] = useState<BackgroundThemeKey>('default');  
  const [frameChoice, setFrameChoice] = useState<FrameThemeKey>('default');


    useEffect(() => {
        // Loads the game data from load route when the component mounts
        loadGame();
    }, []);
    
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

    //// SaveGame Interval Logic ////
    // Auto-saves the game data every 30 seconds, but only if there have been changes since the last save
    useEffect(() => {
        const interval = setInterval(() => 
            {
                saveData();
            }, AUTOSAVE_INTERVAL);
        return () => clearInterval(interval);
    }, [score, multiplier, passiveIncomeLevel, prestigeLevel, backgroundColor, frameChoice]); 

    //// Passive Income Logic ////
    useEffect(() => {
        const passiveIncomeInterval = setInterval(() => {
            setScore(prevScore => {
                const newScore = prevScore + passiveIncomeLevel;
                return newScore <= MAX_SCORE ? newScore : prevScore;
            });
        }, 1000);

        return () => clearInterval(passiveIncomeInterval);
    }, [passiveIncomeLevel]);
 
    /////////////////////////////////////////////////
    // Button Click Game Logic                     //
    /////////////////////////////////////////////////
    const handleClick = () => {
        const newScore = score + multiplier; // multiplier from use state
        if (newScore <= (MAX_SCORE + 1)) {
            setScore(prevScore => prevScore + multiplier);
        }
        if (newScore > MAX_SCORE) {
            alert(`Congratulations! You've reached ${MAX_SCORE + 1} clicks!`);
            setScore(0); // Reset score after reaching MAX_SCORE
            setMultiplier(1); // Reset multiplier as well
        }
    }

    const saveData = async () => {
        // Check for no difference in game data since last save to prevent unnecessary saves
        if (score === lastSavedData.current.score && multiplier === lastSavedData.current.multiplier && passiveIncomeLevel === lastSavedData.current.passiveIncomeLevel && prestigeLevel === lastSavedData.current.prestigeLevel && backgroundColor === lastSavedData.current.backgroundColor && frameChoice === lastSavedData.current.frameChoice) {
            console.log('No changes since last save, skipping save.');
            return;
        }
        const saveJsonData = {
            score: score,
            multiplier: multiplier,
            passive_income_level: passiveIncomeLevel,
            prestige_level: prestigeLevel,
            background_color: backgroundColor,
            frame_choice: frameChoice
        };
        try {
            const response = await fetch('/clickerhero/save', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(saveJsonData)
            });
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }
            const result = await response.json();
            console.log('Save successful:');
            // console.log('Save successful:', result);
            lastSavedData.current = { score: score, multiplier: multiplier, passiveIncomeLevel: passiveIncomeLevel, prestigeLevel: prestigeLevel, backgroundColor: backgroundColor, frameChoice: frameChoice}; // Update the ref with the current data after successful save
        }
        catch (error) {
            console.error(`Error saving data: ${error}`);
        }
    }

    const loadGame = async () => {
        try {
            const response = await fetch('/clickerhero/load');
            if (!response.ok) {
                throw new Error(`Failed to load game data: ${response.status}`);
            }
            const data = await response.json();
            setScore(data.score ?? 0);
            setMultiplier(data.multiplier ?? 1);
            setPassiveIncomeLevel(data.passive_income_level ?? 0);
            setPrestigeLevel(data.prestige_level ?? 0);
            setBackgroundColor(data.background_color ?? 'default');
            setFrameChoice(data.frame_choice ?? 'default');
            lastSavedData.current = { 
                score: data.score,
                multiplier: data.multiplier, 
                passiveIncomeLevel: data.passive_income_level, 
                prestigeLevel: data.prestige_level, 
                backgroundColor: data.background_color,
                frameChoice: data.frame_choice
            }; // Update the ref with the loaded data
        } catch (error) {console.error("Error loading save:", error);}
    };

    const handleDoubleClick = () => {
        const currentLevel = Math.log2(multiplier);
        const remainingLevels = MULTIPLIER_COSTS.length - currentLevel;
        const actualBulk = Math.min(bulkAmountDoubleIncome, remainingLevels);
        const cost = getBulkMultiplierCost(currentLevel, actualBulk);
        if (score >= cost && actualBulk > 0) {
            setScore(prev => prev - cost);
            setMultiplier(prev => prev * Math.pow(2, actualBulk));
        }
    }
    function getBulkMultiplierCost(currentLevel: number,bulkAmount: number): number {
        let totalCost = 0;
        for (let i = 0; i < bulkAmount; i++) {
            const nextLevel = currentLevel + i;
            if (nextLevel >= MULTIPLIER_COSTS.length) break;
            totalCost += MULTIPLIER_COSTS[nextLevel];
        }
        return totalCost;}


    function getPassiveIncomeCost(level: number): number {
        // This gets called by getBulkPassiveIncomeCost and the passive income per second
    let value = 10;
    for (let i = 0; i < level; i++) {
        let multiplier;
        if (i < 5) 
            {multiplier = 3} 
        else if (i < 15) 
            {multiplier = 2.5;} 
        else if (i < 25) 
            {multiplier = 2.0;} 
        else if (i < 35) 
            {multiplier = 1.5;} 
        else if (i < 45) 
            {multiplier = 1.4;} 
        else {multiplier = 1.2;}
        value *= multiplier;
    }
        return Math.floor(value);
    }
    function getBulkPassiveCost(
        currentLevel: number,
        bulkAmount: number
    ): number {

        let totalCost = 0;

        for (let i = 0; i < bulkAmount; i++) {
            totalCost += getPassiveIncomeCost(currentLevel + i);
        }
        return totalCost;
    }
    const handlePassivePurchase = () => {
        console.log("Current Level: ", passiveIncomeLevel);
        console.log("Bulk: ", bulkAmountPassiveIncome);
        if (passiveIncomeLevel >= 256) return;
        const remainingLevels = 256 - passiveIncomeLevel;
        const actualBulk = Math.min(bulkAmountPassiveIncome, remainingLevels);
        const cost = getBulkPassiveCost(passiveIncomeLevel, actualBulk);
        console.log("Cost for bulk purchase: ", cost);
        if (score >= cost) {
            console.log("Purchase approved");
            setScore(prev => prev - cost);
            setPassiveIncomeLevel(prev => {const newLevel = prev + actualBulk; return newLevel;
            
            });
        } else { console.log("Not enough Score")}
    }







    // End of Game Methods
    /////////////////////////////////////////////////////////////////////

  return {
    score,
    multiplier,
    passiveIncomeLevel,
    prestigeLevel,
    backgroundColor,
    frameChoice,
    bulkAmountDoubleIncome,
    bulkAmountPassiveIncome,
    setBackgroundColor,
    setFrameChoice,
    setPassiveIncomeLevel,
    setBulkAmountDoubleIncome,
    setBulkAmountPassiveIncome,
    getBulkMultiplierCost,
    getBulkPassiveCost,
    setScore,
    handleClick,
    handleDoubleClick,
    handlePassivePurchase,
    loadGame,
    saveData,
  };
};