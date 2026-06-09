<?php

namespace App\Services;

use App\DTOs\ProfessorDTO;
use Illuminate\Support\Facades\DB;

/**
 * ProfessorService — encapsulates data access for professors (W11) and
 * returns arrays of ProfessorDTO objects (W10).
 */
class ProfessorService
{
    private string $table = 'professors';

    /**
     * @return ProfessorDTO[]
     */
    public function all(): array
    {
        return $this->baseQuery()
            ->orderBy('professors.name')
            ->get()
            ->map(fn ($row) => ProfessorDTO::fromRow($row))
            ->all();
    }

    public function find(int $id): ?ProfessorDTO
    {
        $row = $this->baseQuery()
            ->where('professors.id', $id)
            ->first();

        return $row ? ProfessorDTO::fromRow($row) : null;
    }

    public function create(array $data): void
    {
        DB::table($this->table)->insert([
            'name' => $data['name'],
            'email' => $data['email'],
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
        return DB::table('professors')
            ->leftJoin('departments', 'professors.department_id', '=', 'departments.id')
            ->select('professors.*', 'departments.name as department_name');
    }
}
