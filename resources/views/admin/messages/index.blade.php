@extends('admin.layouts.app')

@section('title', 'إدارة الرسائل')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">رسائل الزوار</h1>
            <p class="page-description">إدارة جميع الرسائل الواردة من الزوار</p>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الموضوع</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'bg-blue-50' }}">
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ Str::limit($message->subject, 30) }}</td>
                            <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($message->is_read)
                                    <span class="badge badge-success">مقروء</span>
                                @else
                                    <span class="badge badge-warning">جديد</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="حذف" onclick="return confirm('هل أنت متأكد؟')">
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
            
            {{--  <div class="mt-4">
                {{ $messages->links() }}
            </div>  --}}
        </div>
    </div>
</div>
@endsection