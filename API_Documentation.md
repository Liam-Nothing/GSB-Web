# API Documentation for GSB Project (gsb.best)

## 1. How to select API function
To select API function you need to target `\app\api\api.php` with a POST request with json format. Use `api` like key and the case you want like value exemple `user_open_session` if you want to open a session. In this API user can have 4 type of right is Admin, Admin_Region, Comptable and User. Some fuctions need a special right to be call.

## 2. What is inside the PHP session
Inside we have 3 elements the `id` of the user a int, `username` a string and `id_role`. `id _role` mean the right level like admin or user, is compose by one int bettween `0-3`.

## 3. What is the functions of API

  - What arguments expectation: key, value type, min leght, max lenght
  Exemple : `{"username"="test"}`
  - What return expectation: id , message
  Exemple : `{"id":2,"message":"Empty client data"}`
  - id can have 3 value :
    - `0` : None (Error)
    - `1` : Success
    - `2` : Error

### - User management
- user_open_session
  - Who can call : Everyone
  - What arguments : 
    - username, string, 3, 50
  - What that do : 
  - Return what : thaht open a PHP session with id, username and id_role inside it
    - for success :
      - `{"id":1,"message":"Good password"}`
    - for error :
      - `{"id":2,"message":"Bad password"}`
      - `{"id":2,"message":"Bad user"}`
      - `{"id":2,"message":"Error!"}`
- user_lougout_session
- user_logged_session
- user_logged_session
- admin_create_user
- admin_update_user
- admin_delete_user
- admin_password_reset
### - Standard feesheets management
- admin_add_standard_fees
- user_get_standard_fees
- admin_remove_standard_fees
### - Feesheets management
- user_view_all_feesheets
- admin_view_all_feesheets
- user_add_feesheets
- admin_search_feesheets
- admin_view_one_feesheet
- admin_update_feesheets
- admin_update_feesheets_state
- admin_delete_feesheets