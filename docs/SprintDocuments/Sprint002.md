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
- [✅]   add buttons to mass buy click upgrades with 1x, 5x, and 10x 
- []   add store background colors
- []   add prestige system
- []   add frames to customize the player in store
- [✅]   on the admin panel add users scores to the table
- [✅]   create a reset button on the adminpanel to reset a users progress in click hero

### Backend (Laravel)
- [] add prestige score to games table
- [] add background color choice to the backend
- [] add frame choice to the backend
    ## 1. Continuous Integration (CI)
       ## I-5  E-3
   
           ### Goals
           Introduce automated validation to simulate professional team workflow and prevent regressions.
   
           ### Tasks
           - [✅] Add PHPUnit tests for ClickerHeroController
           - [✅] Add validation tests for score updates
           - [✅] Add tests for updateOrCreate persistence logic
           - [✅] Configure GitHub Actions workflow:
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
    Started working on the CI parts
    Needed to refactor the ClickHero url to comply with unit testing in CI
      All namedroutes are left alone only the raw url is changed to /clickhero
    I setup route testing for both guests and an auth user in FeatureTests
    Next I modified the following files to add the new columns to the data model (prestige_level, background_color, frame_choice):
        added columns to the Model, added columns to Pest Tests, added columns to the controller, created a new migration on existing table like this:
        php artisan make:migration add_game_fields_to_click_hero_table --table=clicker_games
    There were some errors with the ClickerHeroTest.php Pest tests like linking wrong table and AssertingJson structure with specific values instead of just
        verifying the columns exist and can load/save
    All 38 tests pass now it is time to use these new state variables in the React UI
    Refactored the UI elements from h1 tags to div tags and added scss to the ui elements for more ui style control
    Rearranged the UI elements for better clarity
    Added bulk purchase triple button for passive income
    Pulled the logic out of the ui button into a handlePassiveClick method
    In the new method I call the new getBulkPassiveCost() which calls the getPassiveIncomeCost() multiple times and adds it up to get the bulk cost
    Then I used this to update and display the new costs to the purchase button based on the bulk button pushed
    Before I can try this out I need to make a reset score button in admin panel as the costs are a bit too much in mid game - To be fixed in future
    Adding new route to web.php so that admin can push a button to view the users stats at 'admin.users.games.clicker'
    Added a reset stats button for the clicker game in the new adminCLickerStats blade per user
    Debugging the bulk purchase passive income
    Now it's time to do the same with the double points
    For testing I added a 100k dev button to increase my score by 100k
    Both PassiveIncome and DoubleIncome are working as intended, in some other sprint I really need to find a way mathematically to make it doable to finish
        one run in about 1 hour or so, that way there is a challenge but it doesn't take way too long! Each prestige should unlock a "new currency" but under the hood it should run the same. This game isn't to be super complex infact 1 hr game loop might be way too long!
    