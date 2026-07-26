@extends('layouts.admin')

@section('title', 'Quản lý Người dùng — Admin FADEGRA')

@section('content')

<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans">
    
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Người dùng</h1>
            <p class="text-sm text-gray-500 mt-1">Danh sách tài khoản và phân quyền hệ thống.</p>
        </div>
        <button onclick="openUserModal()" class="bg-[#354A3D] text-white px-5 py-2.5 rounded-lg font-medium shadow-sm hover:bg-[#2A4435] transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Thêm người dùng
        </button>
    </div>

    <!-- THÔNG BÁO -->
    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- THANH CÔNG CỤ: TÌM KIẾM & LỌC -->
    <form action="{{ route('users.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:w-96">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tên, email..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <select name="role" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#354A3D] w-full sm:w-auto">
                <option value="">Tất cả vai trò</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            <select name="status" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#354A3D] w-full sm:w-auto">
                <option value="">Trạng thái</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Đã khóa</option>
            </select>
            <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Lọc</button>
        </div>
    </form>

    <!-- BẢNG DỮ LIỆU (DATA TABLE) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Người dùng</th>
                        <th class="px-6 py-4 font-semibold">Vai trò</th>
                        <th class="px-6 py-4 font-semibold">Trạng thái</th>
                        <th class="px-6 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-sm text-gray-500">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=354A3D&color=fff' }}" alt="Avatar" class="w-10 h-10 rounded-full border border-gray-200">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php $roleName = $user->roleRelation ? $user->roleRelation->name : 'Khách hàng'; @endphp
                            <span class="text-xs font-medium px-2.5 py-1 rounded-md {{ $roleName === 'Admin' ? 'bg-purple-100 text-purple-700' : ($roleName === 'Nhân viên' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                {{ $roleName }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->status === 'active')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Đang hoạt động
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-700 bg-red-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Đã khóa
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Nút Sửa -->
                            <button onclick='openUserModal(@json($user))' class="text-blue-500 hover:text-blue-700 hover:bg-blue-50 p-2 rounded-lg transition" title="Sửa">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                            </button>
                            <!-- Nút Xóa -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition" title="Xóa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Không tìm thấy người dùng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Phân trang -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<!-- ============================================== -->
<!-- POPUP THÊM / SỬA NGƯỜI DÙNG (MODAL)            -->
<!-- ============================================== -->
<div id="userModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeUserModal()"></div>
    
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative z-10 p-6 sm:p-8 animate-[slideDown_0.3s_ease-out]">
        <button onclick="closeUserModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-6">Thêm Người dùng mới</h2>

        <form action="{{ route('users.store') }}" method="POST" id="userForm">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Họ và Tên <span class="text-red-500">*</span></label>
                    <input type="text" id="userName" name="name" required placeholder="Nhập họ tên đầy đủ..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="userEmail" name="email" required placeholder="example@gmail.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                </div>

                <div id="passwordGroup">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mật khẩu <span id="pwdAsterisk" class="text-red-500">*</span></label>
                    <input type="password" id="userPassword" name="password" placeholder="Nhập mật khẩu..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                    <p id="pwdHelp" class="text-xs text-gray-500 mt-1 hidden">Bỏ trống nếu không muốn đổi mật khẩu.</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Vai trò</label>
                        <select id="userRole" name="role_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                            <option value="">Chọn vai trò</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Trạng thái</label>
                        <select id="userStatus" name="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Đã khóa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeUserModal()" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition">Hủy bỏ</button>
                <button type="submit" id="modalSubmitBtn" class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-[#354A3D] hover:bg-[#2A4435] shadow-sm transition">Lưu người dùng</button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes slideDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<script>
    function openUserModal(user = null) {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        
        if (user) {
            document.getElementById('modalTitle').innerText = 'Chỉnh sửa Người dùng';
            document.getElementById('modalSubmitBtn').innerText = 'Cập nhật thay đổi';
            document.getElementById('methodField').value = 'PUT'; 
            
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userRole').value = user.role_id || '';
            document.getElementById('userStatus').value = user.status || 'active';
            
            document.getElementById('userPassword').required = false;
            document.getElementById('pwdAsterisk').classList.add('hidden');
            document.getElementById('pwdHelp').classList.remove('hidden');
            
            form.action = `/admin/users/${user.id}`; 
        } else {
            document.getElementById('modalTitle').innerText = 'Thêm Người dùng mới';
            document.getElementById('modalSubmitBtn').innerText = 'Tạo người dùng';
            document.getElementById('methodField').value = 'POST';
            
            form.reset();
            
            document.getElementById('userPassword').required = true;
            document.getElementById('pwdAsterisk').classList.remove('hidden');
            document.getElementById('pwdHelp').classList.add('hidden');

            form.action = `{{ route('users.store') }}`; 
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserModal() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection