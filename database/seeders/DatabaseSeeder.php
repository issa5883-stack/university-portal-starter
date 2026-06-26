<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Rich sample-data seeder for the University Portal.
 *
 * Generates a sizeable, realistic data set:
 *   - 12 departments (each with its own course catalogue + code prefix)
 *   - 36 professors (3 per department)
 *   - ~77 courses (the departments' catalogues, 100/200/300/400-level codes)
 *   - 240 students (20 per department)
 *   - ~1,300 enrollments (each student takes several courses; many are graded,
 *     some are still "in progress" with no grade yet)
 *
 * Uses only the Query Builder (no Eloquent models), chunked bulk inserts for
 * speed, and a fixed RNG seed so the generated data is the same on every run.
 *
 * Run with:  php artisan migrate:fresh --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        mt_srand(20260607); // reproducible data on every run

        $now = now();

        // Login accounts live in their own seeder so they can be (re)created
        // on their own with `php artisan portal:seed-auth`.
        $this->call(UserSeeder::class);
        $chunk = 100; // keep each INSERT under SQLite's bound-parameter limit

        // Re-runnable: wipe in FK-safe order.
        DB::table('enrollments')->delete();
        DB::table('students')->delete();
        DB::table('courses')->delete();
        DB::table('professors')->delete();
        DB::table('departments')->delete();

        $firstNames = ['Alice', 'Bilal', 'Carmen', 'Deepa', 'Omar', 'Sarah', 'James', 'Helen', 'Tomas', 'Aisha',
            'Liam', 'Noah', 'Emma', 'Olivia', 'Ava', 'Sophia', 'Mia', 'Yusuf', 'Fatima', 'Hassan',
            'Layla', 'Ahmed', 'Mariam', 'Khalid', 'Zainab', 'Ethan', 'Lucas', 'Mason', 'Chen', 'Wei',
            'Mei', 'Hiroshi', 'Yuki', 'Priya', 'Arjun', 'Ananya', 'Ravi', 'Sanjay', 'Ingrid', 'Lars',
            'Anna', 'Maria', 'Sofia', 'Diego', 'Juan', 'Carlos', 'Isabella', 'Gabriel', 'Nia', 'Kwame'];

        $lastNames = ['Johnson', 'Hassan', 'Diaz', 'Nair', 'Khalid', 'Mitchell', 'Okoro', 'Park', 'Vega', 'Smith',
            'Brown', 'Lee', 'Kim', 'Chen', 'Wang', 'Liu', 'Patel', 'Singh', 'Kumar', 'Garcia',
            'Martinez', 'Rodriguez', 'Lopez', 'Gonzalez', 'Hernandez', 'Williams', 'Jones', 'Davis', 'Wilson', 'Taylor',
            'Anderson', 'Thomas', 'Mwangi', 'Adebayo', 'Okafor', 'Yilmaz', 'Demir', 'Nguyen', 'Tran', 'Sato',
            'Tanaka', 'Suzuki', 'Ali', 'Rahman', 'Hussain', 'Ahmed', 'Schmidt', 'Weber', 'Fischer', 'Meyer'];

        $departments = [
            ['name' => 'Computer Science',        'prefix' => 'CS', 'courses' => ['Introduction to Programming', 'Data Structures', 'Algorithms', 'Web Development', 'Database Systems', 'Operating Systems', 'Computer Networks', 'Machine Learning']],
            ['name' => 'Mathematics',             'prefix' => 'MA', 'courses' => ['Calculus I', 'Calculus II', 'Linear Algebra', 'Discrete Mathematics', 'Probability and Statistics', 'Differential Equations', 'Real Analysis']],
            ['name' => 'Electrical Engineering',  'prefix' => 'EE', 'courses' => ['Circuit Analysis', 'Digital Logic Design', 'Signals and Systems', 'Microelectronics', 'Power Systems', 'Control Systems', 'Electromagnetics']],
            ['name' => 'Mechanical Engineering',  'prefix' => 'ME', 'courses' => ['Statics', 'Dynamics', 'Thermodynamics', 'Fluid Mechanics', 'Machine Design', 'Heat Transfer', 'Manufacturing Processes']],
            ['name' => 'Business Administration', 'prefix' => 'BA', 'courses' => ['Principles of Management', 'Marketing Fundamentals', 'Organizational Behavior', 'Operations Management', 'Business Strategy', 'Entrepreneurship']],
            ['name' => 'Economics',               'prefix' => 'EC', 'courses' => ['Microeconomics', 'Macroeconomics', 'Econometrics', 'International Trade', 'Public Finance', 'Development Economics']],
            ['name' => 'Physics',                 'prefix' => 'PH', 'courses' => ['Classical Mechanics', 'Electricity and Magnetism', 'Quantum Physics', 'Thermal Physics', 'Optics', 'Modern Physics']],
            ['name' => 'Chemistry',               'prefix' => 'CH', 'courses' => ['General Chemistry', 'Organic Chemistry', 'Inorganic Chemistry', 'Physical Chemistry', 'Analytical Chemistry', 'Biochemistry']],
            ['name' => 'Biology',                 'prefix' => 'BI', 'courses' => ['Cell Biology', 'Genetics', 'Ecology', 'Microbiology', 'Molecular Biology', 'Human Anatomy']],
            ['name' => 'Psychology',              'prefix' => 'PS', 'courses' => ['Introduction to Psychology', 'Cognitive Psychology', 'Social Psychology', 'Developmental Psychology', 'Abnormal Psychology', 'Research Methods']],
            ['name' => 'English Literature',      'prefix' => 'EN', 'courses' => ['World Literature', 'Shakespeare', 'Modern Poetry', 'Literary Theory', 'Creative Writing', 'The Victorian Novel']],
            ['name' => 'Civil Engineering',       'prefix' => 'CE', 'courses' => ['Structural Analysis', 'Geotechnical Engineering', 'Transportation Engineering', 'Hydraulics', 'Construction Management', 'Surveying']],
        ];

        $creditPool = [3, 3, 3, 4, 4];
        $gradePool = ['A', 'A', 'A-', 'B+', 'B', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'F', null, null, null, null];

        // ---- Departments ----
        $deptIds = [];
        foreach ($departments as $d) {
            $deptIds[$d['name']] = DB::table('departments')->insertGetId([
                'name' => $d['name'], 'created_at' => $now, 'updated_at' => $now,
            ]);
        }

        // ---- Professors (3 per department) ----
        $profRows = [];
        $p = 1;
        foreach ($departments as $d) {
            for ($i = 0; $i < 3; $i++) {
                $fn = $firstNames[array_rand($firstNames)];
                $ln = $lastNames[array_rand($lastNames)];
                $profRows[] = [
                    'name' => "Dr. {$fn} {$ln}",
                    'email' => strtolower("{$fn}.{$ln}.{$p}") . '@faculty.uni.edu',
                    'department_id' => $deptIds[$d['name']],
                    'created_at' => $now, 'updated_at' => $now,
                ];
                $p++;
            }
        }
        foreach (array_chunk($profRows, $chunk) as $batch) {
            DB::table('professors')->insert($batch);
        }

        // ---- Courses (each department's catalogue, 100/200/300/400-level codes) ----
        $courseRows = [];
        foreach ($departments as $d) {
            foreach ($d['courses'] as $idx => $title) {
                $number = ((intdiv($idx, 2) + 1) * 100) + (($idx % 2) + 1); // 101, 102, 201, 202, ...
                $courseRows[] = [
                    'title' => $title,
                    'course_code' => $d['prefix'] . $number,
                    'credit_hours' => $creditPool[array_rand($creditPool)],
                    'department_id' => $deptIds[$d['name']],
                    'created_at' => $now, 'updated_at' => $now,
                ];
            }
        }
        foreach (array_chunk($courseRows, $chunk) as $batch) {
            DB::table('courses')->insert($batch);
        }

        // Pull the new course ids back, grouped by department, for enrollments.
        $coursesByDept = [];
        $allCourseIds = [];
        foreach (DB::table('courses')->select('id', 'department_id')->get() as $c) {
            $coursesByDept[$c->department_id][] = $c->id;
            $allCourseIds[] = $c->id;
        }

        // ---- Students (20 per department) ----
        $studentRows = [];
        $s = 1;
        foreach ($departments as $d) {
            for ($i = 0; $i < 20; $i++) {
                $fn = $firstNames[array_rand($firstNames)];
                $ln = $lastNames[array_rand($lastNames)];
                $studentRows[] = [
                    'name' => "{$fn} {$ln}",
                    'email' => strtolower("{$fn}.{$ln}.{$s}") . '@students.uni.edu',
                    'student_number' => 'S' . str_pad((string) (10000 + $s), 5, '0', STR_PAD_LEFT),
                    'department_id' => $deptIds[$d['name']],
                    'created_at' => $now, 'updated_at' => $now,
                ];
                $s++;
            }
        }
        foreach (array_chunk($studentRows, $chunk) as $batch) {
            DB::table('students')->insert($batch);
        }

        // ---- Enrollments (each student takes a handful of courses) ----
        $students = DB::table('students')->select('id', 'department_id')->get();
        $enrollmentRows = [];
        foreach ($students as $student) {
            $picked = [];

            // Mostly courses from the student's own department.
            $deptCourses = $coursesByDept[$student->department_id] ?? [];
            shuffle($deptCourses);
            $take = min(count($deptCourses), mt_rand(3, 5));
            for ($i = 0; $i < $take; $i++) {
                $picked[$deptCourses[$i]] = true;
            }

            // Plus one or two electives from anywhere in the university.
            $electives = mt_rand(1, 2);
            for ($i = 0; $i < $electives; $i++) {
                $picked[$allCourseIds[array_rand($allCourseIds)]] = true;
            }

            foreach (array_keys($picked) as $courseId) {
                $enrollmentRows[] = [
                    'student_id' => $student->id,
                    'course_id' => $courseId,
                    'grade' => $gradePool[array_rand($gradePool)],
                    'created_at' => $now, 'updated_at' => $now,
                ];
            }
        }
        foreach (array_chunk($enrollmentRows, $chunk) as $batch) {
            DB::table('enrollments')->insert($batch);
        }

        // Friendly summary in the console.
        if ($this->command) {
            $this->command->getOutput()->writeln('');
            $this->command->info(sprintf(
                'Seeded %d departments, %d professors, %d courses, %d students, %d enrollments.',
                DB::table('departments')->count(),
                DB::table('professors')->count(),
                DB::table('courses')->count(),
                DB::table('students')->count(),
                DB::table('enrollments')->count(),
            ));
        }
    }
}