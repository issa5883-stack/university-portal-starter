<?php

namespace App\Services;

use App\DTOs\EnrollmentDTO;
use Illuminate\Support\Facades\DB;

/**
 * EnrollmentService — the "join" module that links students to courses.
 *
 * Its list query pulls data from THREE tables (enrollments + students +
 * courses) so the view can show a human-readable line per enrollment.
 * This is the W10 "data from multiple sources" requirement in action.
 */
class EnrollmentService
{
    private string $table = 'enrollments';

    /**
     * @return EnrollmentDTO[]
     */
    public function all(): array
    {
        return $this->baseQuery()
            ->orderByDesc('enrollments.id')
            ->get()
            ->map(fn ($row) => EnrollmentDTO::fromRow($row))
            ->all();
    }

    public function find(int $id): ?EnrollmentDTO
    {
        $row = $this->baseQuery()
            ->where('enrollments.id', $id)
            ->first();

        return $row ? EnrollmentDTO::fromRow($row) : null;
    }

    public function create(array $data): void
    {
        DB::table($this->table)->insert([
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id'],
            'grade' => $data['grade'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(int $id, array $data): void
    {
        DB::table($this->table)->where('id', $id)->update([
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id'],
            'grade' => $data['grade'] ?? null,
            'updated_at' => now(),
        ]);
    }

    public function delete(int $id): void
    {
        DB::table($this->table)->delete($id);
    }

    /**
     * Enrollment row joined to the student name and the course title/code.
     */
    private function baseQuery()
    {
        return DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(
                'enrollments.*',
                'students.name as student_name',
                'courses.title as course_title',
                'courses.course_code as course_code',
            );
    }
}
