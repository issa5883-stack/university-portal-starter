<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\EnrollmentService;
use App\Services\StudentService;
use Illuminate\Http\Request;

/**
 * EnrollmentController (Student 5).
 *
 * The enrollment form pulls its dropdown data from TWO other services
 * (students + courses), demonstrating a form that processes data from
 * multiple sources (W10).
 */
class EnrollmentController extends Controller
{
    public function __construct(
        private EnrollmentService $enrollments,
        private StudentService $students,
        private CourseService $courses,
    ) {}

    public function index()
    {
        return view('enrollments.index', [
            'enrollments' => $this->enrollments->all(),
        ]);
    }

    public function create()
    {
        return view('enrollments.create', [
            'studentOptions' => $this->studentOptions(),
            'courseOptions' => $this->courseOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'grade' => ['nullable', 'string', 'max:5'],
        ]);

        $this->enrollments->create($data);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment created successfully.');
    }

    public function edit(int $id)
    {
        $enrollment = $this->enrollments->find($id);
        abort_unless($enrollment, 404);

        return view('enrollments.edit', [
            'enrollment' => $enrollment,
            'studentOptions' => $this->studentOptions(),
            'courseOptions' => $this->courseOptions(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'grade' => ['nullable', 'string', 'max:5'],
        ]);

        $this->enrollments->update($id, $data);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->enrollments->delete($id);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment removed successfully.');
    }

    /**
     * @return array<int, string>
     */
    private function studentOptions(): array
    {
        return collect($this->students->all())
            ->mapWithKeys(fn ($student) => [$student->getId() => $student->getName()])
            ->all();
    }

    /**
     * @return array<int, string>  e.g. [7 => "CS305 — Web Development"]
     */
    private function courseOptions(): array
    {
        return collect($this->courses->all())
            ->mapWithKeys(fn ($course) => [
                $course->getId() => $course->getCourseCode().' — '.$course->getTitle(),
            ])
            ->all();
    }
}
