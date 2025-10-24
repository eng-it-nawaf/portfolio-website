<section id="hero" class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">{{ $profile->name }}</h1>
                <h2 class="h4 text-light mb-4">{{ $profile->title }}</h2>
                <p class="lead">{{ $profile->about }}</p>
                
                <div class="d-flex mt-4">
                    <a href="#contact" class="btn btn-light btn-lg me-3">
                        {{ __('messages.contact') }} <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('projects') }}" class="btn btn-outline-light btn-lg">
                        {{ __('View Projects') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center mt-5 mt-lg-0">
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" 
                     class="img-fluid rounded-circle border border-4 border-light" 
                     style="max-width: 350px;">
            </div>
        </div>
    </div>
</section>