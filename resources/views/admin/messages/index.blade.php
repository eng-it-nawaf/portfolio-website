@extends('admin.layouts.app')

@section('title', 'إدارة الرسائل')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">رسائل الزوار</h1>
            <p class="page-description">إدارة جميع الرسائل الواردة من الزوار</p>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            @if($messages->count() > 0)
            <div class="table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الموضوع</th>
                            <th width="120">التاريخ</th>
                            <th width="100">الحالة</th>
                            <th width="120">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'unread' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-info-sm">
                                    <span class="user-name">{{ $message->name }}</span>
                                </div>
                            </td>
                            <td>{{ $message->email }}</td>
                            <td>
                                <span class="message-subject">{{ Str::limit($message->subject, 40) }}</span>
                            </td>
                            <td>
                                <span class="message-date">{{ $message->created_at->format('d/m/Y') }}</span>
                                <small class="message-time">{{ $message->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                @if($message->is_read)
                                    <span class="status-badge read">مقروء</span>
                                @else
                                    <span class="status-badge unread">جديد</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="btn-action view" title="عرض الرسالة">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="حذف الرسالة" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <h3 class="empty-title">لا توجد رسائل</h3>
                <p class="empty-description">لم تتلق أي رسائل حتى الآن.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.table-container {
    overflow-x: auto;
}

.admin-table tr.unread {
    background: #f0f9ff;
    border-right: 3px solid var(--primary-color);
}

.user-info-sm {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-name {
    font-weight: 500;
    color: var(--dark-color);
}

.message-subject {
    font-size: 13px;
    color: var(--dark-color);
}

.message-date {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: var(--dark-color);
}

.message-time {
    font-size: 11px;
    color: var(--secondary-color);
}

.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.read {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.unread {
    background: #fef3c7;
    color: #92400e;
}

.actions {
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 12px;
}

.btn-action.view {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-action.view:hover {
    background: #1d4ed8;
    color: white;
}

.btn-action.delete {
    background: #fef2f2;
    color: #dc2626;
}

.btn-action.delete:hover {
    background: #dc2626;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: var(--secondary-color);
    font-size: 32px;
}

.empty-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 8px;
}

.empty-description {
    font-size: 14px;
    color: var(--secondary-color);
    margin: 0;
}

@media (max-width: 768px) {
    .admin-table {
        font-size: 12px;
    }
    
    .admin-table th,
    .admin-table td {
        padding: 8px 12px;
    }
    
    .actions {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-action {
        width: 28px;
        height: 28px;
    }
}
</style>
@endsection