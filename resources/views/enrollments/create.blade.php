@extends('layouts.app')
@section('title', 'Add Enrollment')
@section('content')

    <x-card title="Enroll a Student">

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            {{-- Student Dropdown --}}
            <div class="mb-3">
                <label for="student_id" class="field-label">Student</label>
                <select name="student_id" id="student_id" class="form-control rounded-3 border-0 shadow-sm @error('student_id') is-invalid @enderror">
                    <option value="">— Select Student —</option>
                    @foreach($studentOptions as $id => $name)
                        <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Course Dropdown --}}
            <div class="mb-3">
                <label for="course_id" class="field-label">Course</label>
                <select name="course_id" id="course_id" class="form-control rounded-3 border-0 shadow-sm @error('course_id') is-invalid @enderror">
                    <option value="">— Select Course —</option>
                    @foreach($courseOptions as $id => $title)
                        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
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

@endsection
