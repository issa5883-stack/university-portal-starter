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

<x-card title="Add New Student">

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <x-form name="name" label="Student Name" placeholder="Enter student name" />
        <x-form name="email" label="Email" type="email" placeholder="Enter email" />
        <x-form name="student_number" label="Student Number" placeholder="Optional" />

        <div class="mb-3">
            <label class="field-label">Department</label>

            <select name="department_id" class="form-control">

                <option value="">Select Department</option>

                @foreach ($departmentOptions as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach

            </select>
        </div>

        <div class="d-flex gap-2">
            <x-save />
            <x-button href="{{ route('students.index') }}" color="secondary">
                Cancel
            </x-button>
        </div>

    </form>

</x-card>

@endsection