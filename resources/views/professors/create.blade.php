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
