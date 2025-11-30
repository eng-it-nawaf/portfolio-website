@extends('admin.layouts.app')

@section('title', 'تفاصيل الخدمة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-services.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تفاصيل الخدمة</h1>
            <p class="page-description">عرض كافة معلومات الخدمة: {{ $service->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> تعديل الخدمة
            </a>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="service-details-grid">
        <!-- المحتوى الرئيسي -->
        <div class="service-content-section">
            <!-- بطاقة المعلومات الأساسية -->
            <div class="service-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                    </h3>
                    <div class="service-status">
                        @if($service->is_active)
                            <span class="badge badge-success">نشط</span>
                        @else
                            <span class="badge badge-danger">غير نشط</span>
                        @endif
                        @if($service->is_featured)
                            <span class="badge badge-primary">مميز</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="service-header">
                        @if($service->icon)
                        <div class="service-icon-large">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        @endif
                        <div class="service-title-section">
                            <h2 class="service-title-main">{{ $service->title }}</h2>
                            <p class="service-description-main">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- صورة الخدمة -->
            @if($service->image)
            <div class="service-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-image"></i> صورة الخدمة
                    </h3>
                </div>
                <div class="card-body">
                    <div class="service-image">
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ $service->title }}" 
                             class="service-img">
                    </div>
                </div>
            </div>
            @endif

            <!-- المحتوى الكامل -->
            <div class="service-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt"></i> المحتوى الكامل
                    </h3>
                </div>
                <div class="card-body">
                    <div class="service-content-full">
                        {!! $service->content !!}
                    </div>
                </div>
            </div>

            <!-- الميزات -->
            @php
                $features = $service->features ?? [];
                if (is_string($features)) {
                    $features = json_decode($features, true) ?? [];
                }
            @endphp
            @if(!empty($features))
            <div class="service-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-star"></i> ميزات الخدمة
                    </h3>
                </div>
                <div class="card-body">
                    <div class="features-list">
                        @foreach($features as $feature)
                        <div class="feature-item-display">
                            <i class="fas fa-check-circle"></i>
                            {{--  <span>{{ $feature }}</span>  --}}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- خطوات العمل -->
            @php
                $process = $service->process ?? [];
                if (is_string($process)) {
                    $process = json_decode($process, true) ?? [];
                }
            @endphp
            @if(!empty($process))
            <div class="service-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol"></i> خطوات العمل
                    </h3>
                </div>
                <div class="card-body">
                    <div class="process-list">
                        @foreach($process as $index => $step)
                        <div class="process-item-display">
                            <div class="step-number">{{ $index + 1 }}</div>
                            {{--  <span>{{ $step }}</span>  --}}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- الشريط الجانبي للمعلومات -->
        <div class="service-meta-sidebar">
            <div class="service-meta-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info"></i> معلومات الخدمة
                    </h3>
                </div>
                <div class="card-body">
                    <div class="meta-item">
                        <h6>الأيقونة</h6>
                        @if($service->icon)
                        <div class="icon-preview">
                            <i class="{{ $service->icon }} fa-2x"></i>
                            <span class="icon-name">{{ $service->icon }}</span>
                        </div>
                        @else
                        <p class="text-muted">غير محدد</p>
                        @endif
                    </div>

                    <div class="meta-item">
                        <h6>الحالة</h6>
                        @if($service->is_active)
                        <span class="badge badge-success">نشط</span>
                        @else
                        <span class="badge badge-danger">غير نشط</span>
                        @endif
                    </div>

                    <div class="meta-item">
                        <h6>مميزة</h6>
                        @if($service->is_featured)
                        <span class="badge badge-primary">نعم</span>
                        @else
                        <span class="badge badge-secondary">لا</span>
                        @endif
                    </div>

                    <div class="meta-item">
                        <h6>ترتيب العرض</h6>
                        <p>{{ $service->order }}</p>
                    </div>

                    <div class="meta-item">
                        <h6>تاريخ الإنشاء</h6>
                        <p>{{ $service->created_at->format('Y/m/d - H:i') }}</p>
                    </div>

                    <div class="meta-item">
                        <h6>آخر تحديث</h6>
                        <p>{{ $service->updated_at->format('Y/m/d - H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.service-status {
    display: flex;
    align-items: center;
    gap: 8px;
}

.service-header {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.service-icon-large {
    width: 80px;
    height: 80px;
    background: var(--primary-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 32px;
    flex-shrink: 0;
}

.service-title-section {
    flex: 1;
}

.service-title-main {
    font-size: 24px;
    font-weight: 700;
    color: var(--dark-color);
    margin: 0 0 12px 0;
}

.service-description-main {
    font-size: 16px;
    color: var(--secondary-color);
    line-height: 1.6;
    margin: 0;
}

.service-img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.service-content-full {
    font-size: 14px;
    line-height: 1.8;
    color: var(--dark-color);
}

.service-content-full p {
    margin-bottom: 16px;
}

.service-content-full h1,
.service-content-full h2,
.service-content-full h3,
.service-content-full h4 {
    color: var(--dark-color);
    margin-bottom: 12px;
}

.icon-preview {
    display: flex;
    align-items: center;
    gap: 12px;
}

.icon-name {
    font-size: 12px;
    color: var(--secondary-color);
    background: #f3f4f6;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: monospace;
}

@media (max-width: 768px) {
    .service-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 16px;
    }
    
    .service-icon-large {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
    
    .service-title-main {
        font-size: 20px;
    }
    
    .service-description-main {
        font-size: 14px;
    }
}
</style>
@endsection