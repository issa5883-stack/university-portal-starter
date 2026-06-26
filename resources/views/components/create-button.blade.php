@props(['href'])

<a href="{{ $href }}" class="btn-add">
    <i class="bi bi-plus-lg me-1"></i> {{ $slot ?: 'Add New' }}
</a>
