@extends('layouts.app')
@section('title', 'Create Account')
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
            <p class="login-left-desc">Join the portal to manage departments, students, and courses.</p>
        </div>
        <p class="login-left-copy">&copy; {{ date('Y') }} University Portal</p>
    </div>

    {{-- ── Right Panel ── --}}
    <div class="login-right">
        <div class="login-form-wrap">

            <div class="mb-4">
                <h4 class="login-title">Create Account</h4>
                <p class="login-sub">Fill in your details to get started</p>
            </div>

            @if($errors->any())
                <div class="alert-error mb-3">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/register" id="registerForm">
                @csrf

                {{-- Name --}}
                <div class="field-group mb-3">
                    <label class="field-label">
                        <i class="bi bi-person me-1"></i> Full Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="field-input @error('name') is-error @enderror"
                        placeholder="John Smith"
                        value="{{ old('name') }}"
                        autofocus
                    >
                </div>

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
                            placeholder="Min. 8 characters"
                        >
                        <button type="button" class="eye-btn" onclick="togglePassword('passwordField','eyeIcon1')">
                            <i class="bi bi-eye" id="eyeIcon1"></i>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="field-group mb-4">
                    <label class="field-label">
                        <i class="bi bi-lock-fill me-1"></i> Confirm Password
                    </label>
                    <div class="input-eye-wrap">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="confirmField"
                            class="field-input"
                            placeholder="Repeat your password"
                        >
                        <button type="button" class="eye-btn" onclick="togglePassword('confirmField','eyeIcon2')">
                            <i class="bi bi-eye" id="eyeIcon2"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="registerBtn">
                    <span class="btn-login-text">
                        <i class="bi bi-person-plus me-2"></i> Create Account
                    </span>
                    <span class="btn-login-loading d-none">
                        <span class="spinner-border spinner-border-sm me-2"></span> Creating account...
                    </span>
                </button>

                {{-- Login Link --}}
                <p class="text-center mt-3" style="font-size:0.85rem; color:#7a8ca0;">
                    Already have an account?
                    <a href="/login" style="color:var(--primary-light); font-weight:600; text-decoration:none;">Sign in</a>
                </p>

            </form>
        </div>
    </div>

</div>

<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);
    field.type = field.type === 'password' ? 'text' : 'password';
    icon.className = field.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}

document.getElementById('registerForm').addEventListener('submit', function () {
    const btn = document.getElementById('registerBtn');
    btn.querySelector('.btn-login-text').classList.add('d-none');
    btn.querySelector('.btn-login-loading').classList.remove('d-none');
    btn.disabled = true;
});
</script>

@endsection
