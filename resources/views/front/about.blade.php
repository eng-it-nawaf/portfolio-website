@extends('front.layouts.app')

@section('title', __('messages.about'))
    

@section('content')

<!-- Hero Section -->


<!-- About Section -->
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
                        <a href="{{ route('contact') }}" class="btn btn-outline-light">
                            {{ __('Contact Me') }}
                        </a>
                    </div>
                </div>
                
                <div class="heroImageColumn">
                    <div class="imageContainer">
                        <div class="imageWrapper">
                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="profileImage">
                            <div class="imageGlow"></div>
                        </div>
                    </div>
                </div>

                
            </div>
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

@push('scripts')
<script>
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

@endsection