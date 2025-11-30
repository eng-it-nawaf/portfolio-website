@extends('admin.layouts.app')

@section('title', 'إنشاء مشروع جديد')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-projects.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إنشاء مشروع جديد</h1>
            <p class="page-description">أضف مشروعك الجديد مع جميع التفاصيل والصور</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="project-card">
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="project-form">
                @csrf
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">عنوان المشروع</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required placeholder="أدخل عنوان المشروع">
                        </div>
                        
                        <div class="form-group">
                            <label for="category" class="form-label">فئة المشروع</label>
                            <select class="form-select" id="category" name="category" required>
                                @foreach($categories as $value => $label)
                                    <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="completed_at" class="form-label">تاريخ الإكمال</label>
                            <input type="date" class="form-control" id="completed_at" name="completed_at" 
                                   value="{{ old('completed_at') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">حالة المشروع</label>
                            <div class="status-toggle">
                                <label class="toggle-label">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                    <span class="toggle-text">مشروع نشط</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-link"></i> الروابط الخارجية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group url-input-group">
                            <label for="github_url" class="form-label">رابط GitHub</label>
                            <div class="input-wrapper">
                                <i class="fab fa-github input-icon"></i>
                                <input type="url" class="form-control" id="github_url" name="github_url" 
                                       value="{{ old('github_url') }}" placeholder="https://github.com/username/project">
                            </div>
                        </div>
                        
                        <div class="form-group url-input-group">
                            <label for="demo_url" class="form-label">رابط Demo</label>
                            <div class="input-wrapper">
                                <i class="fas fa-external-link-alt input-icon"></i>
                                <input type="url" class="form-control" id="demo_url" name="demo_url" 
                                       value="{{ old('demo_url') }}" placeholder="https://example.com/demo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group url-input-group">
                            <label for="play_store_url" class="form-label">رابط Google Play</label>
                            <div class="input-wrapper">
                                <i class="fab fa-google-play input-icon"></i>
                                <input type="url" class="form-control" id="play_store_url" name="play_store_url" 
                                       value="{{ old('play_store_url') }}" placeholder="https://play.google.com/store/apps/details?id=com.example">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <!-- مساحة إضافية للمحاذاة -->
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-file-alt"></i> محتوى المشروع
                    </h3>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">وصف المشروع</label>
                        <textarea class="form-control" id="description" name="description" rows="6" 
                                  required placeholder="اكتب وصفاً مفصلاً عن المشروع...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="technologies" class="form-label">التقنيات المستخدمة</label>
                        <textarea class="form-control" id="technologies" name="technologies" rows="3" 
                                  required placeholder="افصل بين التقنيات بفواصل (مثال: Laravel, Vue.js, MySQL)">{{ old('technologies') }}</textarea>
                        <div class="form-text">اكتب التقنيات واللغات والأدوات المستخدمة في المشروع</div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-images"></i> معرض الصور
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label">صور المشروع</label>
                        <input type="file" class="form-control" id="images" name="images[]" 
                               multiple accept="image/*" onchange="previewImages(this)">
                        <div class="form-text">يمكنك اختيار أكثر من صورة (الحد الأقصى: 10 صور)</div>
                        
                        <div id="image-preview" class="image-preview-grid mt-3"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> إنشاء المشروع
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
function previewImages(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        const files = Array.from(input.files).slice(0, 10); // Limit to 10 images
        
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="معاينة الصورة">
                        <button type="button" class="preview-remove" onclick="removePreview(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    preview.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

function removePreview(button) {
    button.closest('.preview-item').remove();
    
    // Update the file input
    const fileInput = document.getElementById('images');
    const files = Array.from(fileInput.files);
    const previewItems = document.querySelectorAll('.preview-item');
    
    // This is a simplified approach - in a real app you might want to use DataTransfer
    console.log('Preview removed - note: file input not updated in this demo');
}
</script>
@endsection