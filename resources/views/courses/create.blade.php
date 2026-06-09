{{--
    YOUR TASK (W10):  form to create a new course.

    The controller passes in:
        $departmentOptions  — an array of [id => name] for a dropdown

    Submit with:
        method="POST"  action="{{ route('courses.store') }}"  @csrf

    Validated fields (use these as input name=""):
        title         (required)
        course_code   (required)
        credit_hours  (required, a whole number between 1 and 12)
        department_id (optional)

    TODO: build the form here.
--}}
