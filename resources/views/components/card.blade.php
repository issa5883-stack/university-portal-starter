{{--
    YOUR TASK (W14 — Blade Components):  build the <x-card> component.

    A simple panel used to wrap tables and forms:
        <x-card>
            ... content ...
        </x-card>

    Suggested prop: title (optional) — show a header bar when it is provided.
    Render the body with {{ $slot }}.

    Provided CSS classes: .card, .card-header, .card-body

    TODO: build the component here.
--}}
@props(['title' => ''])

<div class="page-card">
    @if($title)
        <div class="page-card-header">
            <h5>
                <i class="bi bi-building me-2"></i>{{ $title }}
            </h5>
        </div>
    @endif
    <div class="page-card-body">
        {{ $slot }}
    </div>
</div>