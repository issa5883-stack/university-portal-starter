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
