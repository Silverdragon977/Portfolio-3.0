
// import { useState, useEffect, useRef } from "react"; //Default React Lib
import { useState, useEffect, useRef } from "react";
import { BACKGROUND_THEMES } from "./BackgroundThemes";
import type { BackgroundThemeKey } from "./BackgroundThemes";
import { FRAME_THEMES } from "./FrameThemes";
import type { FrameThemeKey } from "./FrameThemes";
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
  const [selectedTheme, setSelectedTheme] = useState<BackgroundThemeKey>(backgroundColor);
  const [selectedFrame, setSelectedFrame] = useState<FrameThemeKey>(frameChoice);

  useState<BackgroundThemeKey>(backgroundColor);
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
                  {/* Prestige Level */}
                    <div style={{ gridRow: "2 / span 1", gridColumn: "2 / span 4"}} className="info-titles prestige-level">
                        <h3>Prestige Level: {prestigeLevel}</h3>
                    </div>
                    {/* Multiplier Display */}
                    <div style={{ gridRow: "3 / span 1", gridColumn: "2 / span 4"}} className="info-titles multiplier">
                        <h3>Point Multiplier: x{multiplier}</h3>
                    </div>
                    {/* Score Display */}
                    <div style={{ gridRow: "4 / span 2", gridColumn: "2 / span 4"}} className="info-titles score text-center p-4">
                        <h1>Total Points: {score}</h1>
                    </div>
                    {/* Clicks Per Second Display */}
                    <div style={{ gridRow: "2 / span 2", gridColumn: "6 / span 4"}} className="info-titles clicks-per-second ">
                        <h1>Points Per Second: <br /> {passiveIncomeLevel}</h1>
                    </div>

                    {/* Click Button */}
                    <div className="text-left p-4" style={{ gridRow: "7 / span 2", gridColumn: "2 / span 4"}}>
                        <button className="btn shop-button w-100 h-100" onClick={handleClick}>
                            Click Me!
                        </button>
                    </div>
                    {/* Save Button */}
                    <div className="text-left p-4" style={{ gridRow: "7 / span 2", gridColumn: "6 / span 4"}}>
                        <button className="btn shop-button w-100 h-100" onClick={saveData}>
                            Save Game
                        </button>
                    </div> 
                    <div style={{gridRow: "10 / span 2", gridColumn: "1 / span 4"}} className="shop-item-label">
                        <button onClick={() => setScore(prev => prev + 100000)}>DEV: +100k</button>
                    </div>

            {/* Shop */}
            <div style={{ gridRow: "2 / span 12", gridColumn: "10 / span 6"}} className="shop">
                <div className="layout-grid">
                    <div style={{gridRow: "1 / span 2", gridColumn: "1 / span 16"}} className="text-center">
                        <h1 className="shop-heading">Purchase Upgrades </h1>
                    </div>
                            
                {/*============================ */}                            
                {/*==  Double Score Row    === */}
                    <div style={{gridRow: "6 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h3>Double Points</h3>
                    </div>
                        <button style={{gridRow: "6 / span 1", gridColumn: "8 / span 3"}} className="btn shop-button" 
                        onClick={handleDoubleClick}>
                             ${getBulkMultiplierCost(Math.log2(multiplier), bulkAmountDoubleIncome)}
                        </button>
                        <div style={{ gridRow: "6 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
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
                    <div style={{gridRow: "7 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h3>Increase PPS: </h3>
                    </div>
                    <button style={{gridRow: "7 / span 1", gridColumn: "8 / span 3"}} className="btn shop-button" 
                    onClick={handlePassivePurchase}>
                        ${getBulkPassiveCost(passiveIncomeLevel, bulkAmountPassiveIncome)}
                    </button>
                    <div style={{ gridRow: "7 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
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
                    <div style={{gridRow: "9 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h5>Change Theme</h5>
                    </div>
                    <div style={{gridRow: "8 / span 2", gridColumn: "8 / span 3"}} className="theme-controls">
                      <select
                        value={selectedTheme}
                        onChange={(e) =>
                          setSelectedTheme(e.target.value as BackgroundThemeKey)
                        }
                      >
                        {Object.keys(BACKGROUND_THEMES).map((key) => (
                          <option key={key} value={key}>
                            {key}
                          </option>
                        ))}
                      </select>

                    
                      <button onClick={() => setBackgroundColor(selectedTheme)}>
                        Apply
                      </button>
                    </div>
                  <div style={{gridRow: "10 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h5>Change Frame</h5>
                    </div>
                  <div style={{gridRow: "9 / span 2", gridColumn: "8 / span 4"}} className="theme-controls">
                      <select
                        value={selectedFrame}
                        onChange={(e) =>
                          setSelectedFrame(e.target.value as FrameThemeKey)
                        }>
                        {Object.keys(FRAME_THEMES).map((key) => (
                          <option key={key} value={key}>
                            {key}
                          </option>
                        ))}
                      </select>
                      <button onClick={() => setFrameChoice(selectedFrame)}>
                        Apply
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  );
}
