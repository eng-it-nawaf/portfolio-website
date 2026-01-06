@extends('admin.layouts.app')

@section('title', 'تفاصيل الخدمة: ' . $service->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">الخدمات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تفاصيل الخدمة</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-eye text-info me-2"></i>
                    تفاصيل الخدمة: {{ $service->title }}
                </h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i> تعديل
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right me-2"></i> رجوع
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- المعلومات الأساسية -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        المعلومات الأساسية
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h2 class="h4 mb-3">{{ $service->title }}</h2>
                            <p class="text-muted mb-4">{{ $service->description }}</p>
                            
                            <div class="d-flex align-items-center gap-3 mb-4">
                                @if($service->icon)
                                <div class="bg-primary text-white p-3 rounded">
                                    <i class="{{ $service->icon }} fa-2x"></i>
                                </div>
                                @endif
                                <div>
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}">
                                            <i class="fas fa-{{ $service->is_active ? 'check-circle' : 'times-circle' }} me-1"></i>
                                            {{ $service->is_active ? 'نشط' : 'معطل' }}
                                        </span>
                                        @if($service->is_featured)
                                        <span class="badge bg-warning">
                                            <i class="fas fa-star me-1"></i> مميز
                                        </span>
                                        @endif
                                        <span class="badge bg-info">
                                            <i class="fas fa-sort-numeric-up me-1"></i>
                                            ترتيب: {{ $service->order }}
                                        </span>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar me-1"></i>
                                        تم الإنشاء: {{ $service->created_at->format('Y/m/d - H:i') }} |
                                        آخر تحديث: {{ $service->updated_at->format('Y/m/d - H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($service->image)
                            <div class="text-center">
                                <img src="{{ Storage::url($service->image) }}" 
                                     alt="{{ $service->title }}" 
                                     class="img-fluid rounded shadow" 
                                     style="max-height: 200px;">
                                <div class="mt-2">
                                    <small class="text-muted">صورة الخدمة</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- المحتوى الكامل -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-file-alt me-2"></i>
                            المحتوى الكامل
                        </h5>
                        <div class="content-box p-3 bg-light rounded">
                            {!! $service->content !!}
                        </div>
                    </div>

                    <!-- المشاريع المرتبطة -->
                    @if($service->projects->count() > 0)
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-project-diagram me-2"></i>
                            المشاريع المرتبطة
                            <span class="badge bg-secondary">{{ $service->projects->count() }}</span>
                        </h5>
                        <div class="row g-3">
                            @foreach($service->projects as $project)
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $project->title }}</h6>
                                        <p class="card-text text-muted small">{{ Str::limit($project->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-info">{{ $project->category }}</span>
                                            <a href="{{ route('admin.projects.show', $project->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- معلومات إضافية -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        معلومات الخدمة
                    </h5>
                </div>
                <div class="card-body">
                    <!-- صورة الغلاف -->
                    @if($service->cover_image)
                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-image me-2"></i>
                            صورة الغلاف
                        </h6>
                        <img src="{{ Storage::url($service->cover_image) }}" 
                             alt="{{ $service->title }}" 
                             class="img-fluid rounded shadow" 
                             style="max-height: 150px;">
                    </div>
                    @endif

                    <!-- معلومات SEO -->
                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-search me-2"></i>
                            معلومات SEO
                        </h6>
                        <div class="bg-light p-3 rounded small">
                            @if($service->meta_title)
                            <div class="mb-2">
                                <strong>العنوان:</strong><br>
                                {{ $service->meta_title }}
                            </div>
                            @endif
                            @if($service->meta_description)
                            <div class="mb-2">
                                <strong>الوصف:</strong><br>
                                {{ $service->meta_description }}
                            </div>
                            @endif
                            @if($service->meta_keywords)
                            <div>
                                <strong>الكلمات الدلالية:</strong><br>
                                {{ $service->meta_keywords }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- الإجراءات السريعة -->
                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-bolt me-2"></i>
                            إجراءات سريعة
                        </h6>
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.services.toggle-status', $service->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-danger' : 'btn-success' }} w-100">
                                    <i class="fas fa-{{ $service->is_active ? 'times-circle' : 'check-circle' }} me-1"></i>
                                    {{ $service->is_active ? 'تعطيل الخدمة' : 'تفعيل الخدمة' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.services.toggle-featured', $service->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $service->is_featured ? 'btn-secondary' : 'btn-warning' }} w-100">
                                    <i class="fas fa-star me-1"></i>
                                    {{ $service->is_featured ? 'إلغاء التميز' : 'تمييز الخدمة' }}
                                </button>
                            </form>
                            
                            <a href="{{ route('services.show', $service->slug) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-info w-100">
                                <i class="fas fa-external-link-alt me-1"></i>
                                عرض في الموقع
                            </a>
                        </div>
                    </div>

                    <!-- إحصائيات -->
                    <div>
                        <h6 class="mb-2">
                            <i class="fas fa-chart-pie me-2"></i>
                            إحصائيات
                        </h6>
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="bg-primary text-white p-2 rounded">
                                    <div class="h5 mb-0">{{ $service->projects->count() }}</div>
                                    <small>المشاريع</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-success text-white p-2 rounded">
                                    <div class="h5 mb-0">{{ $service->is_active ? 1 : 0 }}</div>
                                    <small>الحالة</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-warning text-white p-2 rounded">
                                    <div class="h5 mb-0">{{ $service->is_featured ? 1 : 0 }}</div>
                                    <small>التصنيف</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-info text-white p-2 rounded">
                                    <div class="h5 mb-0">{{ $service->order }}</div>
                                    <small>الترتيب</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- روابط سريعة -->
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-link me-2"></i>
                        روابط سريعة
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit text-warning me-2"></i>
                            تعديل الخدمة
                        </a>
                        <a href="{{ route('admin.projects.create') }}?service={{ $service->id }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle text-success me-2"></i>
                            إضافة مشروع مرتبط
                        </a>
                        <a href="#" class="list-group-item list-group-item-action text-danger" 
                           onclick="event.preventDefault(); if(confirm('هل أنت متأكد من حذف هذه الخدمة؟')){ document.getElementById('delete-form').submit(); }">
                            <i class="fas fa-trash me-2"></i>
                            حذف الخدمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- نموذج حذف الخدمة -->
<form id="delete-form" action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<style>
.content-box {
    border: 1px solid #dee2e6;
    background-color: #fff;
}

.content-box p {
    margin-bottom: 1rem;
}

.content-box ul, .content-box ol {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.content-box h1, .content-box h2, .content-box h3, .content-box h4, .content-box h5, .content-box h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.list-group-item {
    border: none;
    padding: 0.75rem 0;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}
</style>
@endsection