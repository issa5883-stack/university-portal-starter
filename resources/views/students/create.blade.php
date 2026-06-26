{{--
    YOUR TASK (W10):  form to create a new student.

    The controller passes in:
        $departmentOptions  — an array of  [id => name]  for a dropdown

    Submit with:
        method="POST"  action="{{ route('students.store') }}"  @csrf

    Validated fields (use these as input name=""):
        name            (required)
        email           (required, must be an email)
        student_number  (optional)
        department_id   (optional)

    For department_id, build a <select> by looping $departmentOptions:
        @foreach ($departmentOptions as $id => $name) ... @endforeach

    TODO: build the form here.
--}}

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<x-card title="Add New Student">

    <form method="POST" action="{{ route('students.store') }}">

        @csrf

        <x-form
            name="name"
            label="Student Name"
            required
        />

        <x-form
            name="email"
            label="Email"
            type="email"
            required
        />

        <x-form
            name="student_number"
            label="Student Number"
        />

        <div class="mb-3">
            <label class="form-label">Department</label>

            <select name="department_id" class="form-control">

                <option value="">Select Department</option>

                @foreach ($departmentOptions as $id => $name)
                    <option value="{{ $id }}">
                        {{ $name }}
                    </option>
                @endforeach

            </select>

        </div>

        <x-button type="submit">
            Save Student
        </x-button>

    </form>

</x-card>
@endsection