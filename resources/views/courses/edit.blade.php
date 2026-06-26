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

        <div class="d-flex gap-2">
            <x-button type="submit" color="primary">Update</x-button>
            <x-button href="/courses" color="secondary">Cancel</x-button>
        </div>

    </form>

</x-card>
@endsection