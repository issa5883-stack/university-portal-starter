<?php

namespace App\DTOs;

/**
 * Enrollment Data Transfer Object (W11 – OOP & Encapsulation).
 *
 * An enrollment links a student to a course and optionally records a grade.
 * It also carries the joined student name and course title/code so the
 * listing reads like "Alice Johnson — Web Development (CS305)".
 */
class EnrollmentDTO
{
    public function __construct(
        private ?int $id,
        private int $studentId,
        private int $courseId,
        private ?string $grade = null,
        private ?string $studentName = null,
        private ?string $courseTitle = null,
        private ?string $courseCode = null,
    ) {}

    public static function fromRow(object $row): self
    {
        return new self(
            id: (int) $row->id,
            studentId: (int) $row->student_id,
            courseId: (int) $row->course_id,
            grade: $row->grade,
            studentName: $row->student_name ?? null,
            courseTitle: $row->course_title ?? null,
            courseCode: $row->course_code ?? null,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): int
    {
        return $this->studentId;
    }

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function getStudentName(): ?string
    {
        return $this->studentName;
    }

    public function getCourseTitle(): ?string
    {
        return $this->courseTitle;
    }

    public function getCourseCode(): ?string
    {
        return $this->courseCode;
    }
}
