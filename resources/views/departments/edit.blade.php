{{--
    YOUR TASK (W10):  form to edit an existing department.

    The controller passes in:
        $department  — an App\DTOs\DepartmentDTO  (getId(), getName())

    Submit the form with:
        method="POST" + @csrf + @method('PUT')
        action="{{ route('departments.update', $department->getId()) }}"

    Pre-fill the input with the current value: $department->getName()
    Validated fields:  name (required)

    TODO: build the form here.
--}}

{{-- 1. وراثة التنسيق أو الهيكل العام للموقع (Navbar, Footer, etc) من ملف layouts/app.blade.php --}}
@extends('layouts.app')

{{-- 2. تحديد عنوان الصفحة الحالي ليكون "Edit Department" في علامة تبويب المتصفح --}}
@section('title', 'Edit Department')

{{-- 3. بدء حقن محتوى هذه الصفحة داخل المكان المخصص له في القالب الرئيسي --}}
@section('content')

    {{-- 4. استخدام مكون الكارت الجاهز (Component) وتحديد عنوانه الخارجي --}}
    <x-card title="Edit Department">

        {{-- 5. فتح وسم الفورم وإرسال البيانات إلى راوت التحديث (Update) ممررين معه معرف القسم الحالي --}}
        <form action="{{ route('departments.update', $department->getId()) }}" method="POST">
            
            {{-- 6. توليد توكن الأمان لحماية الفورم من هجمات تزوير الطلبات عبر المواقع (CSRF) --}}
            @csrf
            
            {{-- 7. تغيير نوع الطلب برمجياً إلى PUT لأن المتصفحات لا تدعم سوى GET و POST في الفورم تلقائياً --}}
            @method('PUT')

            {{-- 8. حاوية مخصصة لعرض معرف القسم الحالي (ID) للقراءة فقط --}}
            <div class="mb-3">
                {{-- تسمية الحقل (Label) مع أيقونة الهاش (#) --}}
                <label class="field-label">
                    <i class="bi bi-hash me-1"></i> Department ID
                </label>
                {{-- منطقة استعراض الـ ID المعطل والغير قابل للتعديل --}}
                <div class="id-preview-field">
                    {{-- طباعة معرف القسم الحالي باستخدام دالة getId القادمة من الـ DTO --}}
                    <span class="id-preview-number">#{{ $department->getId() }}</span>
                    {{-- شارة توضيحية للمستخدم تفيد بأن هذا الحقل للقراءة فقط --}}
                    <span class="id-readonly-badge">Read-only</span>
                </div>
            </div>

            {{-- 9. استخدام مكون مخصص للحقول (Form Component): نمرر له اسم الحقل، العنوان، والقيمة الحالية للقسم --}}
            <x-form
                name="name" {{-- اسم الحقل الذي سيُرسل في الـ Request --}}
                label="Department Name" {{-- النص الذي سيظهر فوق حقل الإدخال --}}
                :value="$department->getName()" {{-- استخدام النقطتين (:) لتمرير قيمة برمجية ديناميكية وهي اسم القسم الحالي --}}
            />

            {{-- 10. حاوية أزرار التحكم بمسافة مرنة (Gap) تفصل بينهما --}}
            <div class="d-flex gap-2">
                {{-- زر الحفظ وهو من نوع submit ليقوم بإرسال بيانات الفورم --}}
                <x-button type="submit" color="primary">Update</x-button>
                
                {{-- زر الإلغاء وهو عبارة عن رابط يرجع بالمستخدم إلى صفحة جدول الأقسام الرئيسية --}}
                <x-button href="/departments" color="secondary">Cancel</x-button>
            </div>

        {{-- 11. إغلاق وسم الفورم --}}
        </form>

    {{-- 12. إغلاق مكون الكارت --}}
    </x-card>

{{-- 13. إنهاء حقن محتوى الصفحة --}}
@endsection