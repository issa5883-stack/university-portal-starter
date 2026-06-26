{{--
    YOUR TASK (W10 + W13):  list every student.

    The controller passes in:
        $students  — an array of App\DTOs\StudentDTO

    Each StudentDTO gives you:
        getId(), getName(), getEmail(), getStudentNumber(),
        getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach), with for each row:
        - an "Edit" link    -> route('students.edit', $student->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('students.destroy', $student->getId())
    Plus a "New Student" link -> route('students.create').

    Tip: getDepartmentName() may be null if the student has no department.

    TODO: build the view here.
--}}

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<x-card title="Students List">

    <div class="mb-3">
        <x-button :href="route('students.create')">
            + New Student
        </x-button>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Student Number</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach ($students as $student)

            <tr>

                <td>{{ $student->getName() }}</td>
                <td>{{ $student->getEmail() }}</td>
                <td>{{ $student->getStudentNumber() }}</td>
                <td>{{ $student->getDepartmentName() ?? 'No Department' }}</td>

                <td>

                    <x-button
                        color="warning"
                        :href="route('students.edit', $student->getId())"
                    >
                        Edit
                    </x-button>

                    <form
                        method="POST"
                        action="{{ route('students.destroy', $student->getId()) }}"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <x-button color="danger" type="submit">
                            Delete
                        </x-button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</x-card>
@endsection