@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Experience Details: {{ $experience->title }}</h6>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Title:</label>
                        <p>{{ $experience->title }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Company:</label>
                        <p>{{ $experience->company }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Type:</label>
                        <p>{{ ucfirst($experience->type) }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Period:</label>
                        <p>
                            {{ $experience->start_date->format('M Y') }} - 
                            {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Duration:</label>
                        <p>
                            @php
                                $start = $experience->start_date;
                                $end = $experience->is_current ? now() : $experience->end_date;
                                $years = $end->diffInYears($start);
                                $months = $end->diffInMonths($start) % 12;
                                
                                $duration = '';
                                if ($years > 0) $duration .= $years . ' yr' . ($years > 1 ? 's' : '');
                                if ($months > 0) $duration .= ($years > 0 ? ' ' : '') . $months . ' mo' . ($months > 1 ? 's' : '');
                            @endphp
                            {{ $duration }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Description:</label>
                <p>{{ $experience->description ?: 'N/A' }}</p>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Experience
                </a>
            </div>
        </div>
    </div>
</div>
@endsection