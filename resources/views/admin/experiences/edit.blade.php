@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Experience: {{ $experience->title }}</h6>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $experience->title) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $experience->company) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="work" {{ old('type', $experience->type) == 'work' ? 'selected' : '' }}>Work</option>
                        <option value="education" {{ old('type', $experience->type) == 'education' ? 'selected' : '' }}>Education</option>
                    </select>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" 
                               {{ old('is_current', $experience->is_current) ? 'disabled' : '' }}>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="is_current" name="is_current" 
                                   {{ old('is_current', $experience->is_current) ? 'checked' : '' }} onchange="toggleEndDate(this)">
                            <label class="form-check-label" for="is_current">
                                I currently work/study here
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $experience->description) }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Experience</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleEndDate(checkbox) {
    const endDateInput = document.getElementById('end_date');
    endDateInput.disabled = checkbox.checked;
    if (checkbox.checked) {
        endDateInput.value = '';
    }
}
</script>
@endpush
@endsection