# TODO - PropertyController User ID Authorization

## Task
Correct PropertyController functions according to user_id which is logged in user

## Plan
- [x] Add authorization check in `update()` function - to ensure regular users can only update their own properties
- [x] Add authorization check in `destroy()` function - to ensure regular users can only delete their own properties

## Completed
- [x] Analyzed current implementation
- [x] Created plan and got user confirmation
- [x] Added authorization check in `update()` function
- [x] Added authorization check in `destroy()` function
