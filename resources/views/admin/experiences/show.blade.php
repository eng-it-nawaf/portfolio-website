@extends('admin.layouts.app')

@section('title', 'تفاصيل الخبرة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-experiences.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تفاصيل الخبرة</h1>
            <p class="page-description">عرض كافة معلومات الخبرة: {{ $experience->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> تعديل الخبرة
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="experience-details">
        <!-- بطاقة المعلومات الأساسية -->
        <div class="experience-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> المعلومات الأساسية
                </h3>
                <span class="experience-status {{ $experience->is_current ? 'current' : 'completed' }}">
                    {{ $experience->is_current ? 'مستمرة' : 'منتهية' }}
                </span>
            </div>
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>المسمى الوظيفي / المؤهل:</label>
                        <span>{{ $experience->title }}</span>
                    </div>
                    <div class="detail-item">
                        <label>الشركة / المؤسسة:</label>
                        <span>{{ $experience->company }}</span>
                    </div>
                    <div class="detail-item">
                        <label>نوع الخبرة:</label>
                        <span>
                            @if($experience->type == 'work')
                                <span class="badge badge-primary">خبرة عملية</span>
                            @else
                                <span class="badge badge-success">خبرة تعليمية</span>
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <label>تاريخ الإنشاء:</label>
                        <span>{{ $experience->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقة الفترة الزمنية -->
        <div class="experience-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-alt"></i> الفترة الزمنية
                </h3>
            </div>
            <div class="card-body">
                <div class="timeline-info">
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="timeline-content">
                            <label>تاريخ البدء:</label>
                            <span>{{ $experience->start_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            @if($experience->is_current)
                                <i class="fas fa-spinner"></i>
                            @else
                                <i class="fas fa-flag-checkered"></i>
                            @endif
                        </div>
                        <div class="timeline-content">
                            <label>تاريخ الانتهاء:</label>
                            <span>
                                @if($experience->is_current)
                                    <span class="current-text">مستمرة حتى الآن</span>
                                @else
                                    {{ $experience->end_date->format('d/m/Y') }}
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="timeline-content">
                            <label>المدة:</label>
                            <span>
                                @php
                                    $start = $experience->start_date;
                                    $end = $experience->is_current ? now() : $experience->end_date;
                                    $years = $end->diffInYears($start);
                                    $months = $end->diffInMonths($start) % 12;
                                    
                                    $duration = '';
                                    if ($years > 0) $duration .= $years . ' سنة' . ($years > 1 ? '' : '');
                                    if ($months > 0) $duration .= ($years > 0 ? ' و' : '') . $months . ' شهر' . ($months > 1 ? '' : '');
                                    if ($experience->is_current) $duration .= ' (مستمرة)';
                                @endphp
                                {{ $duration }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقة الوصف -->
        @if($experience->description)
        <div class="experience-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> الوصف التفصيلي
                </h3>
            </div>
            <div class="card-body">
                <div class="description-content">
                    {!! nl2br(e($experience->description)) !!}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.experience-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.experience-status.current {
    background: #d1fae5;
    color: #065f46;
}

.experience-status.completed {
    background: #e5e7eb;
    color: #374151;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-item label {
    font-size: 12px;
    font-weight: 600;
    color: var(--secondary-color);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-item span {
    font-size: 14px;
    color: var(--dark-color);
    font-weight: 500;
}

.timeline-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.timeline-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.timeline-icon {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 16px;
    border: 1px solid var(--border-color);
    flex-shrink: 0;
}

.timeline-content {
    flex: 1;
}

.timeline-content label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.timeline-content span {
    font-size: 14px;
    color: var(--dark-color);
    font-weight: 500;
}

.current-text {
    color: var(--success-color);
    font-weight: 600;
}

.description-content {
    font-size: 14px;
    line-height: 1.8;
    color: var(--dark-color);
    white-space: pre-wrap;
}

@media (max-width: 768px) {
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .timeline-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        text-align: right;
    }
    
    .timeline-icon {
        align-self: flex-start;
    }
}
</style>
@endsection