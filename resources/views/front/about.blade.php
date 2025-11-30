@extends('front.layouts.app')

@section('title', __('About Me'))

@section('content')
<div class="about-page">
    <!-- Floating Elements -->
    <div class="floating-elements">
        @for($i = 0; $i < 8; $i++)
        <div class="floating-element" 
             style="
               --tx: {{ rand(-100, 100) }}px;
               --ty: {{ rand(-100, 100) }}px;
               top: {{ rand(0, 100) }}%;
               left: {{ rand(0, 100) }}%;
               animation-delay: {{ $i * 2 }}s;
             ">
        </div>
        @endfor
    </div>

    <!-- Hero Section -->
    <section class="heroSection">
        <div class="heroContent">
            <div class="heroGrid">
                <div class="heroTextColumn">
                    <span class="introBadge">
                        <span class="badgeIcon">👋</span>
                        {{ __('Hello, I am') }} {{ $profile->name }}
                    </span>
                    
                    <h1 class="heroTitle">
                        <span class="titleGradient">{{ $profile->title }}</span>
                        <span class="nameHighlight">{{ $profile->professional_title }}</span>
                    </h1>
                    
                    <p class="heroSubtitle">
                        {{ $profile->about }}
                    </p>
                    
                    <div class="ctaButtons">
                        <a href="{{ route('projects') }}" class="btn btn-primary">
                            {{ __('View My Work') }}
                        </a>
                        <a href="#contact" class="btn btn-outline-light">
                            {{ __('Contact Me') }}
                        </a>
                    </div>
                </div>
                
                <div class="heroImageColumn">
                    <div class="imageContainer">
                        <div class="imageWrapper">
                            <img src="{{ asset('storage/' . $profile->photo) }}" 
                                 alt="{{ $profile->name }}" 
                                 class="profileImage"
                                 loading="lazy">
                            <div class="imageGlow"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-item fade-in" style="animation-delay: 0.6s">
                    <div class="info-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="info-content">
                        <h4>{{ __('Name') }}</h4>
                        <p>{{ $profile->name }}</p>
                    </div>
                </div>
                
                <div class="info-item fade-in" style="animation-delay: 0.7s">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h4>{{ __('Email') }}</h4>
                        <p>{{ $profile->email }}</p>
                    </div>
                </div>
                
                <div class="info-item fade-in" style="animation-delay: 0.8s">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>{{ __('Phone') }}</h4>
                        <p>{{ $profile->phone ?? __('Not specified') }}</p>
                    </div>
                </div>
                
                <div class="info-item fade-in" style="animation-delay: 0.9s">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>{{ __('Location') }}</h4>
                        <p>{{ $profile->address ?? __('Not specified') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience-section">
        <div class="container">
            <div class="section-header fade-in">
                <h2 class="section-title">{{ __('My Experience') }}</h2>
                <p class="section-subtitle">{{ __('My professional journey and achievements') }}</p>
            </div>
            
            <div class="experience-grid">
                <!-- Work Experience -->
                <div class="experience-column fade-in" style="animation-delay: 0.3s">
                    <div class="experience-header">
                        <div class="experience-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="experience-title">{{ __('Work Experience') }}</h3>
                    </div>
                    
                    <div class="timeline">
                        @foreach($experiences->where('type', 'work') as $experience)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-line"></div>
                            
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <h4 class="timeline-job-title">{{ $experience->title }}</h4>
                                    <span class="timeline-date">
                                        {{ $experience->start_date->format('M Y') }} - {{ $experience->is_current ? __('Present') : $experience->end_date->format('M Y') }}
                                    </span>
                                </div>
                                <h5 class="timeline-company">{{ $experience->company }}</h5>
                                <p class="timeline-description">{{ $experience->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Education -->
                <div class="experience-column education-column fade-in" style="animation-delay: 0.5s">
                    <div class="experience-header">
                        <div class="experience-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="experience-title">{{ __('Education') }}</h3>
                    </div>
                    
                    <div class="timeline">
                        @foreach($experiences->where('type', 'education') as $experience)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-line"></div>
                            
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <h4 class="timeline-job-title">{{ $experience->title }}</h4>
                                    <span class="timeline-date">
                                        {{ $experience->start_date->format('M Y') }} - {{ $experience->is_current ? __('Present') : $experience->end_date->format('M Y') }}
                                    </span>
                                </div>
                                <h5 class="timeline-company">{{ $experience->company }}</h5>
                                <p class="timeline-description">{{ $experience->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <!-- Animated Background Elements -->
        <div class="bg-elements">
            <div class="gradient-bg"></div>
            <div class="particles">
                <div class="particle" style="--i:1"></div>
                <div class="particle" style="--i:2"></div>
                <div class="particle" style="--i:3"></div>
                <div class="particle" style="--i:4"></div>
                <div class="particle" style="--i:5"></div>
            </div>
        </div>

        <!-- Main Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <span class="section-label">
                    <i class="fas fa-paper-plane"></i>
                    {{ __("Let's Connect") }}
                </span>
                <h2 class="section-title">{{ __('Get In Touch') }}</h2>
                <p class="section-subtitle">{{ __('Have a project in mind or want to discuss opportunities?') }}</p>
            </div>

            <!-- Contact Cards Grid -->
            <div class="contact-grid">
                <!-- Email Card -->
                <div class="contact-card email-card">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>{{ __('Email Me') }}</h3>
                    <p>{{ __('For professional inquiries') }}</p>
                    <a href="mailto:{{ $profile->email }}" class="card-link">
                        {{ $profile->email }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <div class="card-hover-effect"></div>
                </div>

                <!-- Phone Card -->
                <div class="contact-card phone-card">
                    <div class="card-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>{{ __('Call Me') }}</h3>
                    <p>{{ __('Available Mon-Fri, 9AM-5PM') }}</p>
                    <a href="tel:{{ $profile->phone }}" class="card-link">
                        {{ $profile->phone ?? __('Not specified') }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <div class="card-hover-effect"></div>
                </div>

                <!-- Location Card -->
                <div class="contact-card location-card">
                    <div class="card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>{{ __('My Location') }}</h3>
                    <p>{{ $profile->address ?? __('Not specified') }}</p>
                    <div class="card-link">
                        {{ __('View On Map') }}
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="card-hover-effect"></div>
                </div>
            </div>

            <!-- Contact Form CTA -->
            <div class="contact-cta">
                <div class="cta-content">
                    <h3>{{ __('Ready to Start Your Project?') }}</h3>
                    <p>{{ __("Send me a message and I'll get back to you within 24 hours") }}</p>
                    <a href="{{ route('contact') }}" class="cta-button">
                        {{ __('Send Message') }}
                        <i class="fas fa-paper-plane"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="{{ asset('front/css/about.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/contact.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('front/js/animations.js') }}"></script>
<script>
// Initialize particles with random positions
document.querySelectorAll('.particle').forEach(particle => {
  const randomX = Math.random() * 2 - 1;
  const randomY = Math.random() * 2 - 1;
  particle.style.setProperty('--i', Math.random() * 2 + 1);
  particle.style.left = `${Math.random() * 100}%`;
  particle.style.top = `${Math.random() * 100}%`;
});

// Simple animation for elements when they come into view
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.fade-in');
    
    elements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;
        
        if (elementPosition < screenPosition) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }
    });
};

// Run animation on scroll
window.addEventListener('scroll', animateOnScroll);
// Run once on page load
animateOnScroll();
</script>
@endpush