 
Date of Creation: 3/27/26

Done Checkmark:  ✅
Not Done or can't complete : ❌
Reworked/Replaced: 🔄 

# Sprint 004 – Title 

## 📅 Duration
Start Date: 3/27/26
End Date:  4/5/26   
Length: 1 Week  

---

## 🎯 Sprint Goal
Why are we doing this?
In this sprint I will be refactoring and making the algorithm for doubling the multipliers per click
and the passive income costs. This will rebalance the early, mid, and late game to reduce bordom, increasing 
playability. Also I will be moving theme controls into the store, and making the UI more inclusive and easy to use.
Once the themes are in the controls we will add costs to them and save the purchases. We will also be adding comprehensive
testing with Pest to the clicker game. This will make the game much more robust!


---
# EPIC: Clicker Hero - Game features
    ## 3. Core Functionality & UI    
    ## I-4 E-4 D-4
        - [ ] create more stable algorithm for passive income (no implementation yet) 
        - [ ] create more stable algorithm for double income PPS (no implementation yet) 
        - [ ] Add columns in the clickergame table safely to add bought frames and bought backgrounds
        - [ ] On purchase of Background or Frame add it to the table 
        - [ ] on the buyBackground and buyFrame method add functionality to check the bought themes and 
            if the item is already bought then reduce the price to 0  
        - [ ] move the themes buttons and labels into the store successfully    
        - [ ] make the UI for theme selector into styled div grids instead of drop down inside the shop
        - [ ] Separate the themes into common, rare, ultra rare, and to be added legendary 
        

    ## 7. Game State Normalization
    ## I-5 E-3 D-4
    - [ ] Separate "derived values" from state (e.g. PPS = level * 2)
    - [ ] Ensure single source of truth for costs
    - [ ] Remove duplicated logic between systems
    - [ ] Create clear "economy layer" (cost + scaling functions)

---
# 🟣 EPIC: Quality & Testing
    ## I-5  E-3 D-3
    ### Goals
    Improve code confidence and prevent regressions.

    ### Tasks
        - [ ] Add feature tests for API routes
        - [ ] Add database migration tests
        - [ ] Add frontend TypeScript strict validation checks
        - [ ] Introduce test coverage reporting
        - [ ] Refactor JS with TS types and other TS safety measures
    ### Pest Tests
        - [ ] Pest the API endpoints
        - [ ] Pest the Save/load integrity
        - [ ] Pest the Leaderboard
        - [ ] Pest Database migration tests

---


## 🚫 Out of Scope
- Achievements
- Sound effects
- Production performance optimization

---


### Data Model
ClickerHero Table:
- user_id (foreign key)
- score
- passive_income_level
- prestige_level     
- background_color   
- backgrounds_purchased // new
- frame_choice       
- backgrounds_purchased // new
- updated_at



### API Structure
POST /api/clicker/save  
GET /api/clicker/load  
GET /api/clicker/leaderboard
---

## Acceptance Criteria
- No console errors
- No database errors
- CI passes
- Pest passes
---

## 🔄 CI/CD Plan
- Feature branch: /sprint004
- PR Merge to main after completion
- Run deployment script
- Verify production
- Tag release v1.4.0

---

## 📊 Risk Assessment

| Risk | Mitigation |
|------|------------|
| Merge conflicts | Merge main into feature weekly |
| State bugs | Keep logic isolated in component |
| API spam | Debounce save calls |

---

## 📝 Notes


## Developement Log



## In-Depth Development Log
 
 
 
 
 
 

