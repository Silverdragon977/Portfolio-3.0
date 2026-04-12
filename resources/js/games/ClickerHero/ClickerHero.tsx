// ClickerHero.tsx - Main Game Component for Clicker Hero
// import { useState, useEffect, useRef } from "react"; //Default React Lib
import { useState, useEffect, useRef } from "react";
import { BACKGROUND_THEMES } from "./hooks/themes/BackgroundThemes";
import type { BackgroundThemeKey } from "./hooks/themes/BackgroundThemes";
import { FRAME_THEMES } from "./hooks/themes/FrameThemes";
import type { FrameThemeKey } from "./hooks/themes/FrameThemes";
import { useClickerGame } from "./hooks/useClickerGame";  //State&Logic Lib Hook
import { StoreOverlay } from "./StoreOverlay"; // Store Overlay Component
import { SavingIndicator } from "./components/SavingIndicator";
import { Leaderboard } from "./components/Leaderboard";
import "./ClickerHero.scss";
console.log("Main Game loaded")





export default function ClickerHero() {
    const BASE_URL = (window as any).APP_URL;
    //////////////////////////////////////////////////
    //////   Hook State and Variables            /////
    //////////////////////////////////////////////////
    // Adding Game Logic Hook
    const {
    score, multiplier, passiveIncomeLevel, prestigeLevel, backgroundColor, frameChoice,
    bulkAmountDoubleIncome, bulkAmountPassiveIncome, isStoreOpen, isSaving,
    setPassiveIncomeLevel,
    setBulkAmountDoubleIncome, setBulkAmountPassiveIncome,
    getBulkMultiplierCost, getBulkPassiveCost,
    setScore,
    handleClick, handleDoubleClick, handlePassivePurchase,
    loadGame, saveData,
    setBackgroundColor, setFrameChoice, setIsStoreOpen, setIsSaving,
    } = useClickerGame();

    ////////////////////////////////////////////////////
    //
    ////////////////////////////////////////////////////
    //////  Game State Variables and Constants     /////
    ////////////////////////////////////////////////////
    //
    //
    ////////////////////////////////////////////////////////
    /////////     Use State Stuff              /////////////
    ////////////////////////////////////////////////////////



  

    // End of Game Methods
    /////////////////////////////////////////////////////////////////////
    // Render the game UI
    const game = {
    score, multiplier, passiveIncomeLevel, prestigeLevel, backgroundColor, frameChoice,
    bulkAmountDoubleIncome, bulkAmountPassiveIncome, isStoreOpen, isSaving,
    setPassiveIncomeLevel,
    setBulkAmountDoubleIncome, setBulkAmountPassiveIncome,
    getBulkMultiplierCost, getBulkPassiveCost,
    setScore,
    handleClick, handleDoubleClick, handlePassivePurchase,
    loadGame, saveData,
    setBackgroundColor, setFrameChoice, setIsStoreOpen, setIsSaving,
    }; // allows the useage of the game hook in the store overlay

    return  ( 
              <div className="clicker-hero-container">
                  <div className="layout-grid">
                  {/* Prestige Level */}
                      <div style={{ gridRow: "2 / span 1", gridColumn: "10 / span 4"}} className="info-titles prestige-level">
                          <h3>Prestige Level: {prestigeLevel}</h3>
                      </div>
                  {/* Clicks Per Second Display */}
                      <div style={{ gridRow: "6 / span 2", gridColumn: "2 / span 6"}} className="info-titles clicks-per-second ">
                          <h1>Points Per Second: <br /> {passiveIncomeLevel * 2}</h1>
                      </div>
                  {/* Saving Indicator */}    
                      <div style={{gridRow: "1 / span 2", gridColumn: "12 / span 3"}} className="outline-btn w-100 h-100">
                            <SavingIndicator isSaving={game.isSaving} />
                      </div>
                  {/* Multiplier Display */}
                      <div style={{ gridRow: "5 / span 1", gridColumn: "2 / span 6"}} className="info-titles multiplier">
                          <h3>Point Multiplier: x{multiplier}</h3>
                      </div>
                  {/* Score Display */}
                      <div style={{ gridRow: "8 / span 2", gridColumn: "2 / span 6"}} className="info-titles score text-center p-4">
                          <h1>Total Points: {score}</h1>
                      </div>
  
  
                  {/* Click Button */}
                      <div className="text-left p-4" style={{ gridRow: "10 / span 2", gridColumn: "2 / span 6"}}>
                          <button className="btn shop-button w-100 h-100" onClick={handleClick}>
                              Click Me!
                          </button>
                      </div>
                  {/* Save Button */}
                      <div className="text-left p-4" style={{ gridRow: "10 / span 2", gridColumn: "12 / span 4"}}>
                          <button className="btn shop-button w-100 h-100" onClick={saveData}>
                              Save Game
                          </button>
                      </div>
                  {/* dev only tool not rendered in prod
                      <div style={{gridRow: "10 / span 2", gridColumn: "1 / span 4"}} className="shop-item-label">
                          <button onClick={() => setScore(prev => prev + 100000)}>DEV: +100k</button>
                      </div> */}
                  {/* Open Store Button */}
                      <div style={{ gridRow: "2 / span 2", gridColumn: "14 / span 2"}}>
                          <button className="btn shop-button w-80 h-80 center" onClick={() => setIsStoreOpen(true)}>
                              <h1>Open Store</h1>
                          </button>
                          {isStoreOpen && (
                              <StoreOverlay 
                                    game={game} 
                                    onClose={() => setIsStoreOpen(false)}
                                />
                          )}
                      </div>
                      <div style={{ gridRow: "2 / span 2", gridColumn: "2 / span 6"}} className="text-center">
                          <Leaderboard />
                      </div>


                  </div> {/* End of Layout Grid */}
              </div>
            ); {/* End of Component */}
          } 
