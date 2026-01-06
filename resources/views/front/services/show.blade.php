@extends('front.layouts.app')

@section('title', $service->title . ' | ' . config('app.name'))

@section('content')
<!-- Hero Section -->
<section class="service-hero py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $service->cover_image_url }}') center/cover no-repeat;">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white">الخدمات</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>
        
        <div class="row align-items-center">
            <div class="col-lg-8 text-white">
                @if($service->icon)
                <div class="mb-3">
                    <i class="{{ $service->icon }} fa-3x text-white"></i>
                </div>
                @endif
                <h1 class="display-5 fw-bold mb-4">{{ $service->title }}</h1>
                <p class="lead mb-4">{{ $service->description }}</p>
                <div class="d-flex gap-3">
                    <a href="#contact-form" class="btn btn-light btn-lg">
                        <i class="fas fa-envelope me-2"></i> اطلب الخدمة
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone-alt me-2"></i> تواصل معنا
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                @if($service->image)
                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="img-fluid rounded shadow" style="max-height: 300px;">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Service Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="service-content">
                    <div class="content mb-5">
                        {!! $service->content !!}
                    </div>

                    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
                    <!-- Related Projects -->
                    <div class="mb-5">
                        <h3 class="fw-bold mb-4">مشاريع ذات صلة</h3>
                        <div class="row g-4">
                            @foreach($relatedProjects as $project)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    @if($project->images->first())
                                    <img src="{{ asset('storage/' . $project->images->first()->image_path) }}" 
                                         class="card-img-top" 
                                         alt="{{ $project->title }}" 
                                         style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('project-detail', $project->id) }}" class="btn btn-outline-primary btn-sm">
                                                عرض التفاصيل
                                            </a>
                                            @if($project->category)
                                            <span class="badge bg-info">{{ $project->category }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Contact Form -->
                    <div id="contact-form" class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">طلب هذه الخدمة</h3>
                            <form action="{{ route('contact') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service" value="{{ $service->title }}">
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">الاسم الكامل</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">رقم الهاتف</label>
                                        <input type="tel" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="company" class="form-label">الشركة (اختياري)</label>
                                        <input type="text" class="form-control" id="company" name="company">
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">الرسالة</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" required>أريد معلومات أكثر عن خدمة {{ $service->title }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i> إرسال الطلب
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Service Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">معلومات الخدمة</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">الحالة:</span>
                                        <span class="fw-bold {{ $service->is_active ? 'text-success' : 'text-danger' }}">
                                            {{ $service->is_active ? 'متاحة' : 'غير متاحة' }}
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">النوع:</span>
                                        <span class="fw-bold {{ $service->is_featured ? 'text-warning' : 'text-secondary' }}">
                                            {{ $service->is_featured ? 'خدمة مميزة' : 'خدمة عادية' }}
                                        </span>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">آخر تحديث:</span>
                                        <span class="fw-bold">{{ $service->updated_at->format('Y/m/d') }}</span>
                                    </div>
                                </li>
                                @if($service->projects()->count() > 0)
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">المشاريع:</span>
                                        <span class="fw-bold text-info">
                                            {{ $service->projects()->count() }} مشروع
                                        </span>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Related Services -->
                    @if($relatedServices->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">خدمات ذات صلة</h5>
                            <div class="list-group list-group-flush">
                                @foreach($relatedServices as $related)
                                <a href="{{ route('services.show', $related->slug) }}" class="list-group-item list-group-item-action border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($related->icon)
                                        <div class="me-3">
                                            <i class="{{ $related->icon }} text-primary"></i>
                                        </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-1">{{ $related->title }}</h6>
                                            <small class="text-muted">{{ Str::limit($related->description, 50) }}</small>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Info -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">للتواصل السريع</h5>
                            <div class="d-grid gap-2">
                                <a href="tel:{{ $profile->phone ?? '#' }}" class="btn btn-outline-primary">
                                    <i class="fas fa-phone-alt me-2"></i> اتصل بنا
                                </a>
                                <a href="https://wa.me/{{ $profile->whatsapp ?? '#' }}" target="_blank" class="btn btn-outline-success">
                                    <i class="fab fa-whatsapp me-2"></i> واتساب
                                </a>
                                <a href="mailto:{{ $profile->email ?? '#' }}" class="btn btn-outline-danger">
                                    <i class="fas fa-envelope me-2"></i> بريد إلكتروني
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Services Section -->
@if($relatedServices->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center">خدمات أخرى قد تهمك</h2>
        <div class="row g-4">
            @foreach($relatedServices as $related)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    @if($related->image)
                    <img src="{{ $related->image_url }}" class="card-img-top" alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($related->icon)
                            <div class="me-3">
                                <i class="{{ $related->icon }} fa-2x text-primary"></i>
                            </div>
                            @endif
                            <h5 class="card-title fw-bold mb-0">{{ $related->title }}</h5>
                        </div>
                        <p class="card-text text-muted">{{ Str::limit($related->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('services.show', $related->slug) }}" class="btn btn-outline-primary btn-sm">
                                اقرأ المزيد
                            </a>
                            @if($related->is_featured)
                            <span class="badge bg-warning">
                                <i class="fas fa-star me-1"></i> مميز
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
.service-hero {
    min-height: 400px;
    display: flex;
    align-items: center;
}

.breadcrumb {
    background: rgba(255,255,255,0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    backdrop-filter: blur(10px);
}

.service-content img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 1rem 0;
}

.service-content h2, .service-content h3 {
    color: #333;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.service-content p {
    line-height: 1.8;
    color: #555;
    margin-bottom: 1.5rem;
}

.sticky-top {
    position: sticky;
    top: 20px;
}

.list-group-item {
    border-left: none;
    border-right: none;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>
@endpush