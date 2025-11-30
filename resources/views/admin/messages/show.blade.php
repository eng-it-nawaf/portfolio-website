@extends('admin.layouts.app')

@section('title', 'تفاصيل الرسالة')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تفاصيل الرسالة</h1>
            <p class="page-description">عرض محتوى الرسالة وتفاصيلها</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.messages.index') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="message-details">
        <div class="message-header admin-card">
            <div class="card-body">
                <div class="message-meta">
                    <div class="sender-info">
                        <div class="sender-avatar">
                            {{ strtoupper(substr($message->name, 0, 1)) }}
                        </div>
                        <div class="sender-details">
                            <h3 class="sender-name">{{ $message->name }}</h3>
                            <p class="sender-email">{{ $message->email }}</p>
                        </div>
                    </div>
                    <div class="message-info">
                        <div class="message-date">
                            <i class="fas fa-calendar"></i>
                            {{ $message->created_at->format('d/m/Y') }}
                        </div>
                        <div class="message-time">
                            <i class="fas fa-clock"></i>
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="message-content admin-card">
            <div class="card-header">
                <h3 class="card-title">الموضوع: {{ $message->subject }}</h3>
                <span class="message-status {{ $message->is_read ? 'read' : 'unread' }}">
                    {{ $message->is_read ? 'مقروء' : 'جديد' }}
                </span>
            </div>
            <div class="card-body">
                <div class="message-body">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
        </div>

        <div class="message-actions admin-card">
            <div class="card-body">
                <div class="actions-row">
                    <a href="mailto:{{ $message->email }}?subject=رد على: {{ $message->subject }}" class="btn btn-primary">
                        <i class="fas fa-reply"></i> رد
                    </a>
                    
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </form>
                    
                    @if(!$message->is_read)
                    <form action="{{ route('admin.messages.markAsRead', $message) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-check"></i> تعيين كمقروء
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.message-details {
    space-y: 24px;
}

.message-header .card-body {
    padding: 24px;
}

.message-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.sender-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.sender-avatar {
    width: 60px;
    height: 60px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.sender-details h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--dark-color);
    margin: 0 0 4px 0;
}

.sender-email {
    font-size: 13px;
    color: var(--secondary-color);
    margin: 0;
}

.message-info {
    display: flex;
    gap: 20px;
}

.message-date,
.message-time {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--secondary-color);
}

.message-content .card-body {
    padding: 24px;
}

.message-body {
    font-size: 14px;
    line-height: 1.8;
    color: var(--dark-color);
    white-space: pre-wrap;
}

.message-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.message-status.read {
    background: #d1fae5;
    color: #065f46;
}

.message-status.unread {
    background: #fef3c7;
    color: #92400e;
}

.actions-row {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .message-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .message-info {
        width: 100%;
        justify-content: space-between;
    }
    
    .actions-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .actions-row .btn {
        justify-content: center;
    }
    
    .sender-info {
        width: 100%;
    }
}
</style>
@endsection