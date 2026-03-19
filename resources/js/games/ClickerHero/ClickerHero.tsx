
// import { useState, useEffect, useRef } from "react"; //Default React Lib
import { useState, useEffect, useRef } from "react";
import { BACKGROUND_THEMES } from "./BackgroundThemes";
import type { BackgroundThemeKey } from "./BackgroundThemes";
import { FRAME_THEMES } from "./FrameThemes";
import { useClickerGame } from "./hooks/useClickerGame";  //State&Logic Lib Hook
import "./ClickerHero.scss";

console.log("Main Game loaded")




export default function ClickerHero() {

    // Adding Game Logic Hook
    const {
    score, multiplier, passiveIncomeLevel, prestigeLevel, backgroundColor, frameChoice,
    bulkAmountDoubleIncome, bulkAmountPassiveIncome,
    setPassiveIncomeLevel,
    setBulkAmountDoubleIncome, setBulkAmountPassiveIncome,
    getBulkMultiplierCost, getBulkPassiveCost,
    setScore,
    handleClick, handleDoubleClick, handlePassivePurchase,
    loadGame, saveData,
    setBackgroundColor, setFrameChoice,
    } = useClickerGame();

  const BackgroundTheme = BACKGROUND_THEMES[backgroundColor] ?? BACKGROUND_THEMES.default;
  const FrameTheme = FRAME_THEMES[frameChoice] ?? FRAME_THEMES.default;
  
    

    // Max of n + 1 clicks
    // Eg. if MAX_SCORE is 10, then 11 clicks
    // is when the user wins and resets to 0.
    // const MAX_SCORE = 999999999; 
    // const AUTOSAVE_INTERVAL = 30000; // Timer for auto-saving game data (30 seconds)
    // const MULTIPLIER_COSTS = [10, 30, 90, 270, 810, 2430, 7290, 21870, 65610, 131220, 262440, 524880, 1049760, 2099520, 4199040, 8398080, 12597120, 18895680, 28343520, 34012224, 40814669, 48977603, 58773124, 70527749, 84672000]; // Costs for each multiplier level (x2, x4, x8, etc.)
    // const PASSIVE_INCOME_COSTS = [100, 250, 500, 750, 1000];
    // const lastSavedData = useRef({ score: 0, multiplier: 1, passiveIncomeLevel: 0, prestigeLevel: 0, backgroundColor: 'default', frameChoice: 'default' }); // Ref to store the last saved game data for comparison before saving

    // // Game State Variables
    // const [score, setScore] = useState<number>(0);
    // const [multiplier, setMultiplier] = useState<number>(1);
    // const [passiveIncomeLevel, setPassiveIncomeLevel] = useState<number>(0);
    // const [prestigeLevel, setPrestigeLevel] = useState<number>(0);
    // const [backgroundColor, setBackgroundColor] = useState<string>('default');
    // const [frameChoice, setFrameChoice] = useState<string>('default');
    // const [bulkAmountPassiveIncome, setBulkAmountPassiveIncome] = useState<number>(1);
    // const [bulkAmountDoubleIncome, setBulkAmountDoubleIncome] = useState<number>(1);

    
    // useEffect(() => {
    //     // Loads the game data from load route when the component mounts
    //     loadGame();
    // }, []);
    
    // useEffect(() => {
    //     // Sets Background Theme based on user selection
    //     const theme = BACKGROUND_THEMES[backgroundColor] || BACKGROUND_THEMES.default;

    //     Object.entries(theme).forEach(([key, value]) => {
    //         document.documentElement.style.setProperty(key, value);
    //     });
    // }, [backgroundColor]);

    // useEffect(() => {
    //     const theme = FRAME_THEMES[frameChoice] || FRAME_THEMES.default;

    //     Object.entries(theme).forEach(([key, value]) => {
    //       document.documentElement.style.setProperty(key, value);
    //     });
    // }, [frameChoice]);

    // //// SaveGame Interval Logic ////
    // // Auto-saves the game data every 30 seconds, but only if there have been changes since the last save
    // useEffect(() => {
    //     const interval = setInterval(() => 
    //         {
    //             saveData();
    //         }, AUTOSAVE_INTERVAL);
    //     return () => clearInterval(interval);
    // }, [score, multiplier, passiveIncomeLevel, prestigeLevel, backgroundColor, frameChoice]); 

    // //// Passive Income Logic ////
    // useEffect(() => {
    //     const passiveIncomeInterval = setInterval(() => {
    //         setScore(prevScore => {
    //             const newScore = prevScore + passiveIncomeLevel;
    //             return newScore <= MAX_SCORE ? newScore : prevScore;
    //         });
    //     }, 1000);

    //     return () => clearInterval(passiveIncomeInterval);
    // }, [passiveIncomeLevel]);
 
    // /////////////////////////////////////////////////
    // // Button Click Game Logic                     //
    // /////////////////////////////////////////////////


    // const saveData = async () => {
    //     // Check for no difference in game data since last save to prevent unnecessary saves
    //     if (score === lastSavedData.current.score && multiplier === lastSavedData.current.multiplier && passiveIncomeLevel === lastSavedData.current.passiveIncomeLevel && prestigeLevel === lastSavedData.current.prestigeLevel && backgroundColor === lastSavedData.current.backgroundColor && frameChoice === lastSavedData.current.frameChoice) {
    //         console.log('No changes since last save, skipping save.');
    //         return;
    //     }
    //     const saveJsonData = {
    //         score: score,
    //         multiplier: multiplier,
    //         passive_income_level: passiveIncomeLevel,
    //         prestige_level: prestigeLevel,
    //         background_color: backgroundColor,
    //         frame_choice: frameChoice
    //     };
    //     try {
    //         const response = await fetch('/clickerhero/save', {
    //             method: 'POST',
    //             credentials: 'same-origin',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    //             },
    //             body: JSON.stringify(saveJsonData)
    //         });
    //         if (!response.ok) {
    //             throw new Error(`Network response was not ok: ${response.status}`);
    //         }
    //         const result = await response.json();
    //         console.log('Save successful:');
    //         // console.log('Save successful:', result);

    //         lastSavedData.current = { score: score, multiplier: multiplier, passiveIncomeLevel: passiveIncomeLevel, prestigeLevel: prestigeLevel, backgroundColor: backgroundColor, frameChoice: frameChoice}; // Update the ref with the current data after successful save
    //     }
    //     catch (error) {
    //         console.error(`Error saving data: ${error}`);
    //     }
    // }

    // const loadGame = async () => {
    //     try {
    //         const response = await fetch('/clickerhero/load');
    //         if (!response.ok) {
    //             throw new Error(`Failed to load game data: ${response.status}`);
    //         }
    //         const data = await response.json();

    //         setScore(data.score ?? 0);
    //         setMultiplier(data.multiplier ?? 1);
    //         setPassiveIncomeLevel(data.passive_income_level ?? 0);
    //         setPrestigeLevel(data.prestige_level ?? 0);
    //         setBackgroundColor(data.background_color ?? 'default');
    //         setFrameChoice(data.frame_choice ?? 'default');
    //         lastSavedData.current = { 
    //             score: data.score,
    //             multiplier: data.multiplier, 
    //             passiveIncomeLevel: data.passive_income_level, 
    //             prestigeLevel: data.prestige_level, 
    //             backgroundColor: data.background_color,
    //             frameChoice: data.frame_choice
    //         }; // Update the ref with the loaded data
    //     } catch (error) {
    //         console.error("Error loading save:", error);
    //     }
    // };

    // const handleDoubleClick = () => {
    //     const currentLevel = Math.log2(multiplier);

    //     const remainingLevels = MULTIPLIER_COSTS.length - currentLevel;
    //     const actualBulk = Math.min(bulkAmountDoubleIncome, remainingLevels);

    //     const cost = getBulkMultiplierCost(currentLevel, actualBulk);

    //     if (score >= cost && actualBulk > 0) {

    //         setScore(prev => prev - cost);

    //         setMultiplier(prev => prev * Math.pow(2, actualBulk));

    //     }
    // }
    // function getBulkMultiplierCost(
    //     currentLevel: number,
    //     bulkAmount: number
    // ): number {

    //     let totalCost = 0;

    //     for (let i = 0; i < bulkAmount; i++) {
    //         const nextLevel = currentLevel + i;

    //         if (nextLevel >= MULTIPLIER_COSTS.length) break;

    //         totalCost += MULTIPLIER_COSTS[nextLevel];
    //     }

    //     return totalCost;
    // }




    // function getPassiveIncomeCost(level: number): number {
    //     // This gets called by getBulkPassiveIncomeCost and the passive income per second
    // let value = 10;
    // for (let i = 0; i < level; i++) {
    //     let multiplier;
    //     if (i < 5) 
    //         {multiplier = 3} 
    //     else if (i < 15) 
    //         {multiplier = 2.5;} 
    //     else if (i < 25) 
    //         {multiplier = 2.0;} 
    //     else if (i < 35) 
    //         {multiplier = 1.5;} 
    //     else if (i < 45) 
    //         {multiplier = 1.4;} 
    //     else {multiplier = 1.2;}
    //     value *= multiplier;
    // }
    //     return Math.floor(value);
    // }
    // function getBulkPassiveCost(
    //     currentLevel: number,
    //     bulkAmount: number
    // ): number {

    //     let totalCost = 0;

    //     for (let i = 0; i < bulkAmount; i++) {
    //         totalCost += getPassiveIncomeCost(currentLevel + i);
    //     }
    //     return totalCost;
    // }
    // const handlePassivePurchase = () => {
    //     console.log("Current Level: ", passiveIncomeLevel);
    //     console.log("Bulk: ", bulkAmountPassiveIncome);
    //     if (passiveIncomeLevel >= 256) return;
    //     const remainingLevels = 256 - passiveIncomeLevel;
    //     const actualBulk = Math.min(bulkAmountPassiveIncome, remainingLevels);
    //     const cost = getBulkPassiveCost(passiveIncomeLevel, actualBulk);
    //     console.log("Cost for bulk purchase: ", cost);
    //     if (score >= cost) {
    //         console.log("Purchase approved");
    //         setScore(prev => prev - cost);
    //         setPassiveIncomeLevel(prev => {const newLevel = prev + actualBulk; return newLevel;
            
    //         });
    //     } else { console.log("Not enough Score")}
    // }

    const setDefaultBackground = () => {
      setBackgroundColor('default');
    };

    const setCommonBackground = () => {
      setBackgroundColor('common');
    };
    const setDefaultFrame = () => {
      setFrameChoice('default');
    };

    const setCommonFrame = () => {
      setFrameChoice('common');
    };




    // End of Game Methods
    /////////////////////////////////////////////////////////////////////
    // Render the game UI

    return ( 
            <div className="clicker-hero-container">
                <div className="layout-grid">
                    {/* Multiplier Display */}
                    <div style={{ gridRow: "2 / span 2", gridColumn: "2 / span 4"}} className="multiplier text-center p-4">
                        <h1>Point Multiplier: x{multiplier}</h1>
                    </div>
                    {/* Score Display */}
                    <div style={{ gridRow: "5 / span 2", gridColumn: "2 / span 4"}} className="score text-center p-4">
                        <h1>Total Points: {score}</h1>
                    </div>
                    {/* Clicks Per Second Display */}
                    <div style={{ gridRow: "2 / span 2", gridColumn: "6 / span 4"}} className="clicks-per-second text-center p-4">
                        <h1>Points Per Second: {passiveIncomeLevel}</h1>
                    </div>

                    {/* Click Button */}
                    <div className="text-left p-4" style={{ gridRow: "7 / span 2", gridColumn: "2 / span 4"}}>
                        <button className="btn btn-outline-dark w-100 h-100" onClick={handleClick}>
                            Click Me!
                        </button>
                    </div>
                    {/* Save Button */}
                    <div className="text-left p-4" style={{ gridRow: "7 / span 2", gridColumn: "6 / span 4"}}>
                        <button className="btn btn-outline-dark w-100 h-100" onClick={saveData}>
                            Save Game
                        </button>
                    </div> 
                    {/* Prestige Level */}
                    <div style={{ gridRow: "5 / span 2", gridColumn: "6 / span 4"}} className="prestige-level text-center p-4">
                        <h1>Prestige Level: {prestigeLevel}</h1>
                    </div>

            {/* Shop */}
            <div style={{ gridRow: "2 / span 12", gridColumn: "10 / span 6"}} className="shop">
                <div className="layout-grid">
                    <div style={{gridRow: "1 / span 2", gridColumn: "1 / span 16"}} className="text-center">
                        <h1 className="shop-heading">Purchase Upgrades </h1>
                    </div>
                            
                {/*============================ */}                            
                {/*==  Double Score Row    === */}
                    <div style={{gridRow: "3 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h3>Double Points</h3>
                    </div>
                        <button style={{gridRow: "3 / span 1", gridColumn: "8 / span 3"}} className="btn btn-outline-dark" 
                        onClick={handleDoubleClick}>
                             ${getBulkMultiplierCost(Math.log2(multiplier), bulkAmountDoubleIncome)}
                        </button>
                        <div style={{ gridRow: "3 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
                          {[1, 5, 10].map((amount) => (
                                <button
                                key={amount}
                                className={`bulk-btn ${bulkAmountDoubleIncome === amount ? 'active' : ''}`}
                                onClick={() => setBulkAmountDoubleIncome(amount)}>
                                    {amount}x
                                </button>
                            ))}
                        </div>
                {/*=========================== */}
                {/*==  Passive Income Row  ==*/}
                    <div style={{gridRow: "4 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h3>Increase PPS: </h3>
                    </div>
                    <button style={{gridRow: "4 / span 1", gridColumn: "8 / span 3"}} className="btn btn-outline-dark" 
                    onClick={handlePassivePurchase}>
                        ${getBulkPassiveCost(passiveIncomeLevel, bulkAmountPassiveIncome)}
                    </button>
                    <div style={{ gridRow: "4 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
                      {[1, 5, 10].map((amount) => (
                        <button
                            key={amount}
                            className={`bulk-btn ${bulkAmountPassiveIncome === amount ? 'active' : ''}`}
                            onClick={() => setBulkAmountPassiveIncome(amount)}>
                            {amount}x
                        </button>
                      ))}
                    </div>
                {/*=========================== */}
                {/*==  Future Shop Items   ==*/}
                    {/**  Remove before PR   */}
                    <div style={{gridRow: "5 / span 2", gridColumn: "1 / span 4"}} className="shop-item-label">
                        <button onClick={() => setScore(prev => prev + 100000)}>DEV: +100k</button>
                    </div>
                    <div style={{gridRow: "5 / span 2", gridColumn: "5 / span 4"}} className="shop-item-label">
                        <button onClick={setDefaultBackground}>Set Default Background</button>
                    </div>
                    <div style={{gridRow: "5 / span 2", gridColumn: "9 / span 4"}} className="shop-item-label">
                        <button onClick={setCommonBackground}>Set Common Background</button>    
                    </div>
                </div>
            </div>
        </div>
    </div>
     );
    }
