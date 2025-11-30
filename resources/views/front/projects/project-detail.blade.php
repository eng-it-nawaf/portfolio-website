@extends('front.layouts.app')

@section('title', $project->title . ' - ' . __('Project Details'))

@section('content')
<section class="project-detail-section">
    <!-- Floating Background Elements -->
    <div class="floating-element" style="width: 100px; height: 100px; top: 10%; left: 5%; animation-delay: 0s;"></div>
    <div class="floating-element" style="width: 150px; height: 150px; bottom: 15%; right: 8%; animation-delay: 2s;"></div>
    <div class="floating-element" style="width: 80px; height: 80px; top: 30%; right: 10%; animation-delay: 4s;"></div>
    
    <div class="container">
        <!-- Back Button -->
        <div class="animate__animated animate__fadeInDown">
            <a href="{{ route('projects') }}" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i> 
                <span class="d-none d-sm-inline">{{ __('Back to projects') }}</span>
            </a>
        </div>

        <!-- Project Header -->
        <div class="project-header animate__animated animate__fadeIn">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <h1 class="project-title">{{ $project->title }}</h1>
                <div class="project-meta">
                    <span class="project-category">
                        @if($project->category == 'web')
                            <i class="fas fa-globe me-1"></i> {{ __('Web Application') }}
                        @elseif($project->category == 'mobile')
                            <i class="fas fa-mobile-alt me-1"></i> {{ __('Mobile App') }}
                        @else
                            <i class="fas fa-desktop me-1"></i> {{ __('Desktop App') }}
                        @endif
                    </span>
                    @if($project->completed_at)
                    <span class="project-date">
                        <i class="far fa-calendar-alt me-1"></i> 
                        {{ $project->completed_at->format('M Y') }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Main Gallery -->
            <div class="col-lg-8">
                <div class="project-gallery-container animate__animated animate__fadeIn">
                    <!-- Swiper Slider -->
                    <div class="swiper-container project-swiper">
                        <div class="swiper-wrapper">
                            @foreach($project->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $project->title }} - Image {{ $loop->iteration }}" 
                                     class="img-fluid rounded-3"
                                     loading="lazy">
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- Project Description -->
                <div class="project-content animate__animated animate__fadeInUp">
                    <h2 class="section-title">
                        <i class="fas fa-align-left me-2"></i> {{ __('Project Overview') }}
                    </h2>
                    <div class="project-description">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="project-sidebar">
                    <!-- Technologies Used -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-code me-2"></i> {{ __('Technologies Stack') }}
                        </h3>
                        <div class="tech-tags">
                            @foreach(explode(',', $project->technologies) as $tech)
                            <span class="tech-tag">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Links -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-rocket me-2"></i> {{ __('Project Links') }}
                        </h3>
                        <div class="project-links-grid">
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="project-link github-link">
                                <div class="link-icon">
                                    <i class="fab fa-github"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">{{ __('GitHub Repository') }}</span>
                                    <span class="link-subtitle">{{ __('View source code') }}</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                            
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="project-link demo-link">
                                <div class="link-icon">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">{{ __('Live Demo') }}</span>
                                    <span class="link-subtitle">{{ __('Try it online') }}</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                            
                            @if($project->play_store_url)
                            <a href="{{ $project->play_store_url }}" target="_blank" rel="noopener noreferrer" class="project-link playstore-link">
                                <div class="link-icon">
                                    <i class="fab fa-google-play"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">{{ __('Google Play') }}</span>
                                    <span class="link-subtitle">{{ __('Download app') }}</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-info-circle me-2"></i> {{ __('Project Details') }}
                        </h3>
                        <ul class="project-info-list">
                            <li>
                                <i class="fas fa-layer-group me-2"></i>
                                <strong>{{ __('Category') }}:</strong> 
                                @if($project->category == 'web')
                                   {{ __('Web Application') }}
                                @elseif($project->category == 'mobile')
                                   {{ __('Mobile Application') }}
                                @else
                                   {{ __('Desktop Application') }}
                                @endif
                            </li>
                            @if($project->client)
                            <li>
                                <i class="fas fa-user-tie me-2"></i>
                                <strong>{{ __('Client') }}:</strong> {{ $project->client }}
                            </li>
                            @endif
                            @if($project->completed_at)
                            <li>
                                <i class="far fa-calendar-check me-2"></i>
                                <strong>{{ __('Completed') }}:</strong> {{ $project->completed_at->format('F Y') }}
                            </li>
                            @endif
                            @if($project->duration)
                            <li>
                                <i class="fas fa-clock me-2"></i>
                                <strong>{{ __('Duration') }}:</strong> {{ $project->duration }}
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="related-projects">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ __('You Might Also Like') }}</h2>
            <p class="section-subtitle">{{ __('Explore other projects that may interest you') }}</p>
        </div>
        
        <div class="swiper-container related-projects-slider">
            <div class="swiper-wrapper">
                @foreach($relatedProjects as $related)
                <div class="swiper-slide">
                    <div class="project-card">
                        <div class="project-card-image">
                            @if($related->images->count() > 0)
                                <img src="{{ asset('storage/' . $related->images[0]->image_path) }}" 
                                     alt="{{ $related->title }}"
                                     class="img-fluid"
                                     loading="lazy">
                            @endif
                            <div class="project-overlay">
                                <a href="{{ route('project.detail', $related->id) }}" class="btn btn-view">
                                    <i class="fas fa-eye me-1"></i> {{ __('View Project') }}
                                </a>
                            </div>
                        </div>
                        <div class="project-card-body">
                            <h5 class="project-card-title">{{ $related->title }}</h5>
                            <p class="project-card-text">{{ Str::limit($related->description, 100) }}</p>
                            <div class="project-card-footer">
                                <span class="badge">
                                    @if($related->category == 'web')
                                        {{ __('Web') }}
                                    @elseif($related->category == 'mobile')
                                        {{ __('Mobile') }}
                                    @else
                                        {{ __('Desktop') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link href="{{ asset('front/css/project-detail.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize main project swiper
    const projectSwiper = new Swiper('.project-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
        grabCursor: true,
        preloadImages: false,
        lazy: true,
    });

    // Initialize related projects swiper
    const relatedSwiper = new Swiper('.related-projects-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        }
    });

    // GSAP Animations
    gsap.from('.project-title', {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: 'power3.out'
    });

    gsap.from('.project-meta span', {
        duration: 1,
        x: -20,
        opacity: 0,
        stagger: 0.2,
        delay: 0.3,
        ease: 'back.out'
    });

    gsap.from('.project-gallery-container', {
        duration: 1,
        y: 50,
        opacity: 0,
        delay: 0.5,
        ease: 'power3.out'
    });

    gsap.from('.sidebar-card', {
        duration: 0.8,
        x: 50,
        opacity: 0,
        stagger: 0.2,
        delay: 0.7,
        ease: 'back.out'
    });

    // Floating elements animation
    const floatingElements = document.querySelectorAll('.floating-element');
    floatingElements.forEach((el, index) => {
        gsap.to(el, {
            y: 20,
            duration: 5 + index,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    });

    // Enhanced link click animation
    document.querySelectorAll('.project-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.getAttribute('target') || this.getAttribute('target') === '_self') {
                e.preventDefault();
                
                gsap.to(this, {
                    scale: 0.95,
                    duration: 0.2,
                    yoyo: true,
                    repeat: 1,
                    ease: "power1.inOut",
                    onComplete: () => {
                        window.location.href = this.href;
                    }
                });
            }
        });
    });

    // Scroll animations
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate__animated');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if(elementPosition < screenPosition) {
                const animationClass = Array.from(element.classList).find(cls => 
                    cls.startsWith('animate__') && cls !== 'animate__animated'
                );
                
                if(animationClass) {
                    element.classList.add(animationClass);
                }
            }
        });
    };

    // Run on load and on scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

    // Touch device optimizations
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
    }
});
</script>
@endpush