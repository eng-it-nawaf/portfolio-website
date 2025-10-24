@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-projects.css') }}">
@endpush

@section('content')
<div class="container-fluid project-management">
    <div class="card project-card">
        <div class="card-header">
            <h5 class="card-title mb-0">إنشاء مشروع جديد</h5>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-project btn-project-secondary">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST" class="project-form">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان المشروع</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">نوع المشروع</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="web" {{ old('type') == 'web' ? 'selected' : '' }}>ويب</option>
                                <option value="mobile" {{ old('type') == 'mobile' ? 'selected' : '' }}>موبايل</option>
                                <option value="desktop" {{ old('type') == 'desktop' ? 'selected' : '' }}>سطح المكتب</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="completed_at" class="form-label">تاريخ الإكمال</label>
                            <input type="date" class="form-control" id="completed_at" name="completed_at" value="{{ old('completed_at') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="github_url" class="form-label">رابط GitHub</label>
                            <input type="url" class="form-control" id="github_url" name="github_url" value="{{ old('github_url') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="demo_url" class="form-label">رابط Demo</label>
                            <input type="url" class="form-control" id="demo_url" name="demo_url" value="{{ old('demo_url') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="play_store_url" class="form-label">رابط Google Play</label>
                            <input type="url" class="form-control" id="play_store_url" name="play_store_url" value="{{ old('play_store_url') }}">
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">وصف المشروع</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">التقنيات المستخدمة</label>
                    <div class="row">
                        @foreach($technologies as $tech)
                        <div class="col-md-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="tech-{{ $tech->id }}" 
                                       name="technologies[]" 
                                       value="{{ $tech->id }}"
                                       {{ in_array($tech->id, old('technologies', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tech-{{ $tech->id }}">
                                    {{ $tech->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">صور المشروع</label>
                    <div id="media-container" class="row">
                        <!-- سيتم إضافة الصور هنا عبر JavaScript -->
                    </div>
                    <button type="button" class="btn btn-project btn-project-secondary mt-2" onclick="document.getElementById('media-upload').click()">
                        <i class="fas fa-plus"></i> إضافة صورة
                    </button>
                    <input type="file" id="media-upload" style="display: none;" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-project btn-project-primary">إنشاء المشروع</button>
            </form>
        </div>
    </div>
</div>

{{--  @push('styles')
<link href="{{ asset('css/admin-projects.css') }}" rel="stylesheet">
@endpush  --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaUpload = document.getElementById('media-upload');
    
    mediaUpload.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            const formData = new FormData();
            formData.append('media', files[0]);
            
            fetch("{{ route('admin.projects.storeMedia', ['project' => 'new']) }}", {
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
            });
        }
    });
    
    function addMediaToForm(id, url) {
        const container = document.getElementById('media-container');
        
        const col = document.createElement('div');
        col.className = 'col-md-3 mb-3';
        
        col.innerHTML = `
            <div class="media-preview">
                <img src="${url}" alt="معاينة الصورة">
                <button type="button" class="btn btn-project btn-project-danger btn-remove-media" onclick="removeMedia(this, ${id})">
                    <i class="fas fa-trash"></i>
                </button>
                <input type="hidden" name="media_ids[]" value="${id}">
            </div>
        `;
        
        container.appendChild(col);
    }
    
    window.removeMedia = function(button, id) {
        if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
            fetch(`/admin/projects/new/media/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.closest('.col-md-3').remove();
                }
            });
        }
    };
});
</script>
@endpush
@endsection