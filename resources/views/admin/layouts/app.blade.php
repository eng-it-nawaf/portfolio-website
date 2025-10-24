<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Tajawal:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">

    
    @stack('styles')
</head>
<body class="admin-body">

 

    <div class="admin-container">
        <!-- Sidebar -->
        @include('admin.layouts.partials.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            @include('admin.layouts.partials.header')
            
            <!-- Main Content Area -->
            <main class="content-wrapper">
                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="admin-footer">
                <p>© {{ date('Y') }} جميع الحقوق محفوظة لـ {{ config('app.name') }}</p>
            </footer>
        </div>
    </div>
    
    <!-- Scripts -->
    @include('admin.layouts.partials.scripts')
    @stack('scripts')
</body>
</html>