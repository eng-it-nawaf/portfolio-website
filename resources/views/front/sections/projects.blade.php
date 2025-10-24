<section id="projects" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">{{ __('Innovation Gallery') }}</h2>
            <p class="lead text-muted">{{ __('Where ideas come to life - Explore 5 projects') }}</p>
        </div>
        
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if($project->images->count() > 0)
                            <img src="{{ asset('storage/' . $project->images[0]->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $project->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                            <div class="mb-3">
                                <span class="badge bg-primary">
                                    @if($project->category == 'web')
                                        Web
                                    @elseif($project->category == 'mobile')
                                        Mobaile
                                    @else
                                       Desktop
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('project.detail', $project->id) }}" class="btn btn-sm btn-primary">
                                    التفاصيل
                                </a>
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                        <i class="fab fa-github"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('projects') }}" class="btn btn-primary btn-lg">
                {{ __('View All Projects') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>