@extends('layouts.admin') 

@section('title', 'Quản lý Liên hệ')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="h4 font-weight-bold text-primary">Quản Lý Phản Hồi & Liên Hệ</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Khách hàng</th>
                            <th width="12%">Mã đơn hàng</th>
                            <th width="18%">Tiêu đề</th>
                            <th width="25%">Nội dung</th>
                            <th width="12%">Trạng thái</th>
                            <th width="8%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $contact->name }}</strong><br>
                                <small class="text-muted">{{ $contact->email }}</small><br>
                                <small class="text-muted">{{ $contact->phone ?? 'Không có SĐT' }}</small>
                            </td>
                            <td>
                                @if($contact->order_code)
                                    <span class="badge bg-info text-dark">{{ $contact->order_code }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td><strong>{{ $contact->subject }}</strong></td>
                            <td>
                                <div style="max-height: 80px; overflow-y: auto;">
                                    {{ $contact->message }}
                                </div>
                                <small class="text-muted d-block mt-1">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm 
                                        {{ $contact->status == 'pending' ? 'border-warning text-warning' : '' }}
                                        {{ $contact->status == 'processing' ? 'border-info text-info' : '' }}
                                        {{ $contact->status == 'resolved' ? 'border-success text-success' : '' }}">
                                        <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="processing" {{ $contact->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>Đã xong</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa phản hồi này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Chưa có phản hồi nào từ khách hàng.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection