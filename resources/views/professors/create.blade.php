{{--
    YOUR TASK (W10):  form to create a new professor.

    The controller passes in:
        $departmentOptions  — an array of [id => name] for a dropdown

    Submit with:
        method="POST"  action="{{ route('professors.store') }}"  @csrf

    Validated fields (use these as input name=""):
        name          (required)
        email         (required, must be an email)
        department_id (optional)

    TODO: build the form here.
--}}
@extends('layouts.app')
@section('title', 'Add Professor')
@section('content')

    <x-card title="Add New Professor">

        <form action="{{ route('professors.store') }}" method="POST">
            @csrf

            <x-form
                name="name"
                label="Full Name"
                placeholder="e.g. Dr. John Smith"
                required
            />

            <x-form
                name="email"
                label="Email"
                type="email"
                placeholder="e.g. john.smith@university.edu"
                required
            />

            <div class="mb-3">
                <label for="department_id" class="form-label fw-semibold text-secondary">
                    Department
                </label>
                <select name="department_id" id="department_id"
                    class="form-control rounded-3 border-0 shadow-sm @error('department_id') is-invalid @enderror"
                    style="background:#f8fafc; padding: 10px 14px;">
                    <option value="">— None —</option>
                    @foreach($departmentOptions as $id => $name)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Save</x-button>
                <x-button href="{{ route('professors.index') }}" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection