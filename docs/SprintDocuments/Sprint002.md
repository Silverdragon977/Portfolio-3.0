3/13/26

Done Checkmark:  ✅
Not Done or can't complete: ❌

# Sprint 002 – Clicker Hero Store Additions

## 📅 Duration
Start Date: 03-14-26  
End Date:   03-21-26  
Length: 1 Week  

---

## 🎯 Sprint Goal
Deliver More Store Options for cutomization:
- Finish the passive score generator from last sprint
- implement a clicker limit to stop cheating
- Add costs to passive income
- add buttons to mass buy click upgrades with 1x, 5x, and 10x 
- add store background colors
- add prestige system
- add prestige emblems
- add frames to customize the player in store

---

## 📦 Scope (In Scope)

### Frontend (React + TS)
- [✅]   Finish the passive score generator from last sprint
- [❌]   implement a clicker limit to stop cheating  // Much harder than expected
- [✅]   Add costs to passive income
- []   add buttons to mass buy click upgrades with 1x, 5x, and 10x 
- []   add store background colors
- []   add prestige system
- []   add prestige emblems
- []   add frames to customize the player in store
- []   on the admin panel add users scores to the table
- []   create a reset button on the adminpanel to reset a users progress in click hero
- []   when saving display a saving animation

### Backend (Laravel)
- [] add prestige score to games table
- [] add background color choice to the backend
- [] add frame choice to the backend
    ## 1. Continuous Integration (CI)
       ## I-5  E-3
   
           ### Goals
           Introduce automated validation to simulate professional team workflow and prevent regressions.
   
           ### Tasks
           - [ ] Add PHPUnit tests for ClickerHeroController
           - [ ] Add validation tests for score updates
           - [ ] Add tests for updateOrCreate persistence logic
           - [ ] Configure GitHub Actions workflow:
               - Composer install
               - Laravel key generation
               - Database migration
               - PHPUnit execution
               - npm ci
               - npm run build
           - [ ] Enable branch protection rules:
               - Require Pull Requests before merge
               - Require CI checks to pass
               - Prevent direct pushes to main
   
           ---
---

## 🚫 Out of Scope
- Leaderboards
- Achievements
- Animations
- Sound effects
- Production performance optimization
- Optimizing Percentage Modifiers for passive and active income

---

## 🏗 Architecture Plan

### Data Model
ClickerHero Table:
- id
- user_id (foreign key)
- score
- passive_score_amount
- prestige_level     // New
- background_color   // New
- frame_choice       // New
- updated_at

### API Structure
POST /api/clicker/save  
GET /api/clicker/load  

---

## 🧪 Definition of Done

- Returns all the proper values
- Implemnts defaults for new users
- No console errors
- No database errors
- Clean merge into main
- Deployed to production
- Works on mobile

---

## 🔄 CI/CD Plan
- Feature branch: /sprint002
- Merge to main after completion
- Run deployment script
- Verify production
- Tag release v1.1.0 (Optional)

---

## 📊 Risk Assessment

| Risk | Mitigation |
|------|------------|
| Merge conflicts | Merge main into feature weekly |
| State bugs | Keep logic isolated in component |
| API spam | Debounce save calls |

---

## 📝 Notes
From now on we use full console.logs for development, minimal logs when testing before pushing to prod,
then transition to user feedback without releasing sensitive data!

## Developement Log
    Added Passive Income 
    Made algorithm to increase the price of passive income
    Passive Income needs to give more than +1 each time I feel




## In-Depth Development Log