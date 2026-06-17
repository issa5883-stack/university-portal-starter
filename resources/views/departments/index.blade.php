{{--
    YOUR TASK (W10 + W13):  list every department.

    The controller passes in:
        $departments  — an array of App\DTOs\DepartmentDTO

    Each DepartmentDTO gives you:  getId(), getName()

    Build:
        - @extends('layouts.app') with a @section('content')
        - loop the array with @foreach and show each department (a table works well)
        - an "Edit" link   -> route('departments.edit', $department->getId())
        - a "Delete" button: a <form> with method="POST" + @csrf + @method('DELETE'),
              action -> route('departments.destroy', $department->getId())
        - a "New Department" link -> route('departments.create')

    TODO: build the view here.
--}}
@extends('layouts.app')
@section('title', 'Departments')
@section('content')

    <x-card title="All Departments">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
<x-button href="{{ route('departments.create') }}" color="success">                <i class="bi bi-plus-lg me-1"></i> Add Department
            </x-button>
        </div>

        <table class="table portal-table mb-0">
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Department Name</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $dept)
                    <tr>
                        <td>{{ $dept->getId() }}</td>
                        <td>{{ $dept->getName() }}</td>
                        <td>
                             <x-button href="{{ route('departments.edit', $dept->getId()) }}" color="warning">
                             <i class="bi bi-pencil-fill me-1"></i> Edit
                             </x-button>
                             <form action="{{ route('departments.destroy', $dept->getId()) }}" method="POST" class="d-inline">                                @csrf
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
                        <td colspan="3" class="text-center text-muted">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-card>

@endsection