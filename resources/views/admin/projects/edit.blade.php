@extends('admin.layouts.app')

@section('title', 'تعديل المشروع')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-projects.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تعديل المشروع</h1>
            <p class="page-description">تعديل مشروع: {{ $project->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="project-card">
        <div class="card-body">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="project-form">
                @csrf
                @method('PUT')
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">عنوان المشروع</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $project->title) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="category" class="form-label">فئة المشروع</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>ويب</option>
                                <option value="mobile" {{ old('category', $project->category) == 'mobile' ? 'selected' : '' }}>موبايل</option>
                                <option value="desktop" {{ old('category', $project->category) == 'desktop' ? 'selected' : '' }}>سطح المكتب</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="completed_at" class="form-label">تاريخ الإكمال</label>
                            <input type="date" class="form-control" id="completed_at" name="completed_at"
                                   value="{{ old('completed_at', $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">حالة المشروع</label>
                            <div class="status-toggle">
                                <label class="toggle-label">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
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
                                       value="{{ old('github_url', $project->github_url) }}"
                                       placeholder="https://github.com/username/project">
                            </div>
                        </div>
                        
                        <div class="form-group url-input-group">
                            <label for="demo_url" class="form-label">رابط Demo</label>
                            <div class="input-wrapper">
                                <i class="fas fa-external-link-alt input-icon"></i>
                                <input type="url" class="form-control" id="demo_url" name="demo_url" 
                                       value="{{ old('demo_url', $project->demo_url) }}"
                                       placeholder="https://example.com/demo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group url-input-group">
                            <label for="play_store_url" class="form-label">رابط Google Play</label>
                            <div class="input-wrapper">
                                <i class="fab fa-google-play input-icon"></i>
                                <input type="url" class="form-control" id="play_store_url" name="play_store_url" 
                                       value="{{ old('play_store_url', $project->play_store_url) }}"
                                       placeholder="https://play.google.com/store/apps/details?id=com.example">
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
                        <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $project->description) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="technologies" class="form-label">التقنيات المستخدمة</label>
                        <textarea class="form-control" id="technologies" name="technologies" rows="3" required
                                  placeholder="افصل بين التقنيات بفواصل (مثال: HTML, CSS, JavaScript)">{{ old('technologies', $project->technologies) }}</textarea>
                        <div class="form-text">اكتب التقنيات المستخدمة في المشروع مفصولة بفواصل</div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-images"></i> معرض الصور
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label">صور المشروع الحالية</label>
                        
                        <div class="media-container">
                            @foreach($project->images as $image)
                            <div class="media-preview">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="صورة المشروع">
                                <button type="button" class="btn-remove-media" 
                                        onclick="removeImage({{ $image->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                            </div>
                            @endforeach
                            
                            <div class="btn-add-media" onclick="document.getElementById('new_images').click()">
                                <i class="fas fa-plus"></i>
                                <span>إضافة صور جديدة</span>
                                <input type="file" id="new_images" style="display: none;" 
                                       name="new_images[]" multiple accept="image/*" onchange="previewNewImages(this)">
                            </div>
                        </div>
                        
                        <div id="new-images-preview" class="image-preview-grid mt-3"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> حفظ التغييرات
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
function removeImage(imageId) {
    if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
        fetch(`/admin/projects/{{ $project->id }}/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the image preview from DOM
                const imageElement = document.querySelector(`.media-preview img[src*="${imageId}"]`);
                if (imageElement) {
                    imageElement.closest('.media-preview').remove();
                }
            } else {
                alert('حدث خطأ أثناء حذف الصورة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الصورة');
        });
    }
}

function previewNewImages(input) {
    const preview = document.getElementById('new-images-preview');
    preview.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        const files = Array.from(input.files).slice(0, 10); // Limit to 10 images
        
        files.forEach((file) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="معاينة الصورة الجديدة">
                        <button type="button" class="preview-remove" onclick="removeNewPreview(this, '${file.name}')">
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

function removeNewPreview(button, fileName) {
    button.closest('.preview-item').remove();
    
    // Remove the file from input
    const fileInput = document.getElementById('new_images');
    const dt = new DataTransfer();
    const files = Array.from(fileInput.files);
    
    files.forEach(file => {
        if (file.name !== fileName) {
            dt.items.add(file);
        }
    });
    
    fileInput.files = dt.files;
}
</script>
@endsection