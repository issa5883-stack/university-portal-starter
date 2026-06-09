{{--
    YOUR TASK (W10):  form to create a new student.

    The controller passes in:
        $departmentOptions  — an array of  [id => name]  for a dropdown

    Submit with:
        method="POST"  action="{{ route('students.store') }}"  @csrf

    Validated fields (use these as input name=""):
        name            (required)
        email           (required, must be an email)
        student_number  (optional)
        department_id   (optional)

    For department_id, build a <select> by looping $departmentOptions:
        @foreach ($departmentOptions as $id => $name) ... @endforeach

    TODO: build the form here.
--}}
