
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# auth-laravel10-1

Role based authentication system where we can give the user permission according to his role.

### Instructions

- create a role in databases through migration
- set a default role as a user when sign up
- create a function in User modal who can check the roles 
    - ex : 
```php
    public function hasRole($role){
        return ($this->role === $role) ? true:false;
    }
```

### Learning Outcome

- Auth::login($user);  => for login
- Auth::logout($user); => for logout
- auth()->user()->name => to get the currently logged in user
- Auth->user()->name => to get the currently logged in user
- guest middleware for allow routes for not logged in users only
- auth middleware for allow routes for logged in users only
- Auth::check() => to check user is logged in or not
- session()->has('variable'); => to check the value exist in session or not :: normally an error/success message
- session('variable') => to get the value
- Hash::make($variable) => to hash the password
- Hash::check($plainPassword , $dbHashPassword); => to check the password

