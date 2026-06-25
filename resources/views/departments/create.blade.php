{{--
    YOUR TASK (W10):  form to create a new department.

    Submit the form with:
        method="POST"
        action="{{ route('departments.store') }}"
        @csrf

    The controller validates these fields (use them as the input name=""):
        name   (required)

    TODO: build the form here.
--}}
{{-- 1. وراثة التنسيق أو الهيكل العام للموقع (القالب الأساسي) --}}
@extends('layouts.app')

{{-- 2. تحديد عنوان الصفحة الحالي ليكون "Add Department" في تبويب المتصفح --}}
@section('title', 'Add Department')

{{-- 3. بدء حقن محتوى هذه الصفحة داخل المكان المخصص له في القالب الرئيسي --}}
@section('content')

    {{-- 4. كود PHP داخلي لحساب المعرّف القادم تقريبياً للعرض فقط (بجلب أعلى ID وزيادة 1) --}}
    @php
        try {
            $nextId = (\Illuminate\Support\Facades\DB::table('departments')->max('id') ?? 0) + 1;
        } catch (\Exception $e) {
            $nextId = '—';
        }
    @endphp

    {{-- 5. استخدام مكون الكارت الجاهز (Component) وتحديد عنوانه الخارجي لتأطير الفورم --}}
    <x-card title="Add New Department">

        {{-- 6. فتح وسم الفورم وتوجيه البيانات إلى راوت التخزين (Store) باستخدام ميثود POST --}}
        <form action="{{ route('departments.store') }}" method="POST">            
            
            {{-- 7. توكن الأمان الإلزامي في Laravel لحماية الفورم من هجمات الثغرات الأمنية (CSRF) --}}
            @csrf

            {{-- 8. حاوية مخصصة لاستعراض الـ ID القادم بشكل تلقائي (للقراءة والمعاينة فقط) --}}
            <div class="mb-3">
                {{-- تسمية الحقل (Label) مع أيقونة الهاش (#) --}}
                <label class="field-label">
                    <i class="bi bi-hash me-1"></i> Department ID
                </label>
                {{-- منطقة استعراض الـ ID التقريبي المتوقع --}}
                <div class="id-preview-field">
                    {{-- طباعة المتغير الذي قمنا بحسابه في الأعلى --}}
                    <span class="id-preview-number">#{{ $nextId }}</span>
                    {{-- شارة توضيحية للمستخدم تفيد بأن النظام سيقوم بتوليد الرقم تلقائياً --}}
                    <span class="id-auto-badge">Auto-assigned</span>
                </div>
            </div>

            {{-- 9. استخدام المكون المخصص للحقول (Form Component): نمرر له اسم الحقل، العنوان، ونصاً توضيحياً (Placeholder) --}}
            <x-form
                name="name" {{-- اسم الحقل الإجباري الذي سيتم التحقق منه في الـ Controller --}}
                label="Department Name" {{-- النص الذي سيظهر كعنوان فوق صندوق الإدخال --}}
                placeholder="e.g. Computer Science" {{-- نص رمادي توضيحي يختفي عند الكتابة --}}
            />

            {{-- 10. حاوية أزرار التحكم مصفوفة بجانب بعضها مع مسافة مرنة (Gap) تفصل بينهما --}}
            <div class="d-flex gap-2">
                {{-- زر الحفظ وهو من نوع submit ليقوم بإرسال بيانات القسم الجديد للـ Controller --}}
                <x-save />
                
                {{-- زر إلغاء العملية، وهو رابط يعود بالمستخدم إلى جدول الأقسام الرئيسي --}}
                <x-button href="/departments" color="secondary">Cancel</x-button>
            </div>

        {{-- 11. إغلاق وسم الفورم --}}
        </form>

    {{-- 12. إغلاق مكون الكارت --}}
    </x-card>

{{-- 13. إنهاء حقن محتوى الصفحة --}}
@endsection