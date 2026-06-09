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
