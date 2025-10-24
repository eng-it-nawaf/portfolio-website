@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Technology: {{ $technology->name }}</h6>
            <a href="{{ route('technologies.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('technologies.update', $technology) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Technology Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $technology->name) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Class (Font Awesome)</label>
                    <input type="text" class="form-control" id="icon" name="icon" 
                           value="{{ old('icon', $technology->icon) }}" 
                           placeholder="Example: fab fa-laravel">
                    <small class="text-muted">Leave empty if no icon needed</small>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Technology</button>
            </form>
        </div>
    </div>
</div>
@endsection