{{--
    YOUR TASK (W10 + W13):  list every course.

    The controller passes in:
        $courses  — an array of App\DTOs\CourseDTO

    Each CourseDTO gives you:
        getId(), getTitle(), getCourseCode(), getCreditHours(),
        getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach) with, per row:
        - an "Edit" link    -> route('courses.edit', $course->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('courses.destroy', $course->getId())
    Plus a "New Course" link -> route('courses.create').

    TODO: build the view here.
--}}
