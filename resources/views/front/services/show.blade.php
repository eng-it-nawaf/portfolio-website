@extends('front.layouts.app')

@section('title', $service->title . ' | ' . config('app.name'))

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
.service-detail-hero {
  background: var(--gradient);
  color: white;
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
}

.service-detail-hero::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -10%;
  width: 120%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
  z-index: 1;
}

.service-hero-content {
  position: relative;
  z-index: 2;
}

.service-hero-title {
  font-size: 2.75rem;
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1.5rem;
}

.service-hero-description {
  font-size: 1.25rem;
  opacity: 0.9;
  margin-bottom: 2rem;
}

.breadcrumb {
  background: rgba(255,255,255,0.1);
  padding: 0.75rem 1rem;
  border-radius: 50px;
  display: inline-flex;
  margin-bottom: 2rem;
}

.breadcrumb-item a {
  color: rgba(255,255,255,0.8);
  text-decoration: none;
  transition: var(--transition);
}

.breadcrumb-item a:hover {
  color: white;
}

.breadcrumb-item.active {
  color: white;
  font-weight: 600;
}

.breadcrumb-item+.breadcrumb-item::before {
  color: rgba(255,255,255,0.5);
}

.service-hero-image {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: var(--shadow-lg);
  height: 100%;
  min-height: 350px;
  position: relative;
}

.service-hero-image img {
  {{--  width: 50%;  --}}
  height: 12000%;
  object-fit: cover;
}

/* Content Section */
.service-detail-content {
  padding: 5rem 0;
}

.service-main-image {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: var(--shadow-md);
  margin-bottom: 3rem;
  height: 450px;
}

.service-main-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.service-article h2 {
  font-size: 2.75rem;
  font-weight: 700;
  color:#3f37c9;
  margin-bottom: 1.5rem;
  position: relative;
  padding-bottom: 0.75rem;
}

.service-article h2::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 60px;
  height: 4px;
  background: var(--gradient);
  border-radius: 2px;
}

.service-article h3 {
  font-size: 1.5rem;
  font-weight: 600;
  color:aqua;
  margin: 2.5rem 0 1.25rem;
}

.service-article p {
  color: #d6be0c;
  line-height: 1.7;
  margin-bottom: 1.5rem;
  font-size: 1.2rem;
}

.service-article ul,
.service-article ol {
  margin-bottom: 1.5rem;
  padding-left: 1.5rem;
}

.service-article li {
  margin-bottom: 0.5rem;
  color: #4a5568;
}

/* Features Section */
.feature-card {
  background: white;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: var(--shadow-sm);
  height: 100%;
  transition: var(--transition);
  border: 1px solid rgba(0, 0, 0, 0.03);
}

.feature-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-lg);
}

.feature-icon {
  width: 60px;
  height: 60px;
  background: var(--primary-light);
  color: var(--primary-color);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
  margin-bottom: 1.5rem;
}

.feature-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--dark-color);
}

.feature-description {
  color: #6c757d;
}

/* Process Timeline */
.process-step {
  position: relative;
  padding-left: 40px;
  margin-bottom: 2.5rem;
}

.process-step:last-child {
  margin-bottom: 0;
}

.step-number {
  position: absolute;
  left: 0;
  top: 0;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--gradient);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.step-content {
  background: white;
  border-radius: 12px;
  padding: 1.75rem;
  box-shadow: var(--shadow-sm);
  border: 1px solid rgba(0, 0, 0, 0.03);
}

.step-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--dark-color);
}

.step-description {
  color: #6c757d;
  margin-bottom: 1rem;
}

.step-details {
  background: var(--primary-light);
  padding: 1rem 1.5rem;
  border-radius: 8px;
  margin-top: 1rem;
}

.step-details ul {
  margin: 0;
  padding-left: 1rem;
}

.step-details li {
  margin-bottom: 0.5rem;
  color: var(--dark-color);
}

.step-meta {
  display: flex;
  align-items: center;
  color: var(--primary-color);
  font-weight: 500;
  margin-top: 1rem;
}

.step-meta i {
  margin-right: 0.5rem;
}

/* Sidebar */
.service-sidebar {
  position: sticky;
  top: 20px;
}

.sidebar-widget {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
  margin-bottom: 2rem;
  transition: var(--transition);
}

.sidebar-widget:hover {
  box-shadow: var(--shadow-md);
}

.widget-header {
  padding: 1.5rem;
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.widget-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin: 0;
  color: var(--dark-color);
}

.widget-body {
  padding: 1.5rem;
}

.meta-item {
  margin-bottom: 1.25rem;
  padding-bottom: 1.25rem;
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.meta-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.meta-icon {
  width: 40px;
  height: 40px;
  background: var(--primary-light);
  color: var(--primary-color);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
}

.meta-label {
  font-size: 0.875rem;
  color: #6c757d;
  display: block;
  margin-bottom: 0.25rem;
}

.meta-value {
  font-weight: 600;
  color: var(--dark-color);
}

.related-service-item {
  display: flex;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  transition: var(--transition);
}

.related-service-item:hover {
  background: rgba(0,0,0,0.02);
}

.related-service-item:last-child {
  border-bottom: none;
}

.related-service-icon {
  width: 40px;
  height: 40px;
  background: var(--primary-light);
  color: var(--primary-color);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  margin-right: 1rem;
}

.related-service-title {
  font-size: 1rem;
  font-weight: 600;
  margin: 0;
  transition: var(--transition);
}

.related-service-item:hover .related-service-title {
  color: var(--primary-color);
}

.related-service-description {
  font-size: 0.875rem;
  color: #6c757d;
  margin: 0;
}

/* CTA Section */
.service-bottom-cta {
  background: linear-gradient(135deg, #f8faff, #eef2ff);
  padding: 5rem 0;
  text-align: center;
}

.cta-container {
  max-width: 800px;
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
  margin-bottom: 2.5rem;
}

/* Responsive Design */
@media (max-width: 1199.98px) {
  .service-hero-title {
    font-size: 2.5rem;
  }
  
  .service-main-image {
    height: 400px;
  }
}

@media (max-width: 991.98px) {
  .service-detail-hero {
    padding: 4rem 0;
    text-align: center;
  }
  
  .service-hero-title {
    font-size: 2rem;
  }
  
  .breadcrumb {
    margin-left: auto;
    margin-right: auto;
  }
  
  .service-main-image {
    height: 350px;
    margin-top: 2rem;
  }
}

@media (max-width: 767.98px) {
  .service-hero-title {
    font-size: 1.75rem;
  }

  .service-hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  margin-top: 4%;
}
  
  .service-main-image {
    height: 300px;
  }
  
  .service-article h2 {
    font-size: 1.5rem;
  }
}

@media (max-width: 575.98px) {
  .service-detail-hero {
    padding: 3rem 0;
  }

    .service-hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  margin-top: 4%;
}
  
  .service-hero-title {
    font-size: 1.5rem;
  }
  
  .service-main-image {
    height: 250px;
  }
  
  .cta-title {
    font-size: 1.75rem;
  }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="service-detail-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 service-hero-content">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('Services') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
          </ol>
        </nav>
        <h1 class="service-hero-title">{{ $service->title }}</h1>
        <p class="service-hero-description">{{ $service->description }}</p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="{{ route('contact') }}" class="btn btn-light px-4">
            <i class="fas fa-envelope me-2"></i> {{ __('Get a Quote') }}
          </a>
          <a href="#features" class="btn btn-outline-light px-4">
            <i class="fas fa-star me-2"></i> {{ __('Key Features') }}
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        @if($service->image)
        <div class="service-hero-image">
          <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid" alt="{{ $service->title }}">
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Content Section -->
<section class="service-detail-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">


        <article class="service-article">
          <h2>{{ __('Service Overview') }}</h2>
          <div class="content-body">
            {!! $service->content !!}
          </div>
        </article>

        @if(!empty($service->features) && count($service->features) > 0)
        <section id="features" class="my-5 py-4">
          <h2>{{ __('Key Features') }}</h2>
          <div class="row g-4 mt-4">
            @foreach($service->features as $feature)
            <div class="col-md-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="{{ $feature['icon'] ?? 'fas fa-check-circle' }}"></i>
                </div>
                <h3 class="feature-title">{{ $feature['title'] ?? 'Feature Title' }}</h3>
                <p class="feature-description">{{ $feature['description'] ?? 'Feature description' }}</p>
                
                @if(!empty($feature['items']) && is_array($feature['items']))
                <ul class="list-unstyled mt-3">
                  @foreach($feature['items'] as $item)
                  <li class="d-flex mb-2">
                    <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                    <span>{{ $item }}</span>
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
            @endforeach
          </div>
        </section>
        @endif

        @if(!empty($service->process) && count($service->process) > 0)
        <section id="process" class="my-5 py-4">
          <h2>{{ __('Our Process') }}</h2>
          <p class="text-muted">{{ __('How we deliver exceptional results for this service') }}</p>
          
          <div class="process-steps mt-4">
            @foreach($service->process as $index => $step)
            <div class="process-step">
              <div class="step-number">{{ $index + 1 }}</div>
              <div class="step-content">
                <h3 class="step-title">{{ $step['title'] ?? 'Step Title' }}</h3>
                <p class="step-description">{{ $step['description'] ?? 'Step description' }}</p>
                
                @if(!empty($step['details']) && is_array($step['details']))
                <div class="step-details">
                  <ul>
                    @foreach($step['details'] as $detail)
                    <li>{{ $detail }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                
                @if(!empty($step['duration']))
                <div class="step-meta">
                  <i class="far fa-clock"></i>
                  <span>{{ __('Duration:') }} {{ $step['duration'] }}</span>
                </div>
                @endif
              </div>
            </div>
            @endforeach
          </div>
        </section>
        @endif

        @if($service->projects && $service->projects->count() > 0)
        <section class="related-projects my-5 py-4">
          <h2>{{ __('Related Projects') }}</h2>
          <p class="text-muted">{{ __('See how we\'ve implemented this service for our clients') }}</p>
          
          <div class="row g-4 mt-4">
            @foreach($service->projects as $project)
            <div class="col-md-6">
              <div class="card border-0 shadow-sm h-100">
                @if($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}" class="card-img-top" alt="{{ $project->title }}">
                @endif
                <div class="card-body">
                  <h3 class="h5">{{ $project->title }}</h3>
                  <p class="text-muted">{{ Str::limit($project->excerpt, 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                  <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-outline-primary">
                    {{ __('View Case Study') }}
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </section>
        @endif
      </div>
      
      <div class="col-lg-4">
        <aside class="service-sidebar">
          <!-- Service Meta Widget -->
          <div class="sidebar-widget">
            <div class="widget-header">
              <h3 class="widget-title">{{ __('Service Details') }}</h3>
            </div>
            <div class="widget-body">
              <div class="meta-item d-flex">
                <div class="meta-icon me-3">
                  <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                  <span class="meta-label">{{ __('Last Updated') }}</span>
                  <span class="meta-value">{{ $service->updated_at->format('M d, Y') }}</span>
                </div>
              </div>
              
              <div class="meta-item d-flex">
                <div class="meta-icon me-3">
                  <i class="fas fa-bolt"></i>
                </div>
                <div>
                  <span class="meta-label">{{ __('Service Status') }}</span>
                  <span class="meta-value">{{ $service->is_active ? __('Available') : __('Coming Soon') }}</span>
                </div>
              </div>
              
              @if($service->icon)
              <div class="meta-item d-flex">
                <div class="meta-icon me-3">
                  <i class="fas fa-tag"></i>
                </div>
                <div>
                  <span class="meta-label">{{ __('Category') }}</span>
                  <span class="meta-value">{{ $service->icon }}</span>
                </div>
              </div>
              @endif
            </div>
          </div>
          
          <!-- Contact Widget -->
          <div class="sidebar-widget">
            <div class="widget-header">
              <h3 class="widget-title">{{ __('Get a Free Consultation') }}</h3>
            </div>
            <div class="widget-body">
              <p class="text-muted small mb-4">{{ __('Interested in this service? Contact our experts for a free consultation.') }}</p>
              
              <a href="{{ route('contact') }}" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-envelope me-2"></i> {{ __('Send Message') }}
              </a>
              
              <a href="tel:{{ $profile->phone ?? __('Not specified') }}" class="btn btn-outline-primary w-100">
                <i class="fas fa-phone-alt me-2"></i> {{ __('Call Now') }}
              </a>
            </div>
          </div>
          
          @if($relatedServices->count() > 0)
          <!-- Related Services Widget -->
          <div class="sidebar-widget">
            <div class="widget-header">
              <h3 class="widget-title">{{ __('Related Services') }}</h3>
            </div>
            <div class="widget-body">
              <div class="related-services-list">
                @foreach($relatedServices as $related)
                <a href="{{ route('services.show', $related->slug) }}" class="related-service-item">
                  @if($related->icon)
                  <div class="related-service-icon">
                    <i class="{{ $related->icon }}"></i>
                  </div>
                  @endif
                  <div>
                    <h4 class="related-service-title">{{ $related->title }}</h4>
                    <p class="related-service-description">{{ Str::limit($related->description, 50) }}</p>
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>
          @endif
        </aside>
      </div>
    </div>
  </div>
</section>

<!-- Bottom CTA Section -->
<section class="service-bottom-cta">
  <div class="container">
    <div class="cta-container">
      <h2 class="cta-title">{{ __('Ready to Get Started?') }}</h2>
      <p class="cta-description">
        {{ __('Let us help you achieve your business goals with our professional services. Contact us today to discuss your project.') }}
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4">
          <i class="fas fa-paper-plane me-2"></i> {{ __('Request a Quote') }}
        </a>
        <a href="tel:{{ $profile->phone ?? __('Not specified') }}" class="btn btn-outline-primary btn-lg px-4">
          <i class="fas fa-phone-alt me-2"></i> {{ __('Call for Consultation') }}
        </a>
      </div>
    </div>
  </div>
</section>
@endsection