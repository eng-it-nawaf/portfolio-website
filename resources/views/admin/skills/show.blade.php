@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Skill Details: {{ $skill->name }}</h6>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name:</label>
                        <p>{{ $skill->name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Category:</label>
                        <p>{{ ucfirst($skill->category) }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Percentage:</label>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: {{ $skill->percentage }}%" 
                                 aria-valuenow="{{ $skill->percentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">{{ $skill->percentage }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Skill
                </a>
            </div>
        </div>
    </div>
</div>
@endsection