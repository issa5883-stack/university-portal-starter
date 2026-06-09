<?php

namespace App\DTOs;

/**
 * Student Data Transfer Object (W11 – OOP & Encapsulation).
 *
 * Carries a student's data plus the (joined) department name for display,
 * so views never have to issue their own queries.
 */
class StudentDTO
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private ?string $studentNumber = null,
        private ?int $departmentId = null,
        private ?string $departmentName = null,
    ) {}

    public static function fromRow(object $row): self
    {
        return new self(
            id: (int) $row->id,
            name: $row->name,
            email: $row->email,
            studentNumber: $row->student_number,
            departmentId: $row->department_id !== null ? (int) $row->department_id : null,
            departmentName: $row->department_name ?? null,
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStudentNumber(): ?string
    {
        return $this->studentNumber;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function getDepartmentName(): ?string
    {
        return $this->departmentName;
    }
}
