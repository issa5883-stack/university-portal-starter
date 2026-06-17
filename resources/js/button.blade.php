@props([
    'href'    => null,
    'color'   => 'primary',
    'type'    => 'button',
])

@php
$classes = match($color) {
    'success' => 'btn-add',
    'warning' => 'btn-edit',
    'danger'  => 'btn-delete',
    default   => 'btn-add',
};
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" {{ $attributes }}>{{ $slot }}</button>
@endif