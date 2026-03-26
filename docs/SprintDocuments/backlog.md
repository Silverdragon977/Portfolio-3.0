Reading the Backlog Easily:

    Levels of Complexity:
        Epic
          ├── Feature
          │     ├── User Story
          │     │      ├── Tasks
    Categorizing Format:
        I-x is Importance/Value
        E-x is Effort/Complexity
        D-x is Difficulty
        Eg. I-2 E-5 D-5
        1 = lowest and 5 = highest




# Product Backlog

> This document tracks high-level engineering initiatives and product enhancements.
> Items are grouped by Epic and ordered by priority.
> Sprint-level breakdowns are maintained separately.

-----------------------------------------------------------------------------------------------

# EPIC: Engineering Infrastructure
   
    ## 2. Deployment Hardening
    ## I-4  E-3 D-3

        ### Goals
        Increase production safety and rollback reliability.

        ### Tasks
        - [ ] Update deployment script to fail on error (`set -e`)
        - [ ] Add build verification step
        - [ ] Add automatic backup before deploy
        - [ ] Implement rollback mechanism
        - [ ] Add deployment logging

        ---
--------------------------------------------------------------------------------

# 🟡 EPIC: Production Architecture
    ## 1. Documentation
    ## I-3  E-2 D-4
        ### Goals
        Improve maintainability and future-proof infrastructure decisions.

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

    ## 2. Configuration Cleanup
    ## I-4  E-4 D-4
        ### Goals
        Reduce complexity and remove fragile manual setup.

        ### Tasks
        - [ ] Standardize Nginx server block template
        - [ ] Remove deprecated directives (e.g., http2 misconfig)
        - [ ] Remove duplicate or unused configs
        - [ ] Ensure consistent PHP-FPM socket configuration

        ---
---------------------------------------------------------------------

# 🟢 EPIC: Containerization (Future)
## I-3  E-5 D-4
    ### Goals
    Make environment portable and reproducible.

    ### Tasks
    - [ ] Decouple app from Valet-specific assumptions
    - [ ] Create Dockerfile for Laravel + PHP-FPM
    - [ ] Create docker-compose.yml
    - [ ] Document container architecture
    - [ ] Evaluate CI container builds

    ---
---------------------------------------------------------------

# 🔵 EPIC: Clicker Hero – Core Systems
## I-4  E-4
    ## 1. UI/UX Improvements
    ## I-3  E-3 D-2

        - [ ] Move the Store and Leaderboard buttons to a task bar for navigation at the bottom
        - [ ] Bring the themes and backgrounds into the store
        - [ ] Make store grids that scroll to view store cards with space for titles
        - [ ] Inside the store cards design a preview for the backgrounds and frames
        - [ ] Change theme changer using select to styled div
        - [ ] Add separation for different ranks of backgrounds and frames
        - [ ] Common backgrounds have mono colors, rare use 2 color gradients, 
                 ultra rare use 3+ gradients and static effects, legendary is ultra rare with animations 
        - [ ] 

        ---
    ## 2. Refactor for Simplicity
    ## I-4 E-4 D-3
        - [ ] 
        - [ ] create component for save/load // Optional

    ## 3. Core Functionality
    ## I-4 E-4 D-4
        - [ ] create more stable algorithm for passive income (no implementation yet) 
        - [ ] create more stable algorithm for double income PPS (no implementation yet) 
        - [ ] Add columns in the clickergame table safely to add bought frames and bought backgrounds
        - [ ] On purchase of Background or Frame add it to the table 
        - [ ] on the buyBackground and buyFrame method add functionality to check the bought themes and 
            if the item is already bought then reduce the price to 0  
    ## 4. Store Toggle & Leaderboard panel (UI/UX)
    ## I-3 E-3 D-3
        - [ ] add isStoreOpen toggle state in useClickerHero
        - [ ] create Open store button
        - [ ] add isLearderboardOpen toggle 
        - [ ] create sliding leaderboard panel (CSS transition)
        - [ ] ensure clean close and open behavior
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
    ## 6. Themes and backgrounds in the Store
        - [ ] In useClickerGame.ts add method for changing theme background and frames called buyBackground and buyFrame
        - [ ] 

-------------------------------------------------------------------

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

        ---

    
--------------------------------------------------------------------

# ⚪ EPIC: Performance Optimization
## I-3  E-4 D-5

    ### Goals
    Prepare application for scalability.

    ### Tasks
        - [ ] Optimize auto-save frequency logic
        - [ ] Debounce API save calls
        - [ ] Evaluate caching strategies
        - [ ] Investigate offline earnings calculation model

        ---

# ⚫ EPIC: Future Product Expansion
## I-2  E-4
    ### Backlog Ideas
        - [ ] Achievements system
        - [ ] Offline progress calculation
        - [ ] Animation polish
        - [ ] Sound effects
        - [ ] Multi-save slots
        - [ ] Add click rate limiting (anti-cheat)