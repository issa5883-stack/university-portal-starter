<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * DepartmentController (Student 1, Module B).
 *
 * W12 (MVC): the Controller is the thin layer that connects the View
 * (Blade) to the Service (business logic). It never touches the database
 * directly — it asks the DepartmentService for DTOs and hands them to the
 * view. Generate the skeleton with:  php artisan make:controller DepartmentController --resource
 */
class DepartmentController extends Controller
{
    public function __construct(
        private DepartmentService $departments,
    ) {}

    /** Read — list every department. */
    public function index()
    {
        return view('departments.index', [
            'departments' => $this->departments->all(),
        ]);
    }

    /** Create — show the "new department" form. */
    public function create()
    {
        return view('departments.create');
    }

    /** Create — validate and store the submitted form (W10). */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u',
                'unique:departments,name',
            ],
        ], [
            'name.regex' => 'Department name may only contain letters.',
            'name.unique' => 'This department already exists.',
        ]);

        $this->departments->create($data);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /** Update — show the edit form pre-filled with the current values. */
    public function edit(int $id)
    {
        $department = $this->departments->find($id);
        abort_unless($department, 404);

        return view('departments.edit', [
            'department' => $department,
        ]);
    }

    /** Update — validate and persist the changes. */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u',
                'unique:departments,name,'.$id,
            ],
        ], [
            'name.regex' => 'Department name may only contain letters.',
            'name.unique' => 'This department already exists.',
        ]);

        $this->departments->update($id, $data);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /** Delete — remove the department. */
    public function destroy(int $id)
    {
        $this->departments->delete($id);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
