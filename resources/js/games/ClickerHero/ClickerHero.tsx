console.log('ClickerHero component loaded');
import { useState, useEffect } from "react";
import "./ClickerHero.scss";

export default function ClickerHero() {

    // Max of n + 1 clicks
    // Eg. if MAX_SCORE is 10, then 11 clicks
    // is when the user wins and resets to 0.
    const MAX_SCORE = 9; 

    const [score, setScore] = useState<number>(() => {
        // Check for saved score in localStorage on initial load
        const savedScore = localStorage.getItem('clickerHeroScore');
        if (savedScore && parseInt(savedScore) > MAX_SCORE) {
            return 0;
        }
        return savedScore ? parseInt(savedScore) : 0;
    });

    /////////////////////////////////////////////////
    // Save score locally in browser storage       //
    /////////////////////////////////////////////////
    useEffect(() => {
        localStorage.setItem('clickerHeroScore', score.toString());
    }, [score]);

    /////////////////////////////////////////////////
    // Button Click Game Logic                     //
    /////////////////////////////////////////////////
    const handleClick = () => {
        if (score <= (MAX_SCORE + 1)) {
            setScore(prevScore => prevScore + 1);
        }
        if (score > MAX_SCORE) {
            alert(`Congratulations! You've reached ${MAX_SCORE + 1} clicks!`);
            setScore(0); // Reset score after reaching MAX_SCORE
        }
    }



    return ( 
            <div className="clicker-hero-container">
                <div className="layout-grid">
                    {/* Click Button */}
                    <div className="text-left p-4" style={{ gridRow: 6, gridColumn: "1 / span 3"}}>
                        <button className="btn btn-outline-dark w-100 h-100" onClick={handleClick}>
                            Click Me!
                        </button>
                    </div>
                    {/* Score Display */}
                    <div style={{ gridRow: 2, gridColumn: "1 / span 3"}} className="score">
                        <h1>Score: {score}</h1>
                    </div>
                </div>
            </div>
        );
}
