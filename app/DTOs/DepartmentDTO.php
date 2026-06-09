<?php

namespace App\DTOs;

/**
 * Department Data Transfer Object.
 *
 * Demonstrates W11 (OOP & Encapsulation): the data is held in PRIVATE
 * properties and only exposed through public getter METHODS. The Service
 * builds these objects; Controllers and Blade views consume them. Nothing
 * outside this class can mutate its state after construction.
 */
class DepartmentDTO
{
    public function __construct(
        private ?int $id,
        private string $name,
    ) {}

    /**
     * Build a DTO from a raw database row (a stdClass object).
     */
    public static function fromRow(object $row): self
    {
        return new self(
            id: (int) $row->id,
            name: $row->name,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
