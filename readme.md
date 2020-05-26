# OW Laravel Challenge
#### Todo List
1. Basics
    - [x] Authentication
        - [x] Register __OK!__
        - [x] Login __OK!__
        - [x] Logoff __OK!__
        - [x] Update User Details
        - [x] Change Password
    - [x] Event
        - [x] Create
            - Title
            - Description
            - Start/End datetime
        - [x] Read
            - [X] Today Events
            - [X] Events Next 5 days
            - [x] All events(paginates)
        - [x] Update
2. [x] Files
    - [x] Export Events in CSV
        - id,title,description,start_date,end_date
    - [x] Import Events with CSV
3. [x] Invite Friends
    - [x] Link Generator
        - URL Link like Discord Invite
    - [x] Enter Event
        - User need an Account
4. Miscellaneous
    - [ ] Event List in the next 'x' days
    - [x] Create _partials/alerts.blade_
        - File to use as any alert to errors or success
    - [ ] UX
        - [ ] Add [jQuery validator](https://jqueryvalidation.org/) to all forms
            - [ ] Auth
                - [ ] Login
                - [ ] Register
                - [ ] Update Profile
                - [ ] Update Password
            - [ ] Events
                - [ ] Created
                - [ ] Update
                - [ ] Cancel
            - [ ] Invitation
                - [ ] Create
                - [ ] Expire
        - [x] [DataTable](https://datatables.net/)
            - [x] Events
            - [x] Invitation
#### Encountered Issues
1. ``SQLSTATE[42000]``
    - When executed:
        - > php artisan migrate
    - Shown:
        - ```[Illuminate\Database\QueryException]                                                                                                                  
           SQLSTATE[42000]: Syntax error or access violation: 1231 Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER' (SQL: select * from i  
           nformation_schema.tables where table_schema = owint and table_name = migrations)  ```
    - Fixed in _"config/database.php"_ adding:
        - ```php
            return [
                'mysql' => [
                    'modes'  => [
                              'ONLY_FULL_GROUP_BY',
                              'STRICT_TRANS_TABLES',
                              'NO_ZERO_IN_DATE',
                              'NO_ZERO_DATE',
                              'ERROR_FOR_DIVISION_BY_ZERO',
                              'NO_ENGINE_SUBSTITUTION',
                          ],
                  ]
              ];
          ```
2. DataTable
    - I'm using DataTable to help listing/searching for events/invitations
    - While trying to "hide/show" certain rows, for example
        - When selected "Events in the next 5 days", it should hide the other events
    - I thought and developed in a solution, using the jQuery functions ".hide()" and ".show()"
        - But it created a great problem, it doesn't "re-draw" and "re-paginate" the Table.
    - Possible Solution:
        - Create an API Route to return the Events data in json format.