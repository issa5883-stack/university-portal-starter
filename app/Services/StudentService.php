<?php

namespace App\Services;

use App\DTOs\StudentDTO;
use Illuminate\Support\Facades\DB;

/**
 * StudentService — encapsulates all data access for students and maps
 * raw rows into StudentDTO objects (W11). The list/find queries join the
 * departments table so each DTO already knows its department name.
 */
class StudentService
{
    private string $table = 'students';

    /**
     * @return StudentDTO[]
     */
    public function all(): array
    {
        return $this->baseQuery()
            ->orderBy('students.name')
            ->get()
            ->map(fn ($row) => StudentDTO::fromRow($row))
            ->all();
    }

    public function find(int $id): ?StudentDTO
    {
        $row = $this->baseQuery()
            ->where('students.id', $id)
            ->first();

        return $row ? StudentDTO::fromRow($row) : null;
    }

    public function create(array $data): void
    {
        DB::table($this->table)->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'student_number' => $data['student_number'] ?? null,
            'department_id' => $data['department_id'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(int $id, array $data): void
    {
        DB::table($this->table)->where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'student_number' => $data['student_number'] ?? null,
            'department_id' => $data['department_id'] ?? null,
            'updated_at' => now(),
        ]);
    }

    public function delete(int $id): void
    {
        DB::table($this->table)->delete($id);
    }

    /**
     * Shared SELECT used by all() and find(): a student row plus its
     * department name via a LEFT JOIN (so students without a department
     * still appear).
     */
    private function baseQuery()
    {
        return DB::table('students')
            ->leftJoin('departments', 'students.department_id', '=', 'departments.id')
            ->select('students.*', 'departments.name as department_name');
    }
}
