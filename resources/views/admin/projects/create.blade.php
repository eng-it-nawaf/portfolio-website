@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-profile.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">إنشاء مشروع جديد</h6>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان المشروع</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="category" class="form-label">الفئة</label>
                            <select class="form-select" id="category" name="category" required>
                                @foreach($categories as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="completed_at" class="form-label">تاريخ الإكمال</label>
                            <input type="date" class="form-control" id="completed_at" name="completed_at" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="github_url" class="form-label">رابط GitHub</label>
                            <input type="url" class="form-control" id="github_url" name="github_url">
                        </div>
                        
                        <div class="mb-3">
                            <label for="demo_url" class="form-label">رابط Demo</label>
                            <input type="url" class="form-control" id="demo_url" name="demo_url">
                        </div>
                        
                        <div class="mb-3">
                            <label for="play_store_url" class="form-label">رابط Google Play</label>
                            <input type="url" class="form-control" id="play_store_url" name="play_store_url">
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">وصف المشروع</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="technologies" class="form-label">التقنيات المستخدمة (افصل بينها بفواصل)</label>
                    <textarea class="form-control" id="technologies" name="technologies" rows="3" required></textarea>
                    <small class="text-muted">مثال: Laravel, Vue.js, MySQL, Tailwind CSS</small>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-bold">صور المشروع</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                    <div id="image-preview" class="row mt-3"></div>
                </div>
                
                <button type="submit" class="btn btn-primary">إنشاء المشروع</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    for (const file of e.target.files) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-3 mb-3';
            col.innerHTML = `
                <div class="card">
                    <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection