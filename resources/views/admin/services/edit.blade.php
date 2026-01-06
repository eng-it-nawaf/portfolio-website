@extends('admin.layouts.app')

@section('title', 'تعديل الخدمة: ' . $service->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">الخدمات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تعديل الخدمة</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-edit text-warning me-2"></i>
                    تعديل الخدمة: {{ $service->title }}
                </h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-info">
                        <i class="fas fa-eye me-2"></i> عرض
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right me-2"></i> رجوع
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
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
                                           id="title" name="title" value="{{ old('title', $service->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">الوصف المختصر <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">المحتوى الكامل <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="8" required>{{ old('content', $service->content) }}</textarea>
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
                                           value="{{ old('icon', $service->icon) }}" placeholder="fas fa-code">
                                    <small class="text-muted">أيقونات Font Awesome</small>
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">ترتيب العرض</label>
                                    <input type="number" class="form-control" id="order" name="order" 
                                           value="{{ old('order', $service->order) }}" min="0">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" 
                                               name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" 
                                               name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">تفعيل الخدمة</label>
                                    </div>
                                </div>

                                <!-- حالة الخدمة -->
                                <div class="alert alert-light border">
                                    <h6 class="alert-heading mb-2">
                                        <i class="fas fa-info-circle me-2"></i>
                                        معلومات الخدمة
                                    </h6>
                                    <div class="row small">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <strong>المشاريع:</strong><br>
                                                <span class="badge bg-info">{{ $service->projects->count() }}</span>
                                            </div>
                                            <div class="mb-2">
                                                <strong>تاريخ الإنشاء:</strong><br>
                                                {{ $service->created_at->format('Y/m/d') }}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <strong>آخر تحديث:</strong><br>
                                                {{ $service->updated_at->format('Y/m/d') }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>الرابط:</strong><br>
                                                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="text-primary">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
                                <!-- صورة الخدمة -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">صورة الخدمة</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    
                                    @if($service->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($service->image) }}" 
                                             alt="{{ $service->title }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 150px;">
                                        <div class="mt-2">
                                            <a href="#" class="text-danger small" 
                                               onclick="event.preventDefault(); document.getElementById('remove-image-form').submit();">
                                                <i class="fas fa-trash me-1"></i> حذف الصورة
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- صورة الغلاف -->
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">صورة الغلاف</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
                                    
                                    @if($service->cover_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($service->cover_image) }}" 
                                             alt="{{ $service->title }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 150px;">
                                        <div class="mt-2">
                                            <a href="#" class="text-danger small" 
                                               onclick="event.preventDefault(); document.getElementById('remove-cover-image-form').submit();">
                                                <i class="fas fa-trash me-1"></i> حذف صورة الغلاف
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-search me-2"></i>
                                    SEO
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">عنوان SEO</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                           value="{{ old('meta_title', $service->meta_title) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">وصف SEO</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" 
                                              rows="3">{{ old('meta_description', $service->meta_description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">الكلمات الدلالية</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                           value="{{ old('meta_keywords', $service->meta_keywords) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i> حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times me-2"></i> إلغاء
                    </a>
                </div>
            </form>

            <!-- نماذج حذف الصور -->
            @if($service->image)
            <form id="remove-image-form" action="{{ route('admin.services.remove-image', $service->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif

            @if($service->cover_image)
            <form id="remove-cover-image-form" action="{{ route('admin.services.remove-cover-image', $service->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            @endif
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

.alert-light {
    background-color: #f8f9fa;
    border-color: #e9ecef;
}

.badge {
    font-size: 0.75em;
    padding: 0.35em 0.65em;
}
</style>
@endsection