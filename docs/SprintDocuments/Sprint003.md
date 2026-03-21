 
Date of Creation: 3/20/26

Done Checkmark:  ✅
Not Done or can't complete: ❌

# Sprint 003 – Refactor/Document React App, UI/UX features, and Leaderboard 

## 📅 Duration
Start Date: 3/21/26
End Date:  3/28/26   
Length: 1 Week  

---

## 🎯 Sprint Goal
Why are we doing this?
- adds to the user experience and user interface
- by refactoring the react codebase into smaller chucks it reduces
  the complexity and organizes development
- We implement a strategic math heavy algorithm to reduce staleness 
  in gameplay via passive income and active income prices per upgrade
- Incentivise player to keep playing with competitive goal 
  of getting the highest score


---
# EPIC: Clicker Hero - Game features
    ## 1. UI/UX Improvements
    ## I-3  E-3 D-2
        - [ ] Add saving animation feedback
        - [ ] Add prestige emblems
        - [ ] Change theme changer using select to styled div
    ------------
    ## 2. Refactor for Simplicity
    ## I-4 E-4 D-3
        - [ ] Create component for store and remove the store from ClickerHero.tsx
        - [ ] Remove Theme Backgrounds and Frames from ClickerHero.tsx and useClickerHero.tsx into it's own component
        - [ ] remove unused state
        - [ ] extract store from ClickerHero.tsx for simplicity
        - [ ] create component for save/load // Optional
    -------------
    ## 3. Core Functionality
    ## I-4 E-4 D-4
        - [ ] create more stable algorithm for passive income  
        - [ ] create more stable algorithm for double income PPS
    --------------
    ## 4. Store Toggle & Leaderboard panel (UI/UX)
    ## I-3 E-3 D-3
        - [ ] add isStoreOpen toggle state in useClickerHero
        - [ ] create Open store button
        - [ ] add isLearderboardOpen toggle 
        - [ ] create sliding leaderboard panel (CSS transition)
        - [ ] ensure clean close and open behavior
    --------------
    ## 5. Leaderboard API & Data layer
    ## I-4 E-3 D-3
        - [ ] add relationship ClickerGame -> belongsTo(User)
        - [ ] create leaderboard() method in controller
        - [ ] make sql query to grab top 3 users based on high score
        - [ ] map username, score, prestige_level
        - [ ] add api route /leaderboard
        - [ ] create leaderboard component
        - [ ] fetch /leaderboard on mount and every 60 seconds
        - [ ] display ranked ordered list
    ----------------
---
# Epic: Production Architecture
    ## 1. Documentation
    ## I-3  E-2 D-4

        ### Tasks
        - [ ] Create `docs/ProductionArchitecture/production-architecture.md`
            - Server OS
            - Nginx structure
            - PHP-FPM model
            - SSL strategy
            - Deployment pipeline
            - Security layers (UFW, Fail2Ban)
        - [ ] Add architecture change log section

---

## 🚫 Out of Scope
- Leaderboards
- Achievements
- Animations
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
- frame_choice       
- updated_at



### API Structure
POST /api/clicker/save  
GET /api/clicker/load  
GET /api/clicker/leaderboard // new
---

## Acceptance Criteria
- No console errors
- No database errors
- CI passes
- Pest passes
---

## 🔄 CI/CD Plan
- Feature branch: /sprint003
- PR Merge to main after completion
- Run deployment script
- Verify production
- Tag release v1.3.0 (Optional)

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
 
 
 
 
 
 

