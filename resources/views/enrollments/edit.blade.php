{{--
    YOUR TASK (W10):  edit an enrollment (for example, to add a final grade).

    The controller passes in:
        $enrollment      — an App\DTOs\EnrollmentDTO (getters listed in enrollments/index)
        $studentOptions  — an array of [id => name]
        $courseOptions   — an array of [id => "CODE — Title"]

    Submit with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('enrollments.update', $enrollment->getId()) }}"

    Pre-select the current student ($enrollment->getStudentId()) and course
    ($enrollment->getCourseId()), and pre-fill the grade ($enrollment->getGrade()).

    Validated fields:  student_id, course_id, grade

    TODO: build the form here.
--}}
