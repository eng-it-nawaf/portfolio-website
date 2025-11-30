<section id="experience" class="experience-section">
    <div class="experience-container">
        <!-- Header -->
        <div class="experience-header">
            <h2 class="experience-title">
                <span class="experience-title-gradient">Journey Through Time</span>
            </h2>
            <div class="experience-underline"></div>
            <p class="experience-subtitle">
                My professional voyage through the cosmos of career development and learning
            </p>
        </div>

        <!-- Galaxy Timeline -->
        <div class="galaxy-timeline">
            <!-- Orbit -->
            <div class="timeline-orbit"></div>
            
            <!-- Center -->
            <div class="timeline-center">
                <div class="center-text">
                    <span>Career</span>
                    <span>Path</span>
                </div>
            </div>

            <!-- Floating Stars -->
            <div class="timeline-stars">
                @for($i = 0; $i < 20; $i++)
                <div class="timeline-star" style="
                    --star-size: {{ rand(1, 3) }}px;
                    --star-x: {{ rand(0, 100) }}%;
                    --star-y: {{ rand(0, 100) }}%;
                    --star-delay: {{ $i * 0.3 }}s;
                "></div>
                @endfor
            </div>

            <!-- Timeline Items -->
            <div class="timeline-items">
                @foreach($experiences as $experience)
                <div class="timeline-item {{ $experience->is_featured ? 'featured' : '' }}" 
                     data-year="{{ $experience->start_date->format('Y') }}">
                    
                    <!-- Header -->
                    <div class="item-header">
                        <div class="item-icon">
                            @if($experience->type == 'work')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                            </svg>
                            @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            @endif
                        </div>
                        
                        <div class="item-title-content">
                            <h3 class="item-title">{{ $experience->title }}</h3>
                            <div class="item-company">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>{{ $experience->company }}</span>
                            </div>
                        </div>
                        
                        <div class="item-period">
                            {{ $experience->start_date->format('M Y') }} - 
                            {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                        </div>
                    </div>

                    <!-- Description -->
                    @if($experience->description)
                    <div class="item-description">
                        <p>{{ $experience->description }}</p>
                    </div>
                    @endif

                    <!-- Technologies -->
                    @if($experience->technologies)
                    <div class="item-technologies">
                        @foreach(explode(',', $experience->technologies) as $tech)
                        <span class="tech-tag">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif

                    <!-- Footer -->
                    <div class="item-footer">
                        <span class="item-type">
                            {{ $experience->type == 'work' ? 'Work Experience' : 'Education' }}
                        </span>
                        <span class="item-duration">
                            {{ $experience->duration }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Dots -->
            <div class="timeline-nav">
                @php
                    $years = $experiences->pluck('start_date')->map(function($date) {
                        return $date->format('Y');
                    })->unique()->sort();
                    $totalYears = $years->count();
                    $angleStep = 360 / $totalYears;
                @endphp
                
                @foreach($years as $index => $year)
                @php
                    $angle = $index * $angleStep;
                    $rad = deg2rad($angle);
                    $radius = 45;
                    $x = 50 + $radius * cos($rad);
                    $y = 50 + $radius * sin($rad);
                @endphp
                <div class="nav-dot" 
                     style="left: {{ $x }}%; top: {{ $y }}%;"
                     data-year="{{ $year }}"
                     title="{{ $year }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<link href="{{ asset('front/css/experience.css') }}" rel="stylesheet">
    <script src="{{ asset('front/js/experience.js') }}"></script>
