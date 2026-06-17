{{--
    YOUR TASK (W10):  form to edit an existing professor.

    The controller passes in:
        $professor          — an App\DTOs\ProfessorDTO (getters listed in professors/index)
        $departmentOptions  — an array of [id => name]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('professors.update', $professor->getId()) }}"

    Pre-fill each input from the DTO and pre-select the current department
    ($professor->getDepartmentId()).

    Validated fields:  name, email, department_id

    TODO: build the form here.
--}}
@extends('layouts.app')
@section('title', 'Edit Professor')
@section('content')

    <x-card title="Edit Professor">

        <form action="{{ route('professors.update', $professor->getId()) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form
                name="name"
                label="Full Name"
                :value="$professor->getName()"
                required
            />

            <x-form
                name="email"
                label="Email"
                type="email"
                :value="$professor->getEmail()"
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
                        <option value="{{ $id }}"
                            {{ old('department_id', $professor->getDepartmentId()) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <x-button type="submit" color="primary">Update</x-button>
                <x-button href="{{ route('professors.index') }}" color="secondary">Cancel</x-button>
            </div>

        </form>

    </x-card>

@endsection