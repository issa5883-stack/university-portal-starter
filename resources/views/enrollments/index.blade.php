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

        <div class="mb-3 table-search">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="search" id="portalSearch" class="form-control" placeholder="Search enrollments...">
            </div>
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
                        <td>
                            @if($enrollment->getGrade())
                                {{ $enrollment->getGrade() }}
                            @else
                                <span class="text-danger">—</span>
                            @endif
                        </td>
                        <td>
                            <x-edit-button :href="route('enrollments.edit', $enrollment->getId())" />
                            <x-delete-button :action="route('enrollments.destroy', $enrollment->getId())" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">No enrollments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-card>

@endsection
