{{--
    YOUR TASK (W10):  form to edit an existing student.

    The controller passes in:
        $student            — an App\DTOs\StudentDTO (getters listed in students/index)
        $departmentOptions  — an array of [id => name]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('students.update', $student->getId()) }}"

    Pre-fill each input from the DTO (e.g. :value="$student->getName()") and
    pre-select the student's current department ($student->getDepartmentId()).

    Validated fields:  name, email, student_number, department_id

    TODO: build the form here.
--}}
