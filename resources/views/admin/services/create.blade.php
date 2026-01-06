@extends('admin.layouts.app')

@section('title', 'إضافة خدمة جديدة')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">الخدمات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">إضافة خدمة جديدة</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-plus-circle text-primary me-2"></i>
                    إضافة خدمة جديدة
                </h1>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-lg-8">
                        <!-- المعلومات الأساسية -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    المعلومات الأساسية
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">عنوان الخدمة <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" 
                                           placeholder="أدخل عنوان الخدمة" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">الوصف المختصر <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3" 
                                              placeholder="أدخل وصفاً مختصراً للخدمة" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">المحتوى الكامل <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="8" 
                                              placeholder="أدخل المحتوى الكامل للخدمة" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- الإعدادات -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-cog me-2"></i>
                                    الإعدادات
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">أيقونة الخدمة</label>
                                    <input type="text" class="form-control" id="icon" name="icon" 
                                           value="{{ old('icon') }}" placeholder="fas fa-code">
                                    <small class="text-muted">أيقونات Font Awesome (مثال: fas fa-code)</small>
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">ترتيب العرض</label>
                                    <input type="number" class="form-control" id="order" name="order" 
                                           value="{{ old('order', 0) }}" min="0">
                                    <small class="text-muted">رقم الترتيب لعرض الخدمات (الأصغر يظهر أولاً)</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" 
                                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                                    </div>
                                    <small class="text-muted">عرض الخدمة كخدمة مميزة في الواجهة الأمامية</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" 
                                               name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">تفعيل الخدمة</label>
                                    </div>
                                    <small class="text-muted">إظهار الخدمة للزوار في الواجهة الأمامية</small>
                                </div>
                            </div>
                        </div>

                        <!-- الصور -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-images me-2"></i>
                                    الصور
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image" class="form-label">صورة الخدمة</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">الحجم المقترح: 800×600 بكسل</small>
                                </div>

                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">صورة الغلاف</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                           id="cover_image" name="cover_image" accept="image/*">
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">الحجم المقترح: 1920×1080 بكسل</small>
                                </div>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-search me-2"></i>
                                    تحسين محركات البحث (SEO)
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">عنوان SEO</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                           value="{{ old('meta_title') }}">
                                    <small class="text-muted">عنوان الصفحة في نتائج البحث</small>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">وصف SEO</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" 
                                              rows="3">{{ old('meta_description') }}</textarea>
                                    <small class="text-muted">وصف مختصر يظهر في نتائج البحث</small>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">الكلمات الدلالية</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                           value="{{ old('meta_keywords') }}">
                                    <small class="text-muted">كلمات دلالية مفصولة بفاصلة</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i> حفظ الخدمة
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times me-2"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-check.form-switch {
    padding-left: 2.5em;
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
}

.card-header {
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.25rem;
    background-color: #f8f9fa;
    border-radius: 10px 10px 0 0 !important;
}
</style>

<script>
// معاينة الصور
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (preview) {
        preview.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid mt-2';
                img.style.maxHeight = '150px';
                img.style.borderRadius = '8px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

document.getElementById('image').addEventListener('change', function() {
    previewImage(this, 'image-preview');
});

document.getElementById('cover_image').addEventListener('change', function() {
    previewImage(this, 'cover-image-preview');
});
</script>
@endsection