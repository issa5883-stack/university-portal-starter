{{--
    ============================================================
    YOUR TASK (W13 — Blade Layouts):  build the master layout
    ============================================================

    Every page in the portal will @extends('layouts.app'). This file holds
    the shared "chrome" that should appear on every screen.

    Build a complete HTML document that includes:
      - <!DOCTYPE html>, <head> (with a <title>) and <body>
      - a header / navigation bar with a link to each module, e.g.
            <a href="{{ route('departments.index') }}">Departments</a>
            ...students.index, courses.index, professors.index, enrollments.index
      - the page content placeholder:
            @yield('content')
      - (optional) a footer
      - (optional) show the flash message after a save:
            @if (session('success')) ... {{ session('success') }} ... @endif

    A ready-made stylesheet is provided if you want styling for free — link
    it inside <head>:
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    Once this layout exists, each module view will look like:
            @extends('layouts.app')
            @section('content')
                ... page content ...
            @endsection

    TODO: build the layout here.
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'University Portal')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

{{-- ── Navbar ── --}}
@if(!request()->is('login') && !request()->is('register'))
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <span class="brand-icon"><i class="bi bi-hexagon-fill"></i></span>
            University Portal
        </a>
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-2 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('departments*') ? 'active' : '' }}" href="/departments">
                        <i class="bi bi-building me-1"></i> Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="/students">
                        <i class="bi bi-people me-1"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('courses*') ? 'active' : '' }}" href="/courses">
                        <i class="bi bi-book me-1"></i> Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('professors*') ? 'active' : '' }}" href="/professors">
                         <i class="bi bi-person-badge me-1"></i> Professors
                    </a>
                        </li>
                
                {{-- Profile Dropdown Menu in Navbar --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('profile*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i> Profile
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif

{{-- ── Main Content ── --}}
<main class="@yield('main_class', 'container my-4')" style="flex:1">
    @yield('content')
</main>

{{-- ── Footer ── --}}
@if(!request()->is('login') && !request()->is('register'))
<footer class="portal-footer">
    <div class="container">
        <div class="footer-inner">

            {{-- Brand --}}
            <div class="footer-brand">
                <div class="footer-logo">
                    <i class="bi bi-hexagon-fill footer-hex"></i>
                    <i class="bi bi-mortarboard-fill footer-cap"></i>
                </div>
                <div class="footer-brand-text">
                    <span class="footer-name">University Portal</span>
                    <p class="footer-tagline">Academic Management System</p>
                </div>
            </div>

            {{-- Team --}}
            <div class="footer-team">
                <p class="footer-section-title">Development Team</p>
                <div class="team-list">
                    <div class="team-member">
                        <div class="member-avatar">S</div>
                        <span>Saja</span>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">I</div>
                        <span>Issa</span>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">A</div>
                        <span>Asmaa</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="footer-bottom">
            <span class="footer-copy">
                &copy; {{ date('Y') }} University Portal. All rights reserved.
            </span>
            <a href="https://github.com/issa5883-stack/University-Portal"
               target="_blank" class="footer-github">
                <i class="bi bi-github me-1"></i> View on GitHub
            </a>
        </div>
    </div>
</footer>
@endif

{{-- ── Scripts ── --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>