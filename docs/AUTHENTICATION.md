# Authentication — plugging in your login & sign-up pages

The portal ships with a small, complete login system. **You don't have to build the auth logic** — you just point your own `login` and `sign-up` views at the routes that already exist.

This guide shows you how.

---

## What's already provided

| Piece | File | Does |
|-------|------|------|
| Auth controller | `app/Http/Controllers/AuthController.php` | login / register / logout |
| Gating | `app/Http/Controllers/Controller.php` | every portal controller requires a logged-in user |
| Routes | `routes/web.php` | `/login`, `/register`, `/logout`, `/dashboard` |
| Login accounts | `database/seeders/UserSeeder.php` | the demo users |
| Seeder command | `app/Console/Commands/SeedAuthUsers.php` | `php artisan portal:seed-auth` |
| Default pages | `resources/views/auth/login.blade.php`, `resources/views/auth/register.blade.php`, `resources/views/dashboard.blade.php` | working placeholders you can replace |

The whole portal is **protected**: visit any page while logged out and you're sent to `/login`. After signing in you land on `/dashboard`.

---

## Step 1 — create a login account

Run the command (no database edits needed):

```bash
php artisan portal:seed-auth
```

That seeds two demo accounts:

| Email | Password |
|-------|----------|
| `admin@uni.edu` | `password` |
| `student@uni.edu` | `password` |

Need a specific account? Pass an email + password:

```bash
php artisan portal:seed-auth ali@uni.edu secret123 --name="Ali"
```

(These accounts are also created automatically by `php artisan migrate:fresh --seed`.)

---

## Step 2 — plug in YOUR login page

The login form is rendered by `AuthController@showLogin`, which returns the view **`auth.login`**. So just put **your** page at:

```
resources/views/auth/login.blade.php
```

…replacing the placeholder that's there. Your form only has to follow this contract:

```blade
<form method="POST" action="{{ route('login') }}">
    @csrf

    {{-- field name MUST be "email" --}}
    <input type="email" name="email" value="{{ old('email') }}" required>

    {{-- field name MUST be "password" --}}
    <input type="password" name="password" required>

    {{-- optional "remember me" --}}
    <input type="checkbox" name="remember" value="1">

    <button type="submit">Sign in</button>
</form>

{{-- show the error after a failed attempt --}}
@error('email')
    <p>{{ $message }}</p>
@enderror
```

That's it — on success the user is redirected to `/dashboard`; on failure they come back with an error and their email pre-filled.

> Prefer your own view name (e.g. `signin`)? Just change the one line in `AuthController@showLogin`: `return view('auth.signin');`.

---

## Step 3 — plug in YOUR sign-up page

Same idea. The sign-up form is rendered by `AuthController@showRegister` → view **`auth.register`**. Put your page at:

```
resources/views/auth/register.blade.php
```

Contract:

```blade
<form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="text"     name="name"                  value="{{ old('name') }}"  required>
    <input type="email"    name="email"                 value="{{ old('email') }}" required>
    <input type="password" name="password"              required>

    {{-- the confirmation field name MUST be exactly "password_confirmation" --}}
    <input type="password" name="password_confirmation" required>

    <button type="submit">Sign up</button>
</form>
```

On success the account is created, the user is logged straight in, and sent to `/dashboard`.

---

## The contract at a glance

| Form | Method + action | Required field names |
|------|-----------------|----------------------|
| Login | `POST {{ route('login') }}` | `email`, `password` (optional `remember`) |
| Sign-up | `POST {{ route('register') }}` | `name`, `email`, `password`, `password_confirmation` |
| Logout | `POST {{ route('logout') }}` | — (just `@csrf`) |

Every form needs **`@csrf`** inside it. Validation errors come back in `$errors` (use `@error('field')`), and old input is available via `old('field')`.

---

## Logging out

Logout is a `POST` (so it can't be triggered by a stray link). Drop this wherever you want a logout button — for example in your `layouts/app.blade.php` nav:

```blade
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-secondary">Log out</button>
</form>
```

You can show who's signed in with `{{ auth()->user()->name }}`.

---

## How the gating works

Every controller extends `app/Http/Controllers/Controller.php`, which attaches the `auth` middleware to all of them:

```php
abstract class Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }
}
```

So all your CRUD pages require login automatically. `AuthController` overrides this with `return []` so the login/sign-up pages stay public.

**Want a page to be public?** Add the same override to that controller:

```php
public static function middleware(): array
{
    return []; // this controller is open to guests
}
```

---

## Changing where users land after login

After login/registration the user goes to `route('dashboard')`. To send them somewhere else, change the redirect in `AuthController` (`redirect()->intended(route('dashboard'))`) to your route, e.g. `route('students.index')`.

---

## Forked before auth existed?

If your fork doesn't have these files yet, the login system is just these pieces — copy them in (or merge the latest starter):

```
app/Http/Controllers/AuthController.php
app/Http/Controllers/Controller.php          (adds the auth gating)
app/Console/Commands/SeedAuthUsers.php
database/seeders/UserSeeder.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/dashboard.blade.php
routes/web.php                                (the /login, /register, /logout, /dashboard routes)
```

Then run `php artisan portal:seed-auth` and you're ready to sign in.
