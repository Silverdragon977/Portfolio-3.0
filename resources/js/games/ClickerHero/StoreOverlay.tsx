// Store.tsx
import { useClickerGame } from "./hooks/useClickerGame";

type Props = {
    game: ReturnType<typeof useClickerGame>; // Pass the entire game hook
    onClose: () => void;
};

export function StoreOverlay ({ game, onClose }: Props) {
    return (
    <div className="store-overlay">
        <div className={`store-panel ${game.isStoreOpen ? "open" : ""}`}>
            {/* Shop */}
            <div  className="shop">
                <div className="layout-grid">
                                <button style={{gridRow: "1 / span 2", gridColumn: "15 / span 2"}} 
                                className="btn shop-button" onClick={onClose}>X</button>

                    <div style={{gridRow: "3 / span 2", gridColumn: "1 / span 16"}} className="text-center">
                        <h1 className="shop-heading">Purchase Upgrades </h1>
                    </div>

                {/*============================ */}                            
                {/*==  Double Score Row    === */}
                    <div style={{gridRow: "6 / span 1", gridColumn: "1 / span 6"}} className="shop-item-label">
                        <h3>Double Points</h3>
                    </div>
                        <button style={{gridRow: "6 / span 1", gridColumn: "8 / span 3"}} className="btn shop-button" 
                        onClick={game.handleDoubleClick}>
                             ${game.getBulkMultiplierCost(Math.log2(game.multiplier), game.bulkAmountDoubleIncome)}
                        </button>
                    <div style={{ gridRow: "6 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
                     {[1, 5, 10].map((amount) => (
                        <button
                            key={amount}
                            className={`bulk-btn ${game.bulkAmountDoubleIncome === amount ? 'active' : ''}`}
                            onClick={() => game.setBulkAmountDoubleIncome(amount)}>
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
                    onClick={game.handlePassivePurchase}>
                        ${game.getBulkPassiveCost(game.passiveIncomeLevel, game.bulkAmountPassiveIncome)}
                    </button>
                    <div style={{ gridRow: "7 / span 1", gridColumn: "11 / span 6" }} className="bulk-selector">
                      {[1, 5, 10].map((amount) => (
                        <button
                            key={amount}
                            className={`bulk-btn ${game.bulkAmountPassiveIncome === amount ? 'active' : ''}`}
                            onClick={() => game.setBulkAmountPassiveIncome(amount)}>
                            {amount}x
                        </button>
                      ))}
                    </div>
                {/*=========================== */}
                {/*==  Future Shop Items   ==*/}
                    {/**  Remove before PR   */}
                  
                </div>
            </div>
        </div>
    </div>
    );
}