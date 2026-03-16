console.log('ClickerHero loaded');
import { useState, useEffect, useRef } from "react";
import "./ClickerHero.scss";

export default function ClickerHero() {

    // Max of n + 1 clicks
    // Eg. if MAX_SCORE is 10, then 11 clicks
    // is when the user wins and resets to 0.
    const MAX_SCORE = 999999999; 
    const AUTOSAVE_INTERVAL = 30000; // Timer for auto-saving game data (30 seconds)
    const MULTIPLIER_COSTS = [10, 30, 90, 270, 810, 2430, 7290, 21870, 65610, 131220, 262440, 524880, 1049760, 2099520, 4199040, 8398080, 12597120, 18895680, 28343520, 34012224, 40814669, 48977603, 58773124, 70527749, 84672000]; // Costs for each multiplier level (x2, x4, x8, etc.)
    const PASSIVE_INCOME_COSTS = [100, 250, 500, 750, 1000];
    const lastSavedData = useRef({ score: 0, multiplier: 1, passiveIncomeLevel: 0, prestigeLevel: 0, backgroundColor: 'default', frameChoice: 'default' }); // Ref to store the last saved game data for comparison before saving

    // Game State Variables
    const [score, setScore] = useState<number>(0);
    const [multiplier, setMultiplier] = useState<number>(1);
    const [passiveIncomeLevel, setPassiveIncomeLevel] = useState<number>(0);
    const [prestigeLevel, setPrestigeLevel] = useState<number>(0);
    const [backgroundColor, setBackgroundColor] = useState<string>('default');
    const [frameChoice, setFrameChoice] = useState<string>('default');
    
    // Loads the game data from load route when the component mounts
    useEffect(() => {
        loadGame();
    }, []);

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
    const doubleClick = () => {
        const currentLevel = Math.log2(multiplier); 
        if (score >= MULTIPLIER_COSTS[currentLevel]) {
            setScore(prevScore => prevScore - MULTIPLIER_COSTS[currentLevel]); // Deduct cost from score
            setMultiplier(prevMultiplier => prevMultiplier * 2);
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
        } catch (error) {
            console.error("Error loading save:", error);
        }
    };

    function getPassiveIncomeCost(level: number): number {
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
                            <h1 style={{gridRow: "1 / span 2", gridColumn: "1 / span 12"}} className="text-center">Shop</h1>
                            
                            {/* Double Score */}
                            <h1 style={{gridRow: "3 / span 2", gridColumn: "2 / span 6"}}>
                                Double points <br />
                            </h1>
                            <button style={{gridRow: "3 / span 1", gridColumn: "8 / span 3"}} className="btn btn-outline-dark" onClick={doubleClick}>
                                 ${MULTIPLIER_COSTS[Math.log2(multiplier)]}
                            </button>
                            {/* Passive Income */}
                            <h1 style={{gridRow: "5 / span 2", gridColumn: "2 / span 6"}}>
                                Clicks per Second: {passiveIncomeLevel} <br />
                            </h1>
                            <button style={{gridRow: "5 / span 1", gridColumn: "8 / span 3"}} className="btn btn-outline-dark" onClick={() => {    
                                if (passiveIncomeLevel >= 256) return;
                                const cost = getPassiveIncomeCost(passiveIncomeLevel);
                                if (score >= cost) {
                                    setScore(prev => prev - cost);
                                    setPassiveIncomeLevel(prev => {
                                        const newLevel = prev + 1;
                                        console.log(`Passive income level is now ${newLevel}`);
                                        return newLevel;
                                    });
                                }
                            }}>
                                ${getPassiveIncomeCost(passiveIncomeLevel)}
                            </button>

                            {/* Future Shop Items */}

                        </div>
                    </div>
                </div>
            </div>
        );
}
