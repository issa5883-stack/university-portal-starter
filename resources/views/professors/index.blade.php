{{--
    YOUR TASK (W10 + W13):  list every professor.

    The controller passes in:
        $professors  — an array of App\DTOs\ProfessorDTO

    Each ProfessorDTO gives you:
        getId(), getName(), getEmail(), getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach) with, per row:
        - an "Edit" link    -> route('professors.edit', $professor->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('professors.destroy', $professor->getId())
    Plus a "New Professor" link -> route('professors.create').

    TODO: build the view here.
--}}
@extends('layouts.app')
@section('title', 'Professors')
@section('content')

    <x-card title="All Professors">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <x-button href="{{ route('professors.create') }}" color="success">
                <i class="bi bi-plus-lg me-1"></i> Add Professor
            </x-button>
        </div>

        <table class="table portal-table mb-0">
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professors as $professor)
                    <tr>
                        <td>{{ $professor->getId() }}</td>
                        <td>{{ $professor->getName() }}</td>
                        <td>{{ $professor->getEmail() }}</td>
                        <td>{{ $professor->getDepartmentName() ?? '—' }}</td>
                        <td>
                            <x-button href="{{ route('professors.edit', $professor->getId()) }}" color="warning">
                                <i class="bi bi-pencil-fill me-1"></i> Edit
                            </x-button>
                            <form action="{{ route('professors.destroy', $professor->getId()) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" color="danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash-fill me-1"></i> Delete
                                </x-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No professors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-card>

@endsection