@extends('admin.layouts.app')

@section('title', 'تعديل الخدمة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-services.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تعديل الخدمة</h1>
            <p class="page-description">تعديل خدمة: {{ $service->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="service-card">
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="service-form">
                @csrf
                @method('PUT')
                
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">عنوان الخدمة</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $service->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="icon" class="form-label">أيقونة الخدمة</label>
                            <input type="text" class="form-control" id="icon" name="icon" 
                                   value="{{ old('icon', $service->icon) }}" placeholder="مثال: fas fa-code">
                            <div class="form-text">استخدم أسماء أيقونات Font Awesome</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">الوصف المختصر</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="content" class="form-label">المحتوى الكامل</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="6" required>{{ old('content', $service->content) }}</textarea>
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
                            <span>انقر لتغيير صورة الخدمة</span>
                            <small>اتركه فارغاً للحفاظ على الصورة الحالية</small>
                        </label>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        @if($service->image)
                        <div class="file-preview">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->title }}" 
                                 style="max-height: 150px;">
                            <div class="mt-2">
                                <a href="#" class="text-danger" onclick="event.preventDefault(); document.getElementById('remove-image').submit();">
                                    <i class="fas fa-trash"></i> حذف الصورة الحالية
                                </a>
                            </div>
                        </div>
                        @else
                        <div id="image-preview" class="file-preview"></div>
                        @endif
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-star"></i> ميزات الخدمة
                    </h3>
                    
                    <div id="features-container" class="features-container">
                        @php
                            // معالجة البيانات القديمة أولاً
                            $features = old('features', []);
                            
                            // إذا لم تكن هناك بيانات قديمة، استخدم بيانات الخدمة
                            if (empty($features)) {
                                $features = $service->features;
                                
                                // إذا كانت سلسلة نصية، حاول تحويلها إلى مصفوفة
                                if (is_string($features)) {
                                    $decoded = json_decode($features, true);
                                    $features = is_array($decoded) ? $decoded : [];
                                }
                                
                                // تأكد أن $features هي مصفوفة
                                $features = is_array($features) ? $features : [];
                            }
                        @endphp
                        
                        @foreach($features as $feature)
                            @if(is_string($feature) && !empty(trim($feature)))
                            <div class="feature-item">
                                <input type="text" name="features[]" class="feature-input" 
                                       value="{{ $feature }}" placeholder="أدخل ميزة جديدة">
                                <button type="button" class="btn-remove remove-feature">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif
                        @endforeach
                        
                        {{-- إذا لم توجد ميزات، أضف حقل واحد فارغ --}}
                        @if(count($features) === 0)
                        <div class="feature-item">
                            <input type="text" name="features[]" class="feature-input" 
                                   placeholder="أدخل ميزة جديدة">
                            <button type="button" class="btn-remove remove-feature">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
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
                        @php
                            // معالجة البيانات القديمة أولاً
                            $process = old('process', []);
                            
                            // إذا لم تكن هناك بيانات قديمة، استخدم بيانات الخدمة
                            if (empty($process)) {
                                $process = $service->process;
                                
                                // إذا كانت سلسلة نصية، حاول تحويلها إلى مصفوفة
                                if (is_string($process)) {
                                    $decoded = json_decode($process, true);
                                    $process = is_array($decoded) ? $decoded : [];
                                }
                                
                                // تأكد أن $process هي مصفوفة
                                $process = is_array($process) ? $process : [];
                            }
                        @endphp
                        
                        @foreach($process as $step)
                            @if(is_string($step) && !empty(trim($step)))
                            <div class="process-item">
                                <input type="text" name="process[]" class="process-input" 
                                       value="{{ $step }}" placeholder="أدخل خطوة جديدة">
                                <button type="button" class="btn-remove remove-process">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif
                        @endforeach
                        
                        {{-- إذا لم توجد خطوات، أضف حقل واحد فارغ --}}
                        @if(count($process) === 0)
                        <div class="process-item">
                            <input type="text" name="process[]" class="process-input" 
                                   placeholder="أدخل خطوة جديدة">
                            <button type="button" class="btn-remove remove-process">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
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
                                       name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">تفعيل الخدمة</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="order" class="form-label">ترتيب العرض</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $service->order) }}" min="0">
                        <div class="form-text">رقم الترتيب لعرض الخدمات (الأصغر يظهر أولاً)</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
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
            const item = e.target.closest('.feature-item, .process-item');
            // لا تسمح بحذف الحقل الأخير
            const container = item.parentElement;
            if (container.children.length > 1) {
                item.remove();
            }
        }
    });
});

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    if (!preview) return;
    
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