@extends('front.layouts.app')

@section('title', __('Innovation Gallery'))

@section('content')
<div class="projects-gallery-page">
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        @for($i = 0; $i < 8; $i++)
        <div class="floating-element" 
             style="
               width: {{ rand(50, 250) }}px;
               height: {{ rand(50, 250) }}px;
               top: {{ rand(0, 100) }}%;
               left: {{ rand(0, 100) }}%;
               animation-delay: {{ $i * 2 }}s;
             ">
        </div>
        @endfor
    </div>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="headerContent">
                <h1 class="title">{{ __('Innovation Gallery') }}</h1>
                <p class="subtitle">{{ __('Explore my creative works and technical solutions') }}</p>
            </div>
            
            <div class="filterContainer">
                <button class="filterButton" id="filterToggle">
                    <span id="filterText">{{ __('All Projects') }}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                
                <div class="dropdownMenu" id="filterDropdown" style="display: none;">
                    <button class="dropdownItem active" data-filter="all">{{ __('All Projects') }}</button>
                    @foreach($categories as $value => $label)
                        <button class="dropdownItem" data-filter="{{ $value }}">{{ $label }}</button>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Projects Grid -->
        <div class="projectsGrid" id="projectsContainer">
            @foreach($projects as $project)
                <div class="card @if($project->is_featured) featured @endif" 
                     data-category="{{ $project->category }}"
                     data-title="{{ strtolower($project->title) }}"
                     data-technologies="{{ strtolower($project->technologies) }}">
                    
                    @if($project->is_featured)
                        <div class="featuredBadge">{{ __('Featured') }}</div>
                    @endif
                    
                    <!-- Image Slider -->
                    <div class="imageContainer">
                        <div class="imageWrapper">
                            @foreach($project->images as $key => $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="image @if($key === 0) active @endif" 
                                     alt="{{ $project->title }} - {{ $loop->iteration }}"
                                     data-index="{{ $key }}"
                                     loading="lazy">
                            @endforeach
                        </div>
                        
                        @if($project->images->count() > 1)
                            <div class="imageNav">
                                @foreach($project->images as $key => $image)
                                    <button class="navDot @if($key === 0) active @endif" 
                                            data-index="{{ $key }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="cardContent">
                        <div class="cardHeader">
                            <div class="titleSection">
                                <h3>{{ $project->title }}</h3>
                                <div class="headerLinks">
                                    @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" class="headerLink" title="Live Demo">
                                        <i class="fas fa-external-link-alt headerLinkIcon"></i>
                                    </a>
                                    @endif
                                    @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="headerLink" title="Source Code">
                                        <i class="fab fa-github headerLinkIcon"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <p class="shortDescription">{{ $project->description }}</p>
                        
                        @if($project->technologies)
                            <div class="techContainer">
                                @foreach(explode(',', $project->technologies) as $tech)
                                    <span class="techPill">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="links">
                            <a href="{{ route('project.detail', $project->id) }}" class="link">
                                <i class="fas fa-eye linkIcon"></i>
                                <span>{{ __('View Details') }}</span>
                            </a>
                            
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="link">
                                    <i class="fas fa-external-link-alt linkIcon"></i>
                                    <span>{{ __('Live Demo') }}</span>
                                </a>
                            @endif
                            
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="link">
                                    <i class="fab fa-github linkIcon"></i>
                                    <span>{{ __('Source Code') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($projects->count() === 0)
            <div class="noResults">
                <h3>{{ __('No projects found') }}</h3>
                <button class="resetFilter" id="resetFilters">{{ __('Reset all filters') }}</button>
            </div>
        @endif
    </div>

    <!-- Image Modal -->
    <div class="imageModalBackdrop" id="imageModal" style="display: none;">
        <button class="closeModalBtn" id="closeModal">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="imageModalContent">
            <div class="modalImageContainer">
                <img src="" class="modalImage" id="modalImage" alt="">
            </div>
            
            <button class="navButtonLeft" id="modalPrev">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <button class="navButtonRight" id="modalNext">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="modalImageNav" id="modalNavDots"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="{{ asset('front/css/projects.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize image sliders for each project
    const projects = document.querySelectorAll('.card');
    
    projects.forEach(project => {
        const images = project.querySelectorAll('.image');
        const dots = project.querySelectorAll('.navDot');
        let currentIndex = 0;
        let interval;
        
        if (images.length > 1) {
            // Auto-rotate images every 5 seconds
            startSlider();
            
            // Pause on hover
            project.querySelector('.imageContainer').addEventListener('mouseenter', () => {
                clearInterval(interval);
            });
            
            project.querySelector('.imageContainer').addEventListener('mouseleave', startSlider);
            
            // Dot navigation
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    goToSlide(index);
                    resetInterval();
                });
            });
        }
        
        function startSlider() {
            interval = setInterval(() => {
                nextSlide();
            }, 5000);
        }
        
        function nextSlide() {
            let newIndex = (currentIndex + 1) % images.length;
            goToSlide(newIndex);
        }
        
        function goToSlide(index) {
            // Hide current image with animation
            images[currentIndex].classList.remove('active');
            images[currentIndex].style.opacity = '0';
            dots[currentIndex].classList.remove('active');
            
            // Update current index
            currentIndex = index;
            
            // Show new image with animation
            setTimeout(() => {
                images[currentIndex].classList.add('active');
                images[currentIndex].style.opacity = '1';
                dots[currentIndex].classList.add('active');
            }, 300);
        }
        
        function resetInterval() {
            clearInterval(interval);
            startSlider();
        }
    });
    
    // Filter functionality
    const filterToggle = document.getElementById('filterToggle');
    const filterDropdown = document.getElementById('filterDropdown');
    const filterText = document.getElementById('filterText');
    const filterItems = document.querySelectorAll('.dropdownItem');
    const projectItems = document.querySelectorAll('.card');
    const resetFilters = document.getElementById('resetFilters');
    
    filterToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        filterDropdown.style.display = filterDropdown.style.display === 'none' ? 'block' : 'none';
    });
    
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Update filter text
            filterText.textContent = this.textContent;
            
            // Update active state
            filterItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // Filter projects
            projectItems.forEach(project => {
                const category = project.getAttribute('data-category');
                
                if (filterValue === 'all' || category === filterValue) {
                    project.style.display = 'block';
                    setTimeout(() => {
                        project.style.opacity = '1';
                        project.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    project.style.opacity = '0';
                    project.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        project.style.display = 'none';
                    }, 300);
                }
            });
            
            // Hide dropdown
            filterDropdown.style.display = 'none';
            
            // Show no results message if no projects match
            const visibleProjects = document.querySelectorAll('.card[style*="display: block"]');
            const noResults = document.querySelector('.noResults');
            
            if (visibleProjects.length === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        filterDropdown.style.display = 'none';
    });
    
    // Reset filters
    if (resetFilters) {
        resetFilters.addEventListener('click', function() {
            filterText.textContent = 'All Projects';
            filterItems.forEach(i => i.classList.remove('active'));
            filterItems[0].classList.add('active');
            
            projectItems.forEach(project => {
                project.style.display = 'block';
                setTimeout(() => {
                    project.style.opacity = '1';
                    project.style.transform = 'translateY(0)';
                }, 100);
            });
            
            document.querySelector('.noResults').style.display = 'none';
        });
    }
    
    // Image modal functionality
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const modalPrev = document.getElementById('modalPrev');
    const modalNext = document.getElementById('modalNext');
    const modalNavDots = document.getElementById('modalNavDots');
    
    let currentModalProject = null;
    let currentModalIndex = 0;
    let modalImages = [];
    
    // Open modal when clicking on project image
    document.querySelectorAll('.image').forEach(img => {
        img.addEventListener('click', function() {
            const project = this.closest('.card');
            currentModalProject = project;
            modalImages = Array.from(project.querySelectorAll('.image'));
            currentModalIndex = parseInt(this.getAttribute('data-index'));
            
            openModal(this.src, this.alt);
        });
    });
    
    function openModal(src, alt) {
        modalImage.src = src;
        modalImage.alt = alt;
        
        // Create navigation dots
        modalNavDots.innerHTML = '';
        modalImages.forEach((img, index) => {
            const dot = document.createElement('button');
            dot.className = `modalNavDot ${index === currentModalIndex ? 'active' : ''}`;
            dot.setAttribute('data-index', index);
            dot.addEventListener('click', () => {
                goToModalImage(index);
            });
            modalNavDots.appendChild(dot);
        });
        
        imageModal.style.display = 'flex';
        setTimeout(() => {
            imageModal.classList.add('show');
        }, 50);
        document.body.style.overflow = 'hidden';
    }
    
    function closeModalFunc() {
        imageModal.classList.remove('show');
        setTimeout(() => {
            imageModal.style.display = 'none';
        }, 300);
        document.body.style.overflow = '';
    }
    
    function goToModalImage(index) {
        currentModalIndex = index;
        modalImage.style.opacity = '0';
        
        setTimeout(() => {
            modalImage.src = modalImages[index].src;
            modalImage.alt = modalImages[index].alt;
            modalImage.style.opacity = '1';
            
            // Update active dot
            document.querySelectorAll('.modalNavDot').forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }, 300);
    }
    
    function nextModalImage() {
        const newIndex = (currentModalIndex + 1) % modalImages.length;
        goToModalImage(newIndex);
    }
    
    function prevModalImage() {
        const newIndex = (currentModalIndex - 1 + modalImages.length) % modalImages.length;
        goToModalImage(newIndex);
    }
    
    closeModal.addEventListener('click', closeModalFunc);
    modalPrev.addEventListener('click', prevModalImage);
    modalNext.addEventListener('click', nextModalImage);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (imageModal.classList.contains('show')) {
            if (e.key === 'Escape') {
                closeModalFunc();
            } else if (e.key === 'ArrowRight') {
                nextModalImage();
            } else if (e.key === 'ArrowLeft') {
                prevModalImage();
            }
        }
    });
    
    // Close modal when clicking on backdrop
    imageModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModalFunc();
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe project cards
    document.querySelectorAll('.card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endpush