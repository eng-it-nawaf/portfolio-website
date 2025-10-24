@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Create New Skill</h6>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Skill Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Name (e.g. FaReact)</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" required>
                    <small class="text-muted">Use icon names from react-icons library</small>
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="percentage" class="form-label">Percentage (1-100)</label>
                    <input type="number" class="form-control" id="percentage" name="percentage" 
                           min="1" max="100" value="{{ old('percentage') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Create Skill</button>
            </form>
        </div>
    </div>
</div>
@endsection