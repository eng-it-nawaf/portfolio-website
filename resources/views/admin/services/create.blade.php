@extends('admin.layouts.app')

@section('title', 'إضافة خدمة جديدة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-services.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إضافة خدمة جديدة</h1>
            <p class="page-description">أضف خدمتك الجديدة مع جميع التفاصيل والميزات</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="service-form">
                @csrf
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">عنوان الخدمة</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required 
                                   placeholder="أدخل عنوان الخدمة">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="icon" class="form-label">أيقونة الخدمة</label>
                            <input type="text" class="form-control" id="icon" name="icon" 
                                   value="{{ old('icon') }}" placeholder="مثال: fas fa-code">
                            <div class="form-text">استخدم أسماء أيقونات Font Awesome</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">الوصف المختصر</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required 
                                  placeholder="اكتب وصفاً مختصراً عن الخدمة">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="content" class="form-label">المحتوى الكامل</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="6" required 
                                  placeholder="اكتب المحتوى الكامل للخدمة">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-image"></i> صورة الخدمة
                    </h3>
                    
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <label for="image" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>انقر لرفع صورة الخدمة</span>
                            <small>الحجم المقترح: 800x600 بكسل</small>
                        </label>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="file-preview"></div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-star"></i> ميزات الخدمة
                    </h3>
                    
                    <div id="features-container" class="features-container">
                        @if(old('features'))
                            @foreach(old('features') as $feature)
                            <div class="feature-item">
                                <input type="text" name="features[]" class="feature-input" 
                                       value="{{ $feature }}" placeholder="أدخل ميزة جديدة">
                                <button type="button" class="btn-remove remove-feature">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn-add" id="add-feature">
                        <i class="fas fa-plus"></i> إضافة ميزة جديدة
                    </button>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-list-ol"></i> خطوات العمل
                    </h3>
                    
                    <div id="process-container" class="process-container">
                        @if(old('process'))
                            @foreach(old('process') as $step)
                            <div class="process-item">
                                <input type="text" name="process[]" class="process-input" 
                                       value="{{ $step }}" placeholder="أدخل خطوة جديدة">
                                <button type="button" class="btn-remove remove-process">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn-add" id="add-process">
                        <i class="fas fa-plus"></i> إضافة خطوة جديدة
                    </button>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-cog"></i> الإعدادات
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" 
                                       name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                            </div>
                            <div class="form-text">عرض الخدمة كخدمة مميزة في الواجهة الأمامية</div>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">تفعيل الخدمة</label>
                            </div>
                            <div class="form-text">إظهار الخدمة للزوار في الواجهة الأمامية</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="order" class="form-label">ترتيب العرض</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', 0) }}" min="0">
                        <div class="form-text">رقم الترتيب لعرض الخدمات (الأصغر يظهر أولاً)</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> حفظ الخدمة
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: flex-start;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    margin-top: 30px;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 4px;
    font-size: 12px;
    color: var(--danger-color);
}

.form-control.is-invalid {
    border-color: var(--danger-color);
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
document.addEventListener('DOMContentLoaded', function() {
    // إضافة ميزة جديدة
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const featureItem = document.createElement('div');
        featureItem.className = 'feature-item';
        featureItem.innerHTML = `
            <input type="text" name="features[]" class="feature-input" placeholder="أدخل ميزة جديدة">
            <button type="button" class="btn-remove remove-feature">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(featureItem);
    });

    // إضافة خطوة جديدة
    document.getElementById('add-process').addEventListener('click', function() {
        const container = document.getElementById('process-container');
        const processItem = document.createElement('div');
        processItem.className = 'process-item';
        processItem.innerHTML = `
            <input type="text" name="process[]" class="process-input" placeholder="أدخل خطوة جديدة">
            <button type="button" class="btn-remove remove-process">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(processItem);
    });

    // حذف ميزة أو خطوة
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature') || e.target.closest('.remove-process')) {
            e.target.closest('.feature-item, .process-item').remove();
        }
    });
});

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'معاينة الصورة';
            preview.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection