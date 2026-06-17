{{--
    YOUR TASK (W10):  form to create a new department.

    Submit the form with:
        method="POST"
        action="{{ route('departments.store') }}"
        @csrf

    The controller validates these fields (use them as the input name=""):
        name   (required)

    TODO: build the form here.
--}}
@extends('layouts.app')

@section('title', 'Add Department')

@section('content')

    @php
        $nextId = (\Illuminate\Support\Facades\DB::table('departments')->max('id') ?? 0) + 1;
    @endphp

    <x-card title="Add New Department">

        <form action="{{ route('departments.store') }}" method="POST">            @csrf

            {{-- Department ID preview --}}
            <div class="mb-3">
                <label class="field-label">
                    <i class="bi bi-hash me-1"></i> Department ID
                </label>
                <div class="id-preview-field">
                    <span class="id-preview-number">#{{ $nextId }}</span>
                    <span class="id-auto-badge">Auto-assigned</span>
                </div>
            </div>

            <x-form
                name="name"
                label="Department Name"
                placeholder="e.g. Computer Science"
            />

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Save</x-button>
                <x-button href="/departments" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection