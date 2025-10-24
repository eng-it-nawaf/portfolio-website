@extends('front.layouts.app')



@section('title', __('Home'))

@section('content')
<div class="mainContainer">
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
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-7" style="position: relative; z-index: 2;">
        @include('front.sections.skills')
    </section>

<!-- Projects Preview Section -->
<section id="projects" class="projects-section py-6">
    <div class="container">
        <div class="section-header text-center mb-6">
            <h2 class="section-title">{{ __('messages.projects') }}</h2>
            <p class="section-subtitle">{{ __('Some of my recent works') }}</p>
        </div>
        
        <div class="row g-4">
            @foreach($projects as $project)
            <div class="col-md-4">
                <div class="project-card h-100">
                    <div class="project-card-image">
                        @if($project->images->count() > 0)
                            <img src="{{ asset('storage/' . $project->images[0]->image_path) }}" 
                                 alt="{{ $project->title }}"
                                 class="img-fluid">
                        @endif
                        <div class="project-overlay">
                            <div class="project-badges">
                                <span class="project-category">
                                    @if($project->category == 'web')
                                        <i class="fas fa-globe me-1"></i> ويب
                                    @elseif($project->category == 'mobile')
                                        <i class="fas fa-mobile-alt me-1"></i> موبايل
                                    @else
                                        <i class="fas fa-desktop me-1"></i> سطح المكتب
                                    @endif
                                </span>
                            </div>
                            <div class="project-actions">
                                <a href="{{ route('project.detail', $project->id) }}" class="btn btn-view">
                                    <i class="fas fa-eye me-1"></i> التفاصيل
                                </a>
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="btn btn-github">
                                    <i class="fab fa-github"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <h5 class="project-card-title">{{ $project->title }}</h5>
                        <p class="project-card-text">{{ Str::limit($project->description, 80) }}</p>
                        @if($project->technologies)
                        <div class="project-technologies">
                            {{ Str::limit($project->technologies, 50) }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('projects') }}" class="btn btn-primary btn-lg btn-view-all">
                {{ __('View All Projects') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>


<!-- Experience Section -->
<section class="experience-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                <span class="gradient-text">{{ __('My Experience') }}</span>
            </h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="experience-timeline">
            @foreach($experiences as $experience)
            <div class="timeline-item">
                <div class="timeline-marker">
                    <div class="marker-dot"></div>
                    @if(!$loop->last)
                    <div class="marker-line"></div>
                    @endif
                </div>
                
                <div class="timeline-content">
                    <div class="timeline-header">
                        <h3>{{ $experience->title }}</h3>
                        <span class="timeline-period">
                            {{ $experience->start_date->format('M Y') }} - 
                            {{ $experience->is_current ? __('Present') : $experience->end_date->format('M Y') }}
                        </span>
                    </div>
                    
                    <h4 class="timeline-company">
                        <i class="fas fa-building"></i>
                        {{ $experience->company }}
                    </h4>
                    
                    @if($experience->description)
                    <div class="timeline-description">
                        <p>{{ $experience->description }}</p>
                    </div>
                    @endif
                    
                    <div class="timeline-footer">
                        <span class="timeline-type {{ $experience->type }}">
                            {{ $experience->type == 'work' ? __('Work Experience') : __('Education') }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('front.sections.contact')

</div>
@endsection