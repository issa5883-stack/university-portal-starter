{{--
    YOUR TASK (W10 + W13):  list every student.

    The controller passes in:
        $students  — an array of App\DTOs\StudentDTO

    Each StudentDTO gives you:
        getId(), getName(), getEmail(), getStudentNumber(),
        getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach), with for each row:
        - an "Edit" link    -> route('students.edit', $student->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('students.destroy', $student->getId())
    Plus a "New Student" link -> route('students.create').

    Tip: getDepartmentName() may be null if the student has no department.

    TODO: build the view here.
--}}
