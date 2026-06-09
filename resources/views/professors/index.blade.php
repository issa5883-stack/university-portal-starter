{{--
    YOUR TASK (W10 + W13):  list every professor.

    The controller passes in:
        $professors  — an array of App\DTOs\ProfessorDTO

    Each ProfessorDTO gives you:
        getId(), getName(), getEmail(), getDepartmentId(), getDepartmentName()

    Build a table (loop with @foreach) with, per row:
        - an "Edit" link    -> route('professors.edit', $professor->getId())
        - a "Delete" <form> (POST + @csrf + @method('DELETE'))
              action -> route('professors.destroy', $professor->getId())
    Plus a "New Professor" link -> route('professors.create').

    TODO: build the view here.
--}}
