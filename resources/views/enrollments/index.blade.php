@extends('layouts.app')
@section('title', 'Enrollments')
@section('content')

    <x-card title="All Enrollments">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <x-create-button :href="route('enrollments.create')">Add Enrollment</x-create-button>
        </div>

        <table class="table portal-table mb-0">
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Grade</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->getId() }}</td>
                        <td>{{ $enrollment->getStudentName() }}</td>
                        <td>{{ $enrollment->getCourseTitle() }} ({{ $enrollment->getCourseCode() }})</td>
                        <td>{{ $enrollment->getGrade() ?? '—' }}</td>
                        <td>
                            <x-edit-button :href="route('enrollments.edit', $enrollment->getId())" />
                            <x-delete-button :action="route('enrollments.destroy', $enrollment->getId())" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No enrollments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-card>

@endsection
