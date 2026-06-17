{{--
    YOUR TASK (W14 — Blade Components):  build the <x-form-input> component.

    You will use it inside the create/edit forms, e.g.:
        <x-form-input name="email" label="Email" type="email" required />
        <x-form-input name="name"  label="Full Name" :value="$student->getName()" required />

    Suggested props:
        name, label, type (default 'text'), value (default ''), required (default false)

    It should render a <label> and an <input>. Two helpful tips:
        - keep the user's input after a validation error:
              value="{{ old($name, $value) }}"
        - show the validation message for this field:
              @error($name) ... {{ $message }} ... @enderror

    Provided CSS classes: .form-group, .form-control, .form-error

    TODO: build the component here.
--}}
@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-semibold text-secondary">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        class="form-control rounded-3 border-0 shadow-sm @error($name) is-invalid @enderror"
        style="background:#f8fafc; padding: 10px 14px;"
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>