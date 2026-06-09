{{--
    YOUR TASK (W10 + W13):  list every enrollment.

    The controller passes in:
        $enrollments  — an array of App\DTOs\EnrollmentDTO

    Each EnrollmentDTO gives you:
        getId(), getStudentId(), getCourseId(), getGrade(),
        getStudentName(), getCourseTitle(), getCourseCode()

    Show each enrollment in a readable way, e.g.
        "Alice Johnson  —  Web Development (CS305)  —  grade: A"
    Note getGrade() may be null (not graded yet).

    Per row add:
        - an "Edit" link    -> route('enrollments.edit', $enrollment->getId())
        - a "Delete/Drop" <form> (POST + @csrf + @method('DELETE'))
              action -> route('enrollments.destroy', $enrollment->getId())
    Plus a "New Enrollment" link -> route('enrollments.create').

    TODO: build the view here.
--}}
