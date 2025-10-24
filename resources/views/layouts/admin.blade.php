<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('admin.layouts.app')
    
    <div class="container-fluid">
        <div class="row">
            {{--  @include('admin.partials.sidebar')  --}}
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>