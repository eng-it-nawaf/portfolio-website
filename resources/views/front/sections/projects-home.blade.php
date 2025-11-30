    <section id="projects" class="projects-section-new">
        <div class="container">
            <div class="header">
                <div class="headerContent">
                    <h1 class="title">{{ __('My Projects') }}</h1>
                    <p class="subtitle">{{ __('A showcase of my recent work and creative endeavors') }}</p>
                </div>
                
                <div class="filterContainer">
                    <button class="filterButton" id="filterButton">
                        <span>Filter by Category</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdownMenu" id="dropdownMenu" style="display: none;">
                        <button class="dropdownItem active" data-category="all">All Projects</button>
                        <button class="dropdownItem" data-category="web">Web Development</button>
                        <button class="dropdownItem" data-category="mobile">Mobile Apps</button>
                        <button class="dropdownItem" data-category="desktop">Desktop Applications</button>
                        <button class="dropdownItem" data-category="featured">Featured</button>
                    </div>
                </div>
            </div>

            <div class="projectsGrid" id="projectsGrid">
                @foreach($projects as $project)
                <div class="card {{ $project->is_featured ? 'featured' : '' }}" 
                     data-category="{{ $project->category }} {{ $project->is_featured ? 'featured' : '' }}">
                    <div class="imageContainer">
                        <div class="imageWrapper">
                            @if($project->images->count() > 0)
                                <img src="{{ asset('storage/' . $project->images[0]->image_path) }}" 
                                     alt="{{ $project->title }}"
                                     class="image"
                                     onclick="openImageModal({{ $project->id }}, 0)">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #B8B8B8;">
                                    <i class="fas fa-image" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>
                        
                        @if($project->images->count() > 1)
                        <div class="imageNav">
                            @foreach($project->images as $index => $image)
                            <button class="navDot {{ $index === 0 ? 'active' : '' }}" 
                                    onclick="changeImage({{ $project->id }}, {{ $index }})"></button>
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
                        
                        <p class="shortDescription">
                            {{ $project->description }}
                        </p>
                        
                        @if($project->technologies)
                        <div class="techContainer">
                            @foreach(explode(',', $project->technologies) as $tech)
                            <span class="techPill">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>