{{--
    YOUR TASK (W10 + W13):  list every course.

    The controller passes in:
        $courses  — an array of App\DTOs\CourseDTO

    Each CourseDTO gives you:
        getId(), getTitle(), getCourseCode(), getCreditHours(),
        getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach) with, per row:
        - an "Edit" link    -> route('courses.edit', $course->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('courses.destroy', $course->getId())
    Plus a "New Course" link -> route('courses.create').

    TODO: build the view here.
    --}}

@extends('layouts.app')

@section('content')
<x-card title="All Courses">
    
    <div class="mb-3">
        <x-button href="{{ route('courses.create') }}" color="success">
            <i class="bi bi-plus-lg me-1"></i> Add Course
        </x-button>
    </div>

    <table class="table portal-table mb-0">
        <thead>
            <tr>
                <th width="60">ID</th>
                <th>Course Name</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->getId() }}</td>
                    <td>{{ $course->getTitle() }}</td>
                    <td>
                        <x-button href="{{ route('courses.edit', $course->getId()) }}" color="warning">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </x-button>
                        
                        <form action="{{ route('courses.destroy', $course->getId()) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" color="danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash-fill me-1"></i> Delete
                            </x-button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-card>
@endsection

