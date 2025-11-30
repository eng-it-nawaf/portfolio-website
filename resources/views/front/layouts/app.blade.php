<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Nawaf | Portfolio - Software Developer') }} | @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    @if(app()->getLocale() == 'ar')
        <!-- Bootstrap RTL -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-rtl@5.3.0/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
    @endif
    
    <!-- Custom CSS -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    @stack('styles')
</head>
<body class="global-background">
    <!-- تأثيرات الخلفية -->
    
    
    <!-- Fixed Image -->
    {{--  @if(isset($profile) && $profile->photo)
    <div class="fixed-profile-image">
        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="fixed-profile-img">
    </div>
    @endif  --}}
    
    <!-- Navigation -->
    @include('front.partials.navbar')
    
    <!-- Main Content -->
    <main >
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('front.partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('front/js/front.js') }}"></script>
    <script src="{{ asset('front/js/animations.js') }}"></script>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('scripts')
    
</body>
</html>





