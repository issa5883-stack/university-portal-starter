<?php

namespace App\Services;

use App\DTOs\CourseDTO;
use Illuminate\Support\Facades\DB;

/**
 * CourseService — encapsulates data access for courses (W11) and returns
 * arrays of CourseDTO objects (W10).
 */
class CourseService
{
    private string $table = 'courses';

    /**
     * @return CourseDTO[]
     */
    public function all(): array
    {
        return $this->baseQuery()
            ->orderBy('courses.course_code')
            ->get()
            ->map(fn ($row) => CourseDTO::fromRow($row))
            ->all();
    }

    public function find(int $id): ?CourseDTO
    {
        $row = $this->baseQuery()
            ->where('courses.id', $id)
            ->first();

        return $row ? CourseDTO::fromRow($row) : null;
    }

    public function create(array $data): void
    {
        DB::table($this->table)->insert([
            'title' => $data['title'],
            'course_code' => $data['course_code'],
            'credit_hours' => $data['credit_hours'] ?? 3,
            'department_id' => $data['department_id'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(int $id, array $data): void
    {
        DB::table($this->table)->where('id', $id)->update([
            'title' => $data['title'],
            'course_code' => $data['course_code'],
            'credit_hours' => $data['credit_hours'] ?? 3,
            'department_id' => $data['department_id'] ?? null,
            'updated_at' => now(),
        ]);
    }

    public function delete(int $id): void
    {
        DB::table($this->table)->delete($id);
    }

    private function baseQuery()
    {
        return DB::table('courses')
            ->leftJoin('departments', 'courses.department_id', '=', 'departments.id')
            ->select('courses.*', 'departments.name as department_name');
    }
}
