@extends('admin.layouts.app')



@section('content')
<div class="project-edit-container">
    <div class="card project-card">
        <div class="card-header">
            <h5 class="card-title">تعديل المشروع: {{ $project->title }}</h5>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- القسم الأول -->
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="title" class="form-label">عنوان المشروع</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $project->title) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="category" class="form-label">فئة المشروع</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>ويب</option>
                                <option value="mobile" {{ old('category', $project->category) == 'mobile' ? 'selected' : '' }}>موبايل</option>
                                <option value="desktop" {{ old('category', $project->category) == 'desktop' ? 'selected' : '' }}>سطح المكتب</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="completed_at" class="form-label">تاريخ الإكمال</label>
                            <input type="date" class="form-control" id="completed_at" name="completed_at"
                                   value="{{ old('completed_at', $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                    
                    <!-- القسم الثاني -->
                    <div class="col-lg-6">
                        <div class="mb-4 url-input-group">
                            <label for="github_url" class="form-label">رابط GitHub</label>
                            <div class="position-relative">
                                <i class="fab fa-github input-icon"></i>
                                <input type="url" class="form-control" id="github_url" name="github_url" 
                                       placeholder="https://github.com/username/project"
                                       value="{{ old('github_url', $project->github_url) }}">
                            </div>
                        </div>
                        
                        <div class="mb-4 url-input-group">
                            <label for="demo_url" class="form-label">رابط Demo</label>
                            <div class="position-relative">
                                <i class="fas fa-external-link-alt input-icon"></i>
                                <input type="url" class="form-control" id="demo_url" name="demo_url" 
                                       placeholder="https://example.com/demo"
                                       value="{{ old('demo_url', $project->demo_url) }}">
                            </div>
                        </div>
                        
                        <div class="mb-4 url-input-group">
                            <label for="play_store_url" class="form-label">رابط Google Play</label>
                            <div class="position-relative">
                                <i class="fab fa-google-play input-icon"></i>
                                <input type="url" class="form-control" id="play_store_url" name="play_store_url" 
                                       placeholder="https://play.google.com/store/apps/details?id=com.example"
                                       value="{{ old('play_store_url', $project->play_store_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- الوصف -->
                <div class="mb-4">
                    <label for="description" class="form-label">نبذة عن المشروع</label>
                    <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $project->description) }}</textarea>
                </div>
                
                <!-- التقنيات -->
                <div class="mb-4">
                    <label for="technologies" class="form-label">التقنيات المستخدمة</label>
                    <textarea class="form-control" id="technologies" name="technologies" rows="3" 
                              placeholder="افصل بين التقنيات بفواصل (مثال: HTML, CSS, JavaScript)">{{ old('technologies', $project->technologies) }}</textarea>
                    <div class="form-text">اكتب التقنيات المستخدمة في المشروع مفصولة بفواصل</div>
                </div>
                
                <!-- معرض الصور -->
                <div class="mb-5">
                    <label class="form-label">صور المشروع</label>
                    
                    <div id="media-container" class="media-container">
                        @foreach($project->images as $image)
                        <div class="media-preview">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="صورة المشروع">
                            <button type="button" class="btn btn-remove-media" 
                                    onclick="removeMedia(this, {{ $image->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <input type="hidden" name="media_ids[]" value="{{ $image->id }}">
                        </div>
                        @endforeach
                        
                        <div class="btn-add-media" onclick="document.getElementById('media-upload').click()">
                            <i class="fas fa-plus"></i>
                            <span>إضافة صورة</span>
                            <input type="file" id="media-upload" style="display: none;" 
                                   accept="image/*" multiple>
                        </div>
                    </div>
                </div>
                
                <!-- زر الحفظ -->
                <div class="text-center">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i> حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaUpload = document.getElementById('media-upload');
    
    mediaUpload.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const formData = new FormData();
                formData.append('image', file);
                
              fetch("{{ route('admin.projects.uploadImage', $project) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.url) {
                        addMediaToForm(data.id, data.url);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء رفع الصورة');
                });
            });
        }
    });
    
    function addMediaToForm(id, url) {
        const container = document.getElementById('media-container');
        const addButton = container.querySelector('.btn-add-media');
        
        const mediaPreview = document.createElement('div');
        mediaPreview.className = 'media-preview';
        mediaPreview.innerHTML = `
            <img src="${url}" alt="معاينة الصورة">
            <button type="button" class="btn btn-remove-media" onclick="removeMedia(this, ${id})">
                <i class="fas fa-trash"></i>
            </button>
            <input type="hidden" name="media_ids[]" value="${id}">
        `;
        
        container.insertBefore(mediaPreview, addButton);
    }
});

{{--  function removeMedia(button, id) {
    if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
        fetch("{{ route('admin.projects.deleteImage', ['project' => $project->id, 'image' => '']) }}/" + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.closest('.media-preview').remove();
            } else {
                alert('حدث خطأ أثناء حذف الصورة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الصورة');
        });
    }
}  --}}
</script>
@endpush