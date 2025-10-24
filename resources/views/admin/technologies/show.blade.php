@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Technology Details: {{ $technology->name }}</h6>
            <a href="{{ route('technologies.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name:</label>
                        <p>{{ $technology->name }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon:</label>
                        <p>
                            @if($technology->icon)
                                <i class="{{ $technology->icon }} fa-2x"></i>
                                <span class="ms-2">{{ $technology->icon }}</span>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('technologies.edit', $technology) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Technology
                </a>
            </div>
        </div>
    </div>
</div>
@endsection