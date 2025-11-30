@extends('admin.layouts.app')

@section('title', 'إضافة خبرة جديدة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-experiences.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إضافة خبرة جديدة</h1>
            <p class="page-description">أضف خبرتك العملية أو التعليمية الجديدة</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="experience-card">
        <div class="card-body">
            <form action="{{ route('admin.experiences.store') }}" method="POST" class="experience-form">
                @csrf
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">المسمى الوظيفي / المؤهل</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required placeholder="مثال: مطور ويب، بكالوريوس علوم حاسب">
                        </div>
                        
                        <div class="form-group">
                            <label for="company" class="form-label">اسم الشركة / المؤسسة</label>
                            <input type="text" class="form-control" id="company" name="company" 
                                   value="{{ old('company') }}" required placeholder="مثال: شركة التقنية، جامعة الملك سعود">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="type" class="form-label">نوع الخبرة</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="work" {{ old('type') == 'work' ? 'selected' : '' }}>خبرة عملية</option>
                                <option value="education" {{ old('type') == 'education' ? 'selected' : '' }}>خبرة تعليمية</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">حالة الخبرة</label>
                            <div class="status-toggle">
                                <label class="toggle-label">
                                    <input type="checkbox" name="is_current" value="1" {{ old('is_current') ? 'checked' : '' }} 
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
                                   value="{{ old('start_date') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ old('end_date') }}" {{ old('is_current') ? 'disabled' : '' }}>
                            <div class="form-text" id="end-date-help">
                                اتركه فارغاً إذا كانت الخبرة مستمرة
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
                        <textarea class="form-control" id="description" name="description" rows="6" 
                                  placeholder="اكتب وصفاً مفصلاً عن المهام والمسؤوليات أو المواد الدراسية...">{{ old('description') }}</textarea>
                        <div class="form-text">
                            يمكنك كتابة المهام والمسؤوليات أو المواد الدراسية والإنجازات
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> حفظ الخبرة
                    </button>
                    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.status-toggle {
    margin-top: 8px;
}

.toggle-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    font-size: 13px;
    color: var(--dark-color);
}

.toggle-label input {
    display: none;
}

.toggle-slider {
    width: 44px;
    height: 24px;
    background: #d1d5db;
    border-radius: 12px;
    position: relative;
    transition: all 0.3s ease;
}

.toggle-slider:before {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: white;
    top: 3px;
    left: 3px;
    transition: all 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.toggle-label input:checked + .toggle-slider {
    background: var(--success-color);
}

.toggle-label input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

.toggle-text {
    font-weight: 500;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: flex-start;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    margin-top: 30px;
}

@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .form-actions .btn {
        justify-content: center;
    }
}
</style>

<script>
function toggleEndDate(checkbox) {
    const endDateInput = document.getElementById('end_date');
    const endDateHelp = document.getElementById('end-date-help');
    
    endDateInput.disabled = checkbox.checked;
    
    if (checkbox.checked) {
        endDateInput.value = '';
        endDateHelp.textContent = 'تم تعطيل الحقل لأن الخبرة مستمرة';
        endDateHelp.style.color = var(--success-color);
    } else {
        endDateHelp.textContent = 'اتركه فارغاً إذا كانت الخبرة مستمرة';
        endDateHelp.style.color = var(--secondary-color);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const isCurrentCheckbox = document.querySelector('input[name="is_current"]');
    if (isCurrentCheckbox) {
        toggleEndDate(isCurrentCheckbox);
    }
});
</script>
@endsection