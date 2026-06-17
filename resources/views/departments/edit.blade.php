{{--
    YOUR TASK (W10):  form to edit an existing department.

    The controller passes in:
        $department  — an App\DTOs\DepartmentDTO  (getId(), getName())

    Submit the form with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('departments.update', $department->getId()) }}"

    Pre-fill the input with the current value: $department->getName()
    Validated fields:  name (required)

    TODO: build the form here.
--}}

@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')

    <x-card title="Edit Department">

        <form action="{{ route('departments.update', $department->getId()) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Department ID (readonly) --}}
            <div class="mb-3">
                <label class="field-label">
                    <i class="bi bi-hash me-1"></i> Department ID
                </label>
                <div class="id-preview-field">
                    <span class="id-preview-number">#{{ $department->getId() }}</span>
                    <span class="id-readonly-badge">Read-only</span>
                </div>
            </div>

            <x-form
                name="name"
                label="Department Name"
                :value="$department->getName()"
            />

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Update</x-button>
                <x-button href="/departments" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection