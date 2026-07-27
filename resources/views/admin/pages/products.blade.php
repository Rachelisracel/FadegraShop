@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm — Admin FADEGRA')

@section('content')
<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans">
    
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
            <p class="text-sm text-gray-500 mt-1">Danh sách đồ uống và topping của quán.</p>
        </div>
        <button onclick="openProductModal()" class="bg-[#354A3D] text-white px-5 py-2.5 rounded-lg font-medium shadow-sm hover:bg-[#2A4435] transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Thêm sản phẩm
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

    <!-- TÌM KIẾM & LỌC -->
    <form action="{{ route('products.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:w-96">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên sản phẩm..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <select name="category" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#354A3D] w-full sm:w-auto">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Lọc</button>
        </div>
    </form>

    <!-- DATA TABLE -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Sản phẩm</th>
                        <th class="px-6 py-4 font-semibold">Danh mục</th>
                        <th class="px-6 py-4 font-semibold">Giá / Tồn kho</th>
                        <th class="px-6 py-4 font-semibold">Trạng thái</th>
                        <th class="px-6 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-sm text-gray-500">#{{ $product->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border border-gray-200">
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('images/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-mug-hot text-gray-400"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-[10px] text-gray-400">{{ Str::limit($product->description, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $product->category->name ?? 'Không phân loại' }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <p class="font-bold text-[#354A3D]">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                            <p class="text-xs text-gray-500">Kho: {{ $product->stock }} {{ $product->unit }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($product->status === 'active')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Đang bán
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-700 bg-red-100 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Hết hàng
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button onclick='openProductModal(@json($product))' class="text-blue-500 hover:text-blue-700 hover:bg-blue-50 p-2 rounded-lg transition" title="Sửa">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                            </button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
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
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Không tìm thấy sản phẩm nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Phân trang -->
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<!-- MODAL THÊM/SỬA SẢN PHẨM -->
<div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeProductModal()"></div>
    
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl relative z-10 p-6 sm:p-8 animate-[slideDown_0.3s_ease-out] max-h-[90vh] overflow-y-auto">
        <button onclick="closeProductModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-6">Thêm Sản phẩm</h2>

        <form action="{{ route('products.store') }}" method="POST" id="productForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                    <input type="text" id="pName" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Danh mục <span class="text-red-500">*</span></label>
                    <select id="pCategory" name="category_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Trạng thái <span class="text-red-500">*</span></label>
                    <select id="pStatus" name="status" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                        <option value="active">Đang bán</option>
                        <option value="inactive">Hết hàng</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Giá bán (VNĐ) <span class="text-red-500">*</span></label>
                    <input type="number" id="pPrice" name="price" required min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Hình ảnh sản phẩm</label>
                    <input type="file" id="pImage" name="image" accept="image/*" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kho <span class="text-red-500">*</span></label>
                        <input type="number" id="pStock" name="stock" required min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Đơn vị</label>
                        <input type="text" id="pUnit" name="unit" placeholder="Ly, phần..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mô tả chi tiết</label>
                    <textarea id="pDesc" name="description" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition"></textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeProductModal()" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition">Hủy bỏ</button>
                <button type="submit" id="modalSubmitBtn" class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-[#354A3D] hover:bg-[#2A4435] shadow-sm transition">Lưu sản phẩm</button>
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
    function openProductModal(product = null) {
        const modal = document.getElementById('productModal');
        const form = document.getElementById('productForm');
        
        if (product) {
            document.getElementById('modalTitle').innerText = 'Sửa Sản phẩm';
            document.getElementById('modalSubmitBtn').innerText = 'Cập nhật thay đổi';
            document.getElementById('methodField').value = 'PUT'; 
            
            document.getElementById('pName').value = product.name;
            document.getElementById('pCategory').value = product.category_id || '';
            document.getElementById('pStatus').value = product.status || 'active';
            document.getElementById('pPrice').value = product.price;
            document.getElementById('pStock').value = product.stock;
            document.getElementById('pUnit').value = product.unit || '';
            document.getElementById('pDesc').value = product.description || '';
            
            form.action = `/admin/products/${product.id}`; 
        } else {
            document.getElementById('modalTitle').innerText = 'Thêm Sản phẩm';
            document.getElementById('modalSubmitBtn').innerText = 'Tạo sản phẩm';
            document.getElementById('methodField').value = 'POST';
            
            form.reset();
            form.action = `{{ route('products.store') }}`; 
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeProductModal() {
        const modal = document.getElementById('productModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
