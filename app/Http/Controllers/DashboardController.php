<?php

namespace App\Http\Controllers;

// نستورد كل الـ Services عشان نجيب البيانات منهم
use App\Services\DepartmentService;
use App\Services\StudentService;
use App\Services\CourseService;
use App\Services\ProfessorService;
use App\Services\EnrollmentService;

class DashboardController extends Controller
{
    // نحقن الـ Services الخمسة عن طريق الـ Constructor
    public function __construct(
        private DepartmentService $departments,
        private StudentService    $students,
        private CourseService     $courses,
        private ProfessorService  $professors,
        private EnrollmentService $enrollments,
    ) {}

    // الدالة الوحيدة — تجيب البيانات وترسلها للـ View
    public function index()
    {
        // نجيب كل البيانات من الـ Services
        $allEnrollments = $this->enrollments->all();

        // نرسل للـ View:
        // - أعداد كل قسم كإحصائيات
        // - آخر 5 تسجيلات فقط
        return view('dashboard', [
            'departmentsCount'  => count($this->departments->all()),
            'studentsCount'     => count($this->students->all()),
            'coursesCount'      => count($this->courses->all()),
            'professorsCount'   => count($this->professors->all()),
            'enrollmentsCount'  => count($allEnrollments),
            'latestEnrollments' => array_slice($allEnrollments, -5), // آخر 5 تسجيلات
        ]);
    }
}
