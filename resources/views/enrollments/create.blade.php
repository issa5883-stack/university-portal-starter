{{--
    YOUR TASK (W10):  form to enroll a student in a course.

    This is the special one: the form combines data from TWO sources at once
    (a list of students AND a list of courses).

    The controller passes in:
        $studentOptions  — an array of [id => name]            (for a dropdown)
        $courseOptions   — an array of [id => "CODE — Title"]   (for a dropdown)

    Submit with:
        method="POST"  action="{{ route('enrollments.store') }}"  @csrf

    Validated fields (use these as the field name=""):
        student_id  (required)
        course_id   (required)
        grade       (optional)

    Build two <select> dropdowns (one per array) plus a grade text input.

    TODO: build the form here.
--}}
