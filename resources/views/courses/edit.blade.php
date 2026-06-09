{{--
    YOUR TASK (W10):  form to edit an existing course.

    The controller passes in:
        $course             — an App\DTOs\CourseDTO (getters listed in courses/index)
        $departmentOptions  — an array of [id => name]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('courses.update', $course->getId()) }}"

    Pre-fill each input from the DTO and pre-select the current department
    ($course->getDepartmentId()).

    Validated fields:  title, course_code, credit_hours, department_id

    TODO: build the form here.
--}}
