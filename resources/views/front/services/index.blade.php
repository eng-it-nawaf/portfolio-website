@extends('front.layouts.app')

@section('title', 'خدماتنا')

@section('content')
<!-- Hero Section -->
<section class="page-hero bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">الرئيسية</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">الخدمات</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-4">خدماتنا المتكاملة</h1>
                <p class="lead mb-4">نقدم حلولاً تقنية مبتكرة تساعدك على تطوير أعمالك وتحقيق أهدافك</p>
            </div>
            <div class="col-lg-6 text-end">
                <img src="{{ asset('images/services-hero.svg') }}" alt="خدماتنا" class="img-fluid" style="max-height: 300px;">
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="fw-bold mb-3">خدماتنا المتميزة</h2>
                <p class="text-muted">نقدم مجموعة شاملة من الخدمات التقنية لمساعدتك في تحقيق النجاح الرقمي</p>
            </div>
        </div>

        @if($services->count() > 0)
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="card service-card border-0 shadow-sm h-100">
                    @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" class="card-img-top" alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body p-4">
                        @if($service->icon)
                        <div class="mb-3">
                            <i class="{{ $service->icon }} fa-2x text-primary"></i>
                        </div>
                        @endif
                        <h3 class="card-title h5 fw-bold mb-3">{{ $service->title }}</h3>
                        <p class="card-text text-muted mb-4">{{ Str::limit($service->description, 120) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('services.show', $service->slug) }}" class="btn btn-outline-primary btn-sm">
                                اقرأ المزيد <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                            @if($service->is_featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i> مميز
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-concierge-bell fa-3x text-muted mb-3"></i>
                <h4 class="mb-3">لا توجد خدمات حالياً</h4>
                <p class="text-muted mb-4">سنقوم بإضافة خدماتنا قريباً</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">هل تبحث عن خدمة محددة؟</h2>
                <p class="text-muted mb-4">اتصل بنا لمناقشة احتياجاتك وسنقدم لك الحل الأمثل</p>
            </div>
            <div class="col-lg-4 text-end">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-envelope me-2"></i> تواصل معنا
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.page-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.breadcrumb {
    background: rgba(255,255,255,0.1);
    padding: 0.5rem 1rem;
    border-radius: 50px;
}

.breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: white;
}

.breadcrumb-item.active {
    color: white;
    font-weight: 600;
}
</style>
@endpush