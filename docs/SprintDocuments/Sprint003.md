 
Date of Creation: 3/20/26

Done Checkmark:  ✅
Not Done or can't complete : ❌
Reworked/Replaced: 🔄 

# Sprint 003 – Refactor/Document React App, UI/UX features, and Leaderboard 

## 📅 Duration
Start Date: 3/21/26
End Date:  3/29/26   
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
        - [✅] Add saving animation feedback
        - [🔄] Add prestige emblems // emblems are outdated, instead
                  we will make legendary themes only add-able on prestige, this is in the backlog

    ------------
    ## 2. Refactor for Simplicity
    ## I-4 E-4 D-3
        - [✅] Create component for store and remove the store from ClickerHero.tsx
        - [✅] Remove Theme Backgrounds and Frames from ClickerHero.tsx and useClickerHero.tsx into it's own component
        - [✅] remove unused state
        - [✅] extract store from ClickerHero.tsx for simplicity
        - [🔄] create component for save/load // This is not a good idea as 
                                                it is tightly coupled to useClickerGame and doesn't take much space
    -------------
    ## 3. Core Functionality
    ## I-4 E-4 D-4
        - [❌] create more stable algorithm for passive income  
        - [✅] create more stable algorithm for double income PPS
    --------------
    ## 4. Store Toggle & Leaderboard panel (UI/UX)
    ## I-3 E-3 D-3
        - [✅] add isStoreOpen toggle state in useClickerHero
        - [✅] create Open store button
        - [🔄] add isLearderboardOpen toggle  // It's small enough, and fills some space 
        - [🔄] create sliding leaderboard panel (CSS transition) //It's small enough, and fills some space
        - [✅] ensure clean close and open behavior
    --------------
    ## 5. Leaderboard API & Data layer
    ## I-4 E-3 D-3
        - [✅] add relationship ClickerGame -> belongsTo(User)
        - [✅] create leaderboard() method in controller
        - [✅] make sql query to grab top 3 users based on high score
        - [✅] map username, score, prestige_level
        - [✅] add api route /leaderboard
        - [✅] create leaderboard component
        - [✅] fetch /leaderboard on mount and every 60 seconds
        - [✅] display ranked ordered list
    ----------------
---
# Epic: Production Architecture
    ## 1. Documentation
    ## I-3  E-2 D-4

        ### Tasks
        - [❌] Create `docs/ProductionArchitecture/production-architecture.md`
            - Server OS
            - Nginx structure
            - PHP-FPM model
            - SSL strategy
            - Deployment pipeline
            - Security layers (UFW, Fail2Ban)
        - [❌] Add architecture change log section

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
First I removed the Theme state declarations, imports, useState, to useTheme.ts hook
Next I added the hook correctly to my useClickerHero hook where it changes the theme
Then I worked on removing the store UI, but I had some trouble as the store needs game logic 
so I added a const game which takes in the useClickerGame hook and passes it as a prop to the StoreOverlay.tsx
There I can deconstruct and use it as a function to the StoreOverlay component
This worked but now I needed to make a bunch of additions to the store part to add a panel and slider
I made the root div position absolute so that my slider can find where to start the animation
Now that the store slides in and out of the game and looks good I verified that it still allows purchases
Ok now we can rework the UI a bit to give some breathing room
Now lets make a leaderboard by adding the leaderboard method to the game controller,
this will query the backend game table and grab the users who have the top scores in order and return it
via a /leaderboard json api on load() and every 40 seconds it will update the leaderboard, this way it doesn't 
conflict with the 30 second saving timer. I put all of the leaderboard state, vars, and UI inside the Leaderboard.tsx
component to keep it out of the main app UI. Also I added a saving Indicator with it's own component with isSaving state
that way I can setisSavingIndicator to true for on and set a timout timer for 5 seconds, that way I can add this indicator
when ever a save starts and time it out once the save is complete!
I started modifying the multiplier per click costs and implemented it, though there are some issues to fix later on.
See right now there is two implementations. I need to refactor the handle purchase methods so that they calculate the right amount per purchase. It shouldn't be that hard as I'm hardcoding the costs now, but I'm leaving that for the next sprint since it is friday!



 
 
 
 
 
 

