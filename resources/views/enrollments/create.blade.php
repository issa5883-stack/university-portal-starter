@extends('layouts.app')
@section('title', 'Add Enrollment')
@section('content')

    <x-card title="Enroll a Student">

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            {{-- Student Search --}}
            <div class="mb-3">
                <label for="student_search" class="field-label">Student</label>
                <input type="text" id="student_search" list="studentList" autocomplete="off"
                       class="form-control rounded-3 border-0 shadow-sm @error('student_id') is-invalid @enderror"
                       placeholder="Type a student name..."
                       value="{{ $studentOptions[old('student_id')] ?? '' }}">
                <datalist id="studentList">
                    @foreach($studentOptions as $id => $name)
                        <option data-id="{{ $id }}" value="{{ $name }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="student_id" id="student_id" value="{{ old('student_id') }}">
                @error('student_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Course Search --}}
            <div class="mb-3">
                <label for="course_search" class="field-label">Course</label>
                <input type="text" id="course_search" list="courseList" autocomplete="off"
                       class="form-control rounded-3 border-0 shadow-sm @error('course_id') is-invalid @enderror"
                       placeholder="Type a course name or code..."
                       value="{{ $courseOptions[old('course_id')] ?? '' }}">
                <datalist id="courseList">
                    @foreach($courseOptions as $id => $title)
                        <option data-id="{{ $id }}" value="{{ $title }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="course_id" id="course_id" value="{{ old('course_id') }}">
                @error('course_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Grade Input --}}
            <x-form
                name="grade"
                label="Grade (Optional)"
                placeholder="e.g. A, B+, 90"
            />

            <div class="d-flex gap-2">
                <x-save />
                <x-button :href="route('enrollments.index')" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            bindSearchableSelect('student_search', 'student_id', 'studentList');
            bindSearchableSelect('course_search', 'course_id', 'courseList');
        });
    </script>

@endsection
