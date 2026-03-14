console.log('ClickerHero loaded');
import { useState, useEffect, useRef } from "react";
import "./ClickerHero.scss";

export default function ClickerHero() {

    // Max of n + 1 clicks
    // Eg. if MAX_SCORE is 10, then 11 clicks
    // is when the user wins and resets to 0.
    const MAX_SCORE = 999; 
    const AUTOSAVE_INTERVAL = 30000; // Timer for auto-saving game data (30 seconds)
    const MULTIPLIER_COSTS = [10, 30, 90, 270, 810];

    const lastSavedData = useRef({ score: 0, multiplier: 1 });

    // Game State
    const [score, setScore] = useState<number>(0);
    const [multiplier, setMultiplier] = useState<number>(1);

    
    // Loads the game data from load route when the component mounts
    useEffect(() => {
        loadGame();
    }, []);

    // Auto-saves the game data every 30 seconds, but only if there have been changes since the last save
    useEffect(() => {
        const interval = setInterval(() => 
            {
                saveData();
            }, AUTOSAVE_INTERVAL);
        return () => clearInterval(interval);
    }, [score, multiplier]); 
 
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
        if (score === lastSavedData.current.score && multiplier === lastSavedData.current.multiplier) {
            console.log('No changes since last save, skipping save.');
            return;
        }
        const saveJsonData = {
            score: score,
            multiplier: multiplier,
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

            lastSavedData.current = { score: score, multiplier: multiplier }; // Update the ref with the current data after successful save
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
            setScore(data.score);
            setMultiplier(data.multiplier);
            lastSavedData.current = { score: data.score, multiplier: data.multiplier }; // Update the ref with the loaded data
        } catch (error) {
            console.error("Error loading save:", error);
        }
    };
    // End of Game Methods
    /////////////////////////////////////////////////////////////////////
    // Render the game UI

    return ( 
            <div className="clicker-hero-container">
                <div className="layout-grid">
                    {/* Multiplier Display */}
                    <div style={{ gridRow: "4 / span 1", gridColumn: "1 / span 5"}} className="multiplier text-center p-4">
                        <h1>Score Multiplier: x{multiplier}</h1>
                    </div>
                    {/* Score Display */}
                    <div style={{ gridRow: "5 / span 1", gridColumn: "1 / span 5"}} className="score text-center p-4">
                        <h1>Score: {score}</h1>
                    </div>

                    {/* Click Button */}
                    <div className="text-left p-4" style={{ gridRow: "8 / span 2", gridColumn: "1 / span 5"}}>
                        <button className="btn btn-outline-dark w-100 h-100" onClick={handleClick}>
                            Click Me!
                        </button>
                    </div>
                    {/* Save Button */}
                    <div className="text-left p-4" style={{ gridRow: "10 / span 2", gridColumn: "1 / span 5"}}>
                        <button className="btn btn-outline-dark w-100 h-100" onClick={saveData}>
                            Save Game
                        </button>
                    </div> 

                    {/* Shop */}
                    <div style={{ gridRow: "1 / span 12", gridColumn: "6 / span 12"}} className="shop">
                        <div className="layout-grid">
                            <h1 style={{gridRow: "1 / span 2", gridColumn: "1 / span 12"}} className="text-center">Shop</h1>
                            
                            {/* Double Score */}
                            <h1 style={{gridRow: "3 / span 2", gridColumn: "4 / span 6"}}>
                                Cost: ${[10, 30, 90, 270, 810][Math.log2(multiplier)]} <br />
                            </h1>
                            <button style={{gridRow: "3 / span 1", gridColumn: "2 / span 1"}} className="btn btn-outline-dark" onClick={doubleClick}>
                                Double Score
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        );
}
