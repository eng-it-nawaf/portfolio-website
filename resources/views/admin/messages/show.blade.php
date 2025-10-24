@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Message Details</h6>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">From:</label>
                        <p>{{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date:</label>
                        <p>{{ $message->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Subject:</label>
                <p>{{ $message->subject }}</p>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold">Message:</label>
                <div class="border p-3 bg-light rounded">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
            
            <div class="mt-4">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">
                    <i class="fas fa-reply"></i> Reply
                </a>
                
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection