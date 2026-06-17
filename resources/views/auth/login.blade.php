@extends('layouts.app')
@section('title', 'Login')
@section('main_class', 'p-0')
@section('content')

<div class="login-split">

    {{-- ── Left Panel ── --}}
    <div class="login-left">
        <div class="login-hex-bg">
            <i class="bi bi-hexagon lhb lhb-1"></i>
            <i class="bi bi-hexagon lhb lhb-2"></i>
            <i class="bi bi-hexagon lhb lhb-3"></i>
            <i class="bi bi-hexagon lhb lhb-4"></i>
        </div>
        <div class="login-left-content">
            <div class="login-icon-wrap mb-4">
                <i class="bi bi-hexagon-fill login-hex"></i>
                <i class="bi bi-mortarboard-fill login-cap"></i>
            </div>
            <h2 class="login-left-title">University Portal</h2>
            <p class="login-left-sub">Academic Management System</p>
            <div class="login-left-divider"></div>
            <p class="login-left-desc">Manage departments, students, and courses — all in one place.</p>
        </div>
        <p class="login-left-copy">&copy; {{ date('Y') }} University Portal</p>
    </div>

    {{-- ── Right Panel ── --}}
    <div class="login-right">
        <div class="login-form-wrap">

            <div class="mb-4">
                <h4 class="login-title">Welcome Back</h4>
                <p class="login-sub">Sign in to continue</p>
            </div>

            @if($errors->any())
                <div class="alert-error mb-3">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="field-group mb-3">
                    <label class="field-label">
                        <i class="bi bi-envelope me-1"></i> Email Address
                    </label>
                    <input
                        type="email"
                        name="email"
                        class="field-input @error('email') is-error @enderror"
                        placeholder="you@university.edu"
                        value="{{ old('email') }}"
                        autofocus
                    >
                </div>

                {{-- Password --}}
                <div class="field-group mb-3">
                    <label class="field-label">
                        <i class="bi bi-lock me-1"></i> Password
                    </label>
                    <div class="input-eye-wrap">
                        <input
                            type="password"
                            name="password"
                            id="passwordField"
                            class="field-input @error('password') is-error @enderror"
                            placeholder="••••••••"
                        >
                        <button type="button" class="eye-btn" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="remember-row mb-4">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-check">
                        <span>Remember me</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-login-text">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                    </span>
                    <span class="btn-login-loading d-none">
                        <span class="spinner-border spinner-border-sm me-2"></span> Signing in...
                    </span>
                </button>

                <p class="text-center mt-3" style="font-size:0.85rem; color:#7a8ca0;">
                    Don't have an account?
                    <a href="/register" style="color:var(--primary-light); font-weight:600; text-decoration:none;">Create one</a>
                </p>

            </form>
        </div>
    </div>

</div>

<script>
function togglePassword() {
    const field = document.getElementById('passwordField');
    const icon  = document.getElementById('eyeIcon');
    field.type = field.type === 'password' ? 'text' : 'password';
    icon.className = field.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}

document.getElementById('loginForm').addEventListener('submit', function () {
    const btn = document.getElementById('loginBtn');
    btn.querySelector('.btn-login-text').classList.add('d-none');
    btn.querySelector('.btn-login-loading').classList.remove('d-none');
    btn.disabled = true;
});
</script>

@endsection
