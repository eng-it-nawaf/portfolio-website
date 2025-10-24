@extends('admin.layouts.app')

@push('styles')
<style>
    .project-edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .project-card {
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        background-color: #fff;
    }
    
    .card-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-title {
        font-weight: 600;
        margin-bottom: 0;
        font-size: 1.25rem;
    }
    
    .btn-back {
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        transition: all 0.3s;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        display: flex;
        align-items: center;
    }
    
    .btn-back:hover {
        background-color: rgba(255, 255, 255, 0.3);
        text-decoration: none;
    }
    
    .btn-back i {
        margin-right: 0.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
        width: 100%;
        background-color: #fff;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        outline: none;
    }
    
    .media-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }
    
    .media-preview {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        aspect-ratio: 1/1;
        background-color: #f8f9fa;
    }
    
    .media-preview:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    
    .media-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .btn-remove-media {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        opacity: 0;
        transition: all 0.3s;
        background-color: #e53e3e;
        color: white;
        border: none;
        cursor: pointer;
    }
    
    .media-preview:hover .btn-remove-media {
        opacity: 1;
    }
    
    .btn-add-media {
        background-color: #f7fafc;
        border: 2px dashed #cbd5e0;
        color: #4a5568;
        border-radius: 8px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        aspect-ratio: 1/1;
    }
    
    .btn-add-media:hover {
        border-color: #4299e1;
        color: #4299e1;
        background-color: #ebf8ff;
    }
    
    .btn-add-media i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s;
        color: white;
        border-radius: 8px;
        font-size: 1rem;
        margin-top: 1rem;
        cursor: pointer;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .url-input-group {
        position: relative;
    }
    
    .url-input-group .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #718096;
        font-size: 1rem;
    }
    
    .url-input-group .form-control {
        padding-left: 3rem;
    }
    
    .form-text {
        color: #718096;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    @media (max-width: 768px) {
        .project-edit-container {
            padding: 1rem;
        }
        
        .media-container {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .btn-back {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .media-container {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">تعديل الخدمة: {{ $service->title }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">عنوان الخدمة *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $service->title) }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">الوصف المختصر *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">المحتوى الكامل *</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="5" required>{{ old('content', $service->content) }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="icon">أيقونة (Font Awesome)</label>
                    <input type="text" class="form-control" id="icon" name="icon" 
                           value="{{ old('icon', $service->icon) }}" placeholder="مثال: fas fa-code">
                </div>

                <div class="form-group">
                    <label for="image">صورة الخدمة</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                           id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if($service->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->title }}" 
                                 style="max-height: 100px;">
                            <a href="#" class="text-danger" onclick="event.preventDefault(); document.getElementById('remove-image').submit();">
                                <i class="fas fa-trash"></i> حذف الصورة
                            </a>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>ميزات الخدمة</label>
                    {{--  <div id="features-container">
                        @foreach(old('features', is_array($service->features) ? $service->features : []) as $feature)
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-feature" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>  --}}
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-feature">
                        <i class="fas fa-plus"></i> إضافة ميزة
                    </button>
                </div>

                <div class="form-group">
                    <label>خطوات العمل</label>
                    {{--  <div id="process-container">
                        @foreach(old('process', is_array($service->process) ? $service->process : []) as $step)
                        <div class="input-group mb-2">
                            <input type="text" name="process[]" class="form-control" value="{{ $step }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-process" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach  --}}
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-process">
                        <i class="fas fa-plus"></i> إضافة خطوة
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_featured" 
                                   name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">الحالة النشطة</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="order">ترتيب العرض</label>
                            <input type="number" class="form-control" id="order" name="order" 
                                   value="{{ old('order', $service->order) }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> تحديث
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> إلغاء
                </a>
            </form>

            @if($service->image)
            <form id="remove-image" action="{{ route('admin.services.remove-image', $service->id) }}" 
                  method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif
        </div>
    </div>
</div>
@endsection