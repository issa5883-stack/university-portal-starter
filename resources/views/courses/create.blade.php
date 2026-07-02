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
                name="title"
                label="Course Name"
                placeholder="e.g. Web Development"
            />

            <x-form
                name="course_code"
                label="Course Code"
                placeholder="e.g. CS305"
                required
            />

            <x-form
                name="credit_hours"
                label="Credit Hours"
                type="number"
                value="3"
                placeholder="1-12"
                min="1"
                max="12"
                required
            />

            {{-- Department Dropdown --}}
            <div class="mb-3">
                <label for="department_id" class="field-label">Department</label>
                <select name="department_id" id="department_id" class="form-control rounded-3 border-0 shadow-sm @error('department_id') is-invalid @enderror">
                    <option value="">— No Department —</option>
                    @foreach($departmentOptions as $id => $name)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Save</x-button>
                <x-button href="/courses" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection
