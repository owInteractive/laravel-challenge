# OW Laravel Challenge
#### Todo List
1. Basics
    - [x] Authentication
        - [x] Register __OK!__
        - [x] Login __OK!__
        - [x] Logoff __OK!__
        - [x] Update User Details
        - [x] Change Password
    - [ ] Event
        - [x] Create
            - Title
            - Description
            - Start/End datetime
        - [ ] Read
            - [ ] Today Events
            - [ ] Events Next 5 days
            - [ ] All events(paginates)
        - [ ] Update
2. Files
    - [ ] Export Events in CSV
        - |title|description|start_datetime|end_datetime|
    - [ ] Import Events with CSV
3. Invite Friends
    - [ ] Link Generator
        - URL Link like Discord Invite
    - [ ] User Access
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
        - [ ] [DataTable](https://datatables.net/)
            - [ ] Events
            - [ ] Invitation
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