{{--
    YOUR TASK (W10):  form to edit an existing student.

    The controller passes in:
        $student            — an App\DTOs\StudentDTO (getters listed in students/index)
        $departmentOptions  — an array of [id => name]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('students.update', $student->getId()) }}"

    Pre-fill each input from the DTO (e.g. :value="$student->getName()") and
    pre-select the student's current department ($student->getDepartmentId()).

    Validated fields:  name, email, student_number, department_id

    TODO: build the form here.
--}}


@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<x-card title="Edit Student">

    <form method="POST" action="{{ route('students.update', $student->getId()) }}">

        @csrf
        @method('PUT')

        <x-form
            name="name"
            label="Student Name"
            :value="$student->getName()"
            required
        />

        <x-form
            name="email"
            label="Email"
            type="email"
            :value="$student->getEmail()"
            required
        />

        <x-form
            name="student_number"
            label="Student Number"
            :value="$student->getStudentNumber()"
        />

        <div class="mb-3">

            <label class="form-label">Department</label>

            <select name="department_id" class="form-control">

                <option value="">Select Department</option>

                @foreach ($departmentOptions as $id => $name)

                    <option value="{{ $id }}"
                        @if ($student->getDepartmentId() == $id) selected @endif
                    >
                        {{ $name }}
                    </option>

                @endforeach

            </select>

        </div>

        <x-button type="submit">
            Update Student
        </x-button>

    </form>

</x-card>
@endsection