<?php

namespace App\DTOs;

/**
 * Course Data Transfer Object (W11 – OOP & Encapsulation).
 */
class CourseDTO
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $courseCode,
        private int $creditHours = 3,
        private ?int $departmentId = null,
        private ?string $departmentName = null,
    ) {}

    public static function fromRow(object $row): self
    {
        return new self(
            id: (int) $row->id,
            title: $row->title,
            courseCode: $row->course_code,
            creditHours: (int) $row->credit_hours,
            departmentId: $row->department_id !== null ? (int) $row->department_id : null,
            departmentName: $row->department_name ?? null,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function getCreditHours(): int
    {
        return $this->creditHours;
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
