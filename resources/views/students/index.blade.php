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

<x-card title="Students List">

    <div class="mb-3">
        <x-create-button :href="route('students.create')" />
    </div>

    <table class="table portal-table mb-0">
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

        @forelse($students as $student)
            <tr>
                <td>{{ $student->getName() }}</td>
                <td>{{ $student->getEmail() }}</td>
                <td>{{ $student->getStudentNumber() }}</td>
                <td>{{ $student->getDepartmentName() ?? 'No Department' }}</td>

                <td class="d-flex gap-2">

                    <x-edit-button :href="route('students.edit', $student->getId())" />

                    <x-delete-button :action="route('students.destroy', $student->getId())" />

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No students found.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

</x-card>

@endsection