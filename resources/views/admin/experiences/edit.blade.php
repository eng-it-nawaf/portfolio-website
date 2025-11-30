@extends('admin.layouts.app')

@section('title', 'تعديل الخبرة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-experiences.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تعديل الخبرة</h1>
            <p class="page-description">تعديل خبرة: {{ $experience->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="experience-card">
        <div class="card-body">
            <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="experience-form">
                @csrf
                @method('PUT')
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">المسمى الوظيفي / المؤهل</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $experience->title) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="company" class="form-label">اسم الشركة / المؤسسة</label>
                            <input type="text" class="form-control" id="company" name="company" 
                                   value="{{ old('company', $experience->company) }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="type" class="form-label">نوع الخبرة</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="work" {{ old('type', $experience->type) == 'work' ? 'selected' : '' }}>خبرة عملية</option>
                                <option value="education" {{ old('type', $experience->type) == 'education' ? 'selected' : '' }}>خبرة تعليمية</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">حالة الخبرة</label>
                            <div class="status-toggle">
                                <label class="toggle-label">
                                    <input type="checkbox" name="is_current" value="1" 
                                           {{ old('is_current', $experience->is_current) ? 'checked' : '' }} 
                                           onchange="toggleEndDate(this)">
                                    <span class="toggle-slider"></span>
                                    <span class="toggle-text">ما زلت أعمل / أدرس هنا</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-calendar-alt"></i> الفترة الزمنية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_date" class="form-label">تاريخ البدء</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" 
                                   {{ old('is_current', $experience->is_current) ? 'disabled' : '' }}>
                            <div class="form-text" id="end-date-help">
                                {{ $experience->is_current ? 'تم تعطيل الحقل لأن الخبرة مستمرة' : 'اتركه فارغاً إذا كانت الخبرة مستمرة' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-file-alt"></i> الوصف التفصيلي
                    </h3>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="description" name="description" rows="6">{{ old('description', $experience->description) }}</textarea>
                        <div class="form-text">
                            يمكنك كتابة المهام والمسؤوليات أو المواد الدراسية والإنجازات
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleEndDate(checkbox) {
    const endDateInput = document.getElementById('end_date');
    const endDateHelp = document.getElementById('end-date-help');
    
    endDateInput.disabled = checkbox.checked;
    
    if (checkbox.checked) {
        endDateInput.value = '';
        endDateHelp.textContent = 'تم تعطيل الحقل لأن الخبرة مستمرة';
        endDateHelp.style.color = '#10b981';
    } else {
        endDateHelp.textContent = 'اتركه فارغاً إذا كانت الخبرة مستمرة';
        endDateHelp.style.color = '#6b7280';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const isCurrentCheckbox = document.querySelector('input[name="is_current"]');
    if (isCurrentCheckbox) {
        // Update help text color based on initial state
        const endDateHelp = document.getElementById('end-date-help');
        if (isCurrentCheckbox.checked) {
            endDateHelp.style.color = '#10b981';
        } else {
            endDateHelp.style.color = '#6b7280';
        }
    }
});
</script>
@endsection