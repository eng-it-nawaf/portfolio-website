@extends('admin.layouts.app')

@section('title', 'إضافة مهارة جديدة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-skills.css') }}">
@endpush

@section('content')
<div class="skills-management">
    <div class="page-header">
        <div>
            <h1 class="page-title">إضافة مهارة جديدة</h1>
            <p class="page-description">أضف مهارة جديدة إلى ملفك الشخصي</p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> رجوع للقائمة
        </a>
    </div>

    <div class="form-container fade-in-up">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-plus"></i> معلومات المهارة الجديدة
            </h3>
        </div>
        <div class="form-body">
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">اسم المهارة</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name') }}" required 
                           placeholder="أدخل اسم المهارة">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="icon" class="form-label">الأيقونة</label>
                    <input type="text" class="form-control" id="icon" name="icon" 
                           value="{{ old('icon') }}" required 
                           placeholder="مثال: fas fa-code">
                    <small class="text-muted">استخدم أسماء الأيقونات من Font Awesome (مثال: fas fa-code, fab fa-react)</small>
                    @error('icon')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category" class="form-label">التصنيف</label>
                    <select class="form-control form-select" id="category" name="category" required>
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="percentage" class="form-label">النسبة المئوية (1-100)</label>
                    <input type="range" class="form-control" id="percentage" name="percentage" 
                           min="1" max="100" value="{{ old('percentage', 50) }}" 
                           oninput="updatePercentageValue(this.value)" required>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted">1%</small>
                        <span id="percentageValue" class="font-weight-bold">{{ old('percentage', 50) }}%</span>
                        <small class="text-muted">100%</small>
                    </div>
                    @error('percentage')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex gap-3 mt-5">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> حفظ المهارة
                    </button>
                    <a href="{{ route('admin.skills.index') }}" class="btn-back">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updatePercentageValue(value) {
    document.getElementById('percentageValue').textContent = value + '%';
}

// Initialize percentage value on page load
document.addEventListener('DOMContentLoaded', function() {
    const percentageInput = document.getElementById('percentage');
    if (percentageInput) {
        updatePercentageValue(percentageInput.value);
    }
});
</script>
@endpush