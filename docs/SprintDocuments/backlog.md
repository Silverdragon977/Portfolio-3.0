Reading the Backlog Easily:

    Levels of Complexity:
        Epic
          ├── Feature
          │     ├── User Story
          │     │      ├── Tasks
    Categorizing Format:
        I-x is Importance/Value
        E-x is Effort/Complexity
        Eg. I-2 E-5
        1 = lowest and 5 = highest




# Product Backlog

> This document tracks high-level engineering initiatives and product enhancements.
> Items are grouped by Epic and ordered by priority.
> Sprint-level breakdowns are maintained separately.

-----------------------------------------------------------------------------------------------

# EPIC: Engineering Infrastructure
   
    ## 2. Deployment Hardening
    ## I-4  E-3

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
    ## I-3  E-2 
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
    ## I-4  E-4
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
## I-3  E-5
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
    ## I-2  E-3

        - [ ] Add saving animation feedback
        - [ ] Add store background customization
        - [ ] Add player frame customization
        - [ ] Add prestige emblems
        - [ ] Improve mobile layout polish

        ---

-------------------------------------------------------------------

# 🟣 EPIC: Quality & Testing
    ## I-5  E-3
    ### Goals
    Improve code confidence and prevent regressions.

    ### Tasks
        - [ ] Add feature tests for API routes
        - [ ] Add database migration tests
        - [ ] Add frontend TypeScript strict validation checks
        - [ ] Introduce test coverage reporting

        ---

    
--------------------------------------------------------------------

# ⚪ EPIC: Performance Optimization
## I-3  E-4

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
        - [ ] Leaderboards
        - [ ] Achievements system
        - [ ] Offline progress calculation
        - [ ] Animation polish
        - [ ] Sound effects
        - [ ] Multi-save slots
        - [ ] Add click rate limiting (anti-cheat)