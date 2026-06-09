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
