@extends('admin.layouts.app')

@section('title', 'تفاصيل المهارة')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-skills.css') }}">
@endpush

@section('content')
<div class="skills-management">
    <div class="page-header">
        <div>
            <h1 class="page-title">تفاصيل المهارة</h1>
            <p class="page-description">عرض معلومات المهارة: {{ $skill->name }}</p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> رجوع للقائمة
        </a>
    </div>

    <div class="skill-details fade-in-up">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-info-circle"></i> معلومات المهارة
            </h3>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">اسم المهارة:</span>
            <span class="detail-value">{{ $skill->name }}</span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">الأيقونة:</span>
            <span class="detail-value">
                <div class="skill-icon">
                    <i class="{{ $skill->icon }}"></i>
                </div>
                <small class="text-muted ms-2">{{ $skill->icon }}</small>
            </span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">التصنيف:</span>
            <span class="detail-value">
                <span class="badge bg-dark">{{ $skill->category }}</span>
            </span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">المستوى:</span>
            <span class="detail-value">
                <div class="progress-container">
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: {{ $skill->percentage }}%"></div>
                    </div>
                    <span class="percentage-text">{{ $skill->percentage }}%</span>
                </div>
            </span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">تاريخ الإنشاء:</span>
            <span class="detail-value">{{ $skill->created_at->format('d/m/Y H:i') }}</span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">آخر تحديث:</span>
            <span class="detail-value">{{ $skill->updated_at->format('d/m/Y H:i') }}</span>
        </div>
        
        <div class="form-body">
            <div class="d-flex gap-3">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-submit">
                    <i class="fas fa-edit"></i> تعديل المهارة
                </a>
                <a href="{{ route('admin.skills.index') }}" class="btn-back">
                    <i class="fas fa-list"></i> عرض جميع المهارات
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Animate progress bar on page load
document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.querySelector('.progress-bar-fill');
    if (progressBar) {
        const width = progressBar.style.width;
        progressBar.style.width = '0';
        setTimeout(() => {
            progressBar.style.width = width;
        }, 100);
    }
});
</script>
@endpush