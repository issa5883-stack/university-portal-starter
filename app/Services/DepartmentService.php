<?php

namespace App\Services;

use App\DTOs\DepartmentDTO;
use Illuminate\Support\Facades\DB;

/**
 * DepartmentService — business logic + data access for departments.
 *
 * W11 (Encapsulation): the data source is held in a PRIVATE property
 * ($table). In a production system this could just as easily be a
 * `private Http $client` talking to a REST API — the rest of the
 * application would not change, because it only ever calls the public
 * methods below (all / find / create / update / delete) and receives
 * DTO objects back. Storage details stay hidden inside the service.
 */
class DepartmentService
{
    private string $table = 'departments';

    /**
     * Return every department as an array of DTOs (W10 – arrays).
     *
     * @return DepartmentDTO[]
     */
    public function all(): array
    {
        return DB::table($this->table)
            ->orderBy('name')
            ->get()
            ->map(fn ($row) => DepartmentDTO::fromRow($row))
            ->all();
    }

    public function find(int $id): ?DepartmentDTO
    {
        $row = DB::table($this->table)->find($id);

        return $row ? DepartmentDTO::fromRow($row) : null;
    }

    public function create(array $data): void
    {
        DB::table($this->table)->insert([
            'name' => $data['name'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(int $id, array $data): void
    {
        DB::table($this->table)->where('id', $id)->update([
            'name' => $data['name'],
            'updated_at' => now(),
        ]);
    }

    public function delete(int $id): void
    {
        DB::table($this->table)->delete($id);
    }
}
