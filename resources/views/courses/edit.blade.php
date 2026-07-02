{{--
    YOUR TASK (W10):  form to edit an existing course.

    The controller passes in:
        $course             — an App\DTOs\CourseDTO (getters listed in courses/index)
        $departmentOptions  — an array of [id => name]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('courses.update', $course->getId()) }}"

    Pre-fill each input from the DTO and pre-select the current department
    ($course->getDepartmentId()).

    Validated fields:  title, course_code, credit_hours, department_id

    TODO: build the form here.
--}}
@extends('layouts.app')

@section('content')
<x-card title="Edit Course">

    <form action="{{ route('courses.update', $course->getId()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="field-label">
                <i class="bi bi-hash me-1"></i> Course ID
            </label>
            <div class="id-preview-field">
                <span class="id-preview-number">#{{ $course->getId() }}</span>
                <span class="id-readonly-badge">Read-only</span>
            </div>
        </div>

        <x-form
            name="title"
            label="Course Name"
            :value="$course->getTitle()"
        />

        <x-form
            name="course_code"
            label="Course Code"
            :value="$course->getCourseCode()"
            required
        />

        <x-form
            name="credit_hours"
            label="Credit Hours"
            type="number"
            :value="$course->getCreditHours()"
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
                    <option value="{{ $id }}" {{ old('department_id', $course->getDepartmentId()) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <x-button type="submit" color="primary">Update</x-button>
            <x-button href="/courses" color="secondary">Cancel</x-button>
        </div>

    </form>

</x-card>
@endsection