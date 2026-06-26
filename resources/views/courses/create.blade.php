{{--
    YOUR TASK (W10):  form to create a new course.

    The controller passes in:
        $departmentOptions  — an array of [id => name] for a dropdown

    Submit with:
        method="POST"  action="{{ route('courses.store') }}"  @csrf

    Validated fields (use these as input name=""):
        title         (required)
        course_code   (required)
        credit_hours  (required, a whole number between 1 and 12)
        department_id (optional)

    TODO: build the form here.
--}}
@extends('layouts.app')

@section('title', 'Add Course')

@section('content')

    @php
        $nextId = (\Illuminate\Support\Facades\DB::table('courses')->max('id') ?? 0) + 1;
    @endphp

    <x-card title="Add New Course">

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            {{-- Course ID preview --}}
            <div class="mb-3">
                <label class="field-label">
                    <i class="bi bi-hash me-1"></i> Course ID
                </label>
                <div class="id-preview-field">
                    <span class="id-preview-number">#{{ $nextId }}</span>
                    <span class="id-auto-badge">Auto-assigned</span>
                </div>
            </div>

            <x-form 
                name="name"
                label="Course Name"
                placeholder="e.g. Web Development"
            />

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Save</x-button>
                <x-button href="/courses" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection
