@extends('front.layouts.app')

@section('title', __('Our Services'))

@push('styles')
<style>
:root {
  --primary-color: #4361ee;
  --primary-light: #eef2ff;
  --secondary-color: #3f37c9;
  --accent-color: #4895ef;
  --dark-color: #1b263b;
  --light-color: #f8f9fa;
  --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
  --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
  --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Hero Section */
.services-hero {
  background: var(--gradient);
  color: white;
  padding: 6rem 0;
  position: relative;
  overflow: hidden;
}

.services-hero::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -10%;
  width: 120%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1.5rem;
  {{--  color: #10a2b5;  --}}
}

.hero-subtitle {
  font-size: 1.25rem;
  opacity: 0.9;
  margin-bottom: 2rem;
  max-width: 600px;
  color: #4e0404;
}

.hero-illustration {
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

/* Services Grid */
.services-grid {
  padding: 5rem 0;
}

.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-subtitle {
  display: inline-block;
  color:#eef2ff;
  background: var(--primary-light);
  padding: 0.5rem 1.25rem;
  border-radius: 50px;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.section-title {
  font-size: 3rem;
  font-weight: 800;
  color:#1071d2;
  margin-bottom: 1.5rem;
  line-height: 1.2;
}

.section-description {
  color: #6c757d;
  font-size: 1.125rem;
  max-width: 700px;
  margin: 0 auto;
}

.service-card {
  border: none;
  border-radius: 16px;
  overflow: hidden;
  transition: var(--transition);
  background: white;
  box-shadow: var(--shadow-sm);
  height: 100%;
  display: flex;
  flex-direction: column;
  position: relative;
}

.service-card:hover {
  transform: translateY(-10px);
  box-shadow: var(--shadow-lg);
}

.service-card.featured::after {
  content: "Featured";
  position: absolute;
  top: 15px;
  right: 15px;
  background: var(--accent-color);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 50px;
  font-size: 0.75rem;
  font-weight: 600;
  z-index: 2;
}

.service-media {
  height: 220px;
  overflow: hidden;
  position: relative;
  
}

.service-media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 1s ease;
}

.service-card:hover .service-media img {
  transform: scale(1.05);
}

.service-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 40%;
  background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
}

.service-body {
  padding: 1.75rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.service-icon {
  width: 64px;
  height: 64px;
  background: var(--gradient);
  color: white;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
  margin-bottom: 1.25rem;
  box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.service-title {
  font-size: 1.375rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
  color: var(--dark-color);
}

.service-description {
  color: #6c757d;
  margin-bottom: 1.5rem;
  flex-grow: 1;
}

.service-link {
  display: inline-flex;
  align-items: center;
  color: var(--primary-color);
  font-weight: 600;
  text-decoration: none;
  transition: var(--transition);
}

.service-link:hover {
  color: var(--secondary-color);
}

.service-link i {
  margin-left: 0.5rem;
  transition: transform 0.3s ease;
}

.service-link:hover i {
  transform: translateX(5px);
}

/* Featured Services */
.featured-services {
  background: var(--dark-color);
  color: white;
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
}

.featured-services::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(8, 15, 30, 0.98)),
    url('/images/dd.jpg') center/cover no-repeat fixed;
      opacity: 0.5;
}

.featured-service-card {
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 2.5rem;
  transition: var(--transition);
  height: 100%;
}

.featured-service-card:hover {
  transform: translateY(-5px);
  background: rgba(255,255,255,0.1);
  border-color: rgba(255,255,255,0.2);
}

.featured-icon {
  width: 80px;
  height: 80px;
  background: rgb(11, 79, 75);
  color: var(--primary-color);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin-bottom: 1.5rem;
}

.featured-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

/* CTA Section */
.service-cta {
  padding: 6rem 0;
  background: linear-gradient(135deg, #036765, #eef2ff);
}

.cta-card {
  background: white;
  border-radius: 16px;
  padding: 4rem;
  box-shadow: var(--shadow-lg);
  text-align: center;
  max-width: 900px;
  margin: 0 auto;
}

.cta-title {
  font-size: 2.25rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  color: var(--dark-color);
}

.cta-description {
  color: #6c757d;
  font-size: 1.125rem;
  max-width: 600px;
  margin: 0 auto 2.5rem;
}

/* Responsive Design */
@media (max-width: 1199.98px) {
  .hero-title {
    font-size: 3rem;
  }
}

@media (max-width: 991.98px) {
  .services-hero {
    padding: 4rem 0;
    text-align: center;
  }
  
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-subtitle {
    margin-left: auto;
    margin-right: auto;
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 767.98px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .service-media {
    height: 180px;
  }
  
  .cta-card {
    padding: 3rem 2rem;
  }
  
  .cta-title {
    font-size: 1.75rem;
  }
}

@media (max-width: 575.98px) {
  .services-hero {
    padding: 3rem 0;
  }
  
  .hero-title {
    font-size: 1.75rem;
  }
  
  .section-title {
    font-size: 1.5rem;
  }
  
  .service-body {
    padding: 1.5rem;
  }
  
  .cta-card {
    padding: 2rem 1.5rem;
  }
  
  .cta-title {
    font-size: 1.5rem;
  }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="services-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 hero-content">
        <h1 class="hero-title">{{ __('Transform Your Business With Our Expert Services') }}</h1>
        <p class="hero-subtitle">{{ __('Innovative solutions designed to drive growth and maximize your business potential in today\'s competitive landscape.') }}</p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="#services" class="btn btn-light btn-lg px-4">{{ __('Explore Services') }}</a>
          <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">{{ __('Get Started') }}</a>
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <img src="{{ asset('/images/dd.jpg') }}" alt="Services Illustration" class="img-fluid hero-illustration">
      </div>
    </div>
  </div>
</section>

<!-- Services Grid -->
<section id="services" class="services-grid">
  <div class="container">
    <div class="section-header">
      <span class="section-subtitle">{{ __('WHAT WE OFFER') }}</span>
      <h2 class="section-title">{{ __('Our Comprehensive Services') }}</h2>
      <p class="section-description">
        {{ __('We deliver exceptional value through our specialized services tailored to your unique business needs.') }}
      </p>
    </div>

    <div class="row g-4">
      @foreach($services as $service)
      <div class="col-xl-4 col-md-6">
        <div class="service-card @if($service->is_featured) featured @endif">
          @if($service->image)
          <div class="service-media">
            <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid" alt="{{ $service->title }}">
            <div class="service-overlay"></div>
          </div>
          @endif
          <div class="service-body">
            @if($service->icon)
            <div class="service-icon">
              <i class="{{ $service->icon }}"></i>
            </div>
            @endif
            <h3 class="service-title">{{ $service->title }}</h3>
            <p class="service-description">{{ Str::limit($service->description, 120) }}</p>
            <a href="{{ route('services.show', $service->slug) }}" class="service-link">
              {{ __('Learn More') }} <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    @if($services->isEmpty())
    <div class="text-center py-5">
      <div class="empty-state">
        <i class="fas fa-concierge-bell fa-4x text-muted mb-4"></i>
        <h4 class="mb-3">{{ __('No Services Available') }}</h4>
        <p class="text-muted mb-4">{{ __('We are currently updating our service offerings. Please check back soon.') }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
          <i class="fas fa-home me-2"></i> {{ __('Return Home') }}
        </a>
      </div>
    </div>
    @endif
  </div>
</section>

@if($featuredServices->count() > 0)
<!-- Featured Services -->
<section class="featured-services">
  <div class="container">
    <div class="section-header">
      <span class="section-subtitle" style="background: rgba(255,255,255,0.1); color: white;">{{ __('PREMIUM SOLUTIONS') }}</span>
      <h2 class="section-title text-white">{{ __('Featured Services') }}</h2>
      <p class="section-description text-white-50">
        {{ __('Our most popular solutions that deliver exceptional results for our clients.') }}
      </p>
    </div>

    <div class="row g-4">
      @foreach($featuredServices as $service)
      <div class="col-lg-6">
        <div class="featured-service-card">
          <div class="row align-items-center">
            <div class="col-md-3 text-center mb-4 mb-md-0">
              @if($service->icon)
              <div class="featured-icon">
                <i class="{{ $service->icon }}"></i>
              </div>
              @endif
            </div>
            <div class="col-md-9">
              <h3 class="featured-title">{{ $service->title }}</h3>
              <p class="text-white-75 mb-4">{{ $service->description }}</p>
              <a href="{{ route('services.show', $service->slug) }}" class="btn btn-light">
                {{ __('Discover More') }} <i class="fas fa-arrow-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- CTA Section -->
<section class="service-cta">
  <div class="container">
    <div class="cta-card">
      <h2 class="cta-title">{{ __('Ready to Transform Your Business?') }}</h2>
      <p class="cta-description">
        {{ __('Our team of experts is ready to provide customized solutions to meet your specific needs and help you achieve your business goals.') }}
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4">
          <i class="fas fa-paper-plane me-2"></i> {{ __('Get a Free Consultation') }}
        </a>
        <a href="tel:{{ $profile->phone ?? __('Not specified') }}" class="btn btn-outline-primary btn-lg px-4">
          <i class="fas fa-phone-alt me-2"></i> {{ __('Call Us Now') }}
        </a>
      </div>
    </div>
  </div>
</section>
@endsection