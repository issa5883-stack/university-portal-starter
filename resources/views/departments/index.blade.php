{{--
    YOUR TASK (W10 + W13):  list every department.

    The controller passes in:
        $departments  — an array of App\DTOs\DepartmentDTO

    Each DepartmentDTO gives you:  getId(), getName()

    Build:
        - @extends('layouts.app') with a @section('content')
        - loop the array with @foreach and show each department (a table works well)
        - an "Edit" link   -> route('departments.edit', $department->getId())
        - a "Delete" button: a <form> with method="POST" + @csrf + @method('DELETE'),
              action -> route('departments.destroy', $department->getId())
        - a "New Department" link -> route('departments.create')

    TODO: build the view here.
--}}
