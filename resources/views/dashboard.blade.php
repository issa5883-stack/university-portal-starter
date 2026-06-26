@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

{{-- ───── عنوان الصفحة ───── --}}
<div class="mb-4">
    <h2><i class="bi bi-speedometer2 me-2"></i> Dashboard</h2>
</div>

{{-- ───── إحصائيات (Stats Cards) ───── --}}
{{-- كل بطاقة تعرض عدد العناصر في كل قسم --}}
<div class="row g-3 mb-4">

    {{-- عدد الأقسام --}}
    <div class="col-md-4 col-lg">
        <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
                <i class="bi bi-building fs-2 text-primary"></i>
                <h3 class="mt-2 mb-0">{{ $departmentsCount }}</h3>
                <p class="text-muted mb-0">Departments</p>
            </div>
        </div>
    </div>

    {{-- عدد الطلاب --}}
    <div class="col-md-4 col-lg">
        <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
                <i class="bi bi-people fs-2 text-success"></i>
                <h3 class="mt-2 mb-0">{{ $studentsCount }}</h3>
                <p class="text-muted mb-0">Students</p>
            </div>
        </div>
    </div>

    {{-- عدد الكورسات --}}
    <div class="col-md-4 col-lg">
        <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
                <i class="bi bi-book fs-2 text-warning"></i>
                <h3 class="mt-2 mb-0">{{ $coursesCount }}</h3>
                <p class="text-muted mb-0">Courses</p>
            </div>
        </div>
    </div>

    {{-- عدد الأساتذة --}}
    <div class="col-md-4 col-lg">
        <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
                <i class="bi bi-person-badge fs-2 text-danger"></i>
                <h3 class="mt-2 mb-0">{{ $professorsCount }}</h3>
                <p class="text-muted mb-0">Professors</p>
            </div>
        </div>
    </div>

    {{-- عدد التسجيلات --}}
    <div class="col-md-4 col-lg">
        <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
                <i class="bi bi-journal-check fs-2 text-info"></i>
                <h3 class="mt-2 mb-0">{{ $enrollmentsCount }}</h3>
                <p class="text-muted mb-0">Enrollments</p>
            </div>
        </div>
    </div>

</div>

{{-- ───── آخر تسجيلات ───── --}}
<div class="row g-3">

    <div class="col-12">
        <x-card title="Latest Enrollments">
            <table class="table portal-table mb-0">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- نعرض آخر 5 تسجيلات، أو رسالة لو ما في شيء --}}
                    @forelse($latestEnrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->getStudentName() }}</td>
                            <td>{{ $enrollment->getCourseTitle() }}</td>
                            <td>{{ $enrollment->getGrade() ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No enrollments yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-card>
    </div>

</div>

@endsection
