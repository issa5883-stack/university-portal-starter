{{--
    YOUR TASK (W10 + W13):  list every department.

    The controller passes in:
        $departments  — an array of App\DTOs\DepartmentDTO

    Each DepartmentDTO gives you:  getId(), getName()

    Build:
        - @extends('layouts.app') with a @section('content')
        - loop the array with @foreach and show each department (a table works well)
        - an "Edit" link   -> route('departments.edit', $department->getId())
        - a "Delete" button: a <form> with method="POST" + @csrf + @method('DELETE'),
              action -> route('departments.destroy', $department->getId())
        - a "New Department" link -> route('departments.create')

    TODO: build the view here.
--}}
{{-- الجزء الخاص بالتعليقات التوضيحية للمطور (المطلوب في التمرين) --}}
{{--
    YOUR TASK (W10 + W13):  list every department.
    المهمة: عرض قائمة بكل الأقسام.

    The controller passes in: $departments — an array of App\DTOs\DepartmentDTO
    الكونترولر يرسل لهذه الصفحة مصفوفة تحتوي على بيانات الأقسام.

    Each DepartmentDTO gives you: getId(), getName()
    كل قسم يحتوي على دالتين: جلب المعرف وجلب الاسم.
--}}

{{-- 1. وراثة القالب الرئيسي للموقع (التصميم العام) --}}
@extends('layouts.app')

{{-- 2. تحديد عنوان هذه الصفحة ليظهر في المتصفح باسم "Departments" --}}
@section('title', 'Departments')

{{-- 3. فتح القسم الخاص بمحتوى الصفحة الرئيسي --}}
@section('content')

    {{-- 4. استخدام مكون جاهز (Component) عبارة عن كارت لعرض البيانات وعنوانه "All Departments" --}}
    <x-card title="All Departments">

        {{-- 5. فحص ما إذا كان هناك رسالة نجاح مخزنة في الجلسة (Session) لعرضها للمستخدم --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- 6. مسافة سفلية (Margin Bottom) لوضع زر إضافة قسم جديد --}}
        <div class="mb-3">
            {{-- زر يستخدم مكون مخصّص ينقلك إلى رابط صفحة إنشاء قسم جديد --}}
            <x-button href="{{ route('departments.create') }}" color="success">
                <i class="bi bi-plus-lg me-1"></i> Add Department {{-- أيقونة زائد مع النص --}}
            </x-button>
        </div>

        {{-- شريط البحث: كيفلتري صفوف الجدول لي تحته أوتوماتيك --}}
        <div class="mb-3 table-search">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="search" id="portalSearch" class="form-control" placeholder="Search departments...">
            </div>
        </div>

        {{-- 7. إنشاء الجدول لعرض البيانات وتطبيق كلاسات التنسيق عليه --}}
        <table class="table portal-table mb-0">
            <thead>
                <tr>
                    {{-- تحديد عرض عمود المعرّف بـ 60 بكسل وعمود الأزرار بـ 200 بكسل --}}
                    <th width="60">ID</th>
                    <th>Department Name</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- 8. حلقة تكرار ذكية: تمر على الأقسام، وإذا كان الجدول فارغاً تنتقل تلقائياً لـ @empty --}}
                @forelse($departments as $dept)
                    <tr>
                        {{-- عرض رقم معرف القسم الحالي --}}
                        <td>{{ $dept->getId() }}</td>
                        
                        {{-- عرض اسم القسم الحالي --}}
                        <td>{{ $dept->getName() }}</td>
                        
                        <td>
                             {{-- زر تعديل القسم الحالي يمرر معرّف القسم في الرابط (Route) --}}
                             <x-button href="{{ route('departments.edit', $dept->getId()) }}" color="warning">
                                 <i class="bi bi-pencil-fill me-1"></i> Edit {{-- أيقونة قلم مع كلمة تعديل --}}
                             </x-button>

                             <x-delete-button :action="route('departments.destroy', $dept->getId())" />
                        </td>
                    </tr>
                @empty
                    {{-- 10. هذا السطر يظهر فقط إذا كانت مصفوفة الأقسام فارغة تماماً ولا يوجد بها بيانات --}}
                    <tr>
                        <td colspan="3" class="text-center text-danger">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-card> {{-- إغلاق كارت المحتوى --}}

@endsection {{-- إغلاق قسم المحتوى الرئيسي --}}