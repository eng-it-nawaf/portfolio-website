@extends('admin.layouts.app')

@section('title', 'إدارة الخبرات')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-experiences.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إدارة الخبرات</h1>
            <p class="page-description">إضافة وتعديل خبراتك العملية والتعليمية</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة خبرة جديدة
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <div class="card-body">
            @if($experiences->count() > 0)
            <div class="experiences-list">
                @foreach($experiences as $experience)
                <div class="experience-item">
                    <div class="experience-icon">
                        @if($experience->type == 'work')
                            <i class="fas fa-briefcase"></i>
                        @else
                            <i class="fas fa-graduation-cap"></i>
                        @endif
                    </div>
                    
                    <div class="experience-content">
                        <h4 class="experience-title">{{ $experience->title }}</h4>
                        <p class="experience-company">{{ $experience->company }}</p>
                        <div class="experience-period">
                            @if($experience->type == 'work')
                                <span class="badge badge-primary">عمل</span>
                            @else
                                <span class="badge badge-success">تعليم</span>
                            @endif
                            <span>
                                {{ $experience->start_date->format('M Y') }} - 
                                @if($experience->is_current)
                                    <span class="current-badge">الحاضر</span>
                                @else
                                    {{ $experience->end_date->format('M Y') }}
                                @endif
                            </span>
                            <span class="duration">
                                @php
                                    $start = $experience->start_date;
                                    $end = $experience->is_current ? now() : $experience->end_date;
                                    $years = $end->diffInYears($start);
                                    $months = $end->diffInMonths($start) % 12;
                                    
                                    $duration = '';
                                    if ($years > 0) $duration .= $years . ' سنة' . ($years > 1 ? '' : '');
                                    if ($months > 0) $duration .= ($years > 0 ? ' و' : '') . $months . ' شهر' . ($months > 1 ? '' : '');
                                @endphp
                                ({{ $duration }})
                            </span>
                        </div>
                    </div>
                    
                    <div class="experience-actions">
                        <a href="{{ route('admin.experiences.show', $experience) }}" class="btn-action view" title="عرض التفاصيل">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn-action edit" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه الخبرة؟')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="empty-title">لا توجد خبرات</h3>
                <p class="empty-description">ابدأ بإضافة خبرتك الأولى لعرضها هنا</p>
                <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة خبرة جديدة
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid transparent;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border-color: #a7f3d0;
}

.alert-success i {
    color: #10b981;
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.current-badge {
    background: var(--success-color);
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
}

.duration {
    color: var(--secondary-color);
    font-size: 11px;
}

@media (max-width: 768px) {
    .experience-period {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .experience-actions {
        align-self: stretch;
        justify-content: flex-end;
    }
}
</style>
@endsection