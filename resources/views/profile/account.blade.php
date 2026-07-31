@extends('layouts.client_home')

@section('content')
<!-- Lớp nền ăn theo layout chung, tone màu sáng nhẹ để làm nổi bật form -->
<div class="bg-cream min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Tiêu đề -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-[#1F2937]">Thông tin cá nhân</h1>
                <p class="text-gray-500 text-sm mt-1">Cập nhật thông tin của bạn để trải nghiệm dịch vụ tốt hơn.</p>
            </div>
        </div>

        <!-- Breadcrumb (Đường dẫn) -->
        <div class="text-sm text-gray-500 mb-6 font-medium">
            <a href="{{ url('/') }}" class="hover:text-[#354A3D] transition-colors">Trang chủ</a>
            <span class="mx-2">/</span>
            <span class="text-[#354A3D] font-bold">Tài khoản cá nhân</span>
        </div>

        <div class="flex flex-col md:flex-row gap-8">

            <!-- ================= CỘT TRÁI: SIDEBAR ================= -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <ul class="flex flex-col space-y-2">
                        <!-- Menu đang chọn (Active) -->
                        <li>
                            <a href="{{ url('/profile') }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#354A3D] text-white font-bold transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-address-card text-lg w-6 text-center"></i>
                                    <span>Tài khoản của tôi</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                        <!-- Các menu khác -->
                        <li>
                            <a href="{{ url('/orders') }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-cart-shopping text-lg w-6 text-center"></i>
                                    <span>Đơn hàng</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/orders/history') }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-clipboard-list text-lg w-6 text-center"></i>
                                    <span>Lịch sử đơn hàng</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/help') }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-headset text-lg w-6 text-center"></i>
                                    <span>Trung tâm trợ giúp</span>
                                </div>
                            </a>
                        </li>
                        <div class="border-t border-gray-100 my-2"></div>
                        <!-- Nút Đăng xuất -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-gray-600 hover:text-red-600 font-medium transition-colors text-left">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-lg w-6 text-center"></i>
                                        <span>Đăng xuất</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ================= CỘT PHẢI: NỘI DUNG ================= -->
            <div class="w-full md:w-3/4">
                <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-sm border border-gray-100">

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Họ & tên</label>
                                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-[#354A3D] outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-[#354A3D] outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Giới tính</label>
                                <div class="relative">
                                    <select name="gender"
                                        class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 appearance-none focus:ring-2 focus:ring-[#354A3D] outline-none">
                                        <option value="">Chọn giới tính</option>
                                        <option value="male" {{ ($user->gender ?? '') == 'male' ? 'selected' : '' }}>Nam</option>
                                        <option value="female" {{ ($user->gender ?? '') == 'female' ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-500">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Ngày sinh</label>
                                <input type="date" name="dob" value="{{ old('dob', $user->dob ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-[#354A3D] outline-none">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email đăng nhập</label>
                                <input type="email" value="{{ $user->email ?? '' }}" readonly
                                    class="w-full bg-gray-100 text-gray-500 border-none rounded-xl px-5 py-3.5 cursor-not-allowed outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tỉnh/Thành phố</label>
                                <div class="relative">
                                    <select id="province" name="province_id"
                                        class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 appearance-none focus:outline-none focus:ring-2 focus:ring-[#354A3D] transition-all cursor-pointer">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-500">
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Quận/Huyện</label>
                                <div class="relative">
                                    <select id="district" name="district_id" disabled
                                        class="w-full bg-gray-100 text-gray-400 border-none rounded-xl px-5 py-3.5 appearance-none focus:outline-none transition-all">
                                        <option value="">Chọn Quận/Huyện</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-400">
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phường/Xã</label>
                                <div class="relative">
                                    <select id="ward" name="ward_id" disabled
                                        class="w-full bg-gray-100 text-gray-400 border-none rounded-xl px-5 py-3.5 appearance-none outline-none transition-all">
                                        <option value="">Chọn Phường/Xã</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ cụ thể (Số nhà, tên đường...)</label>
                                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-[#354A3D] outline-none">
                            </div>
                        </div>

                        <div class="mt-10 flex justify-end">
                            <button type="submit"
                                class="bg-[#354A3D] hover:bg-[#2A4435] text-white font-bold py-3.5 px-10 rounded-xl transition-colors shadow-md w-full md:w-auto">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection <!-- BẮT BUỘC PHẢI CÓ DÒNG NÀY ĐỂ ĐÓNG PHẦN NỘI DUNG LẠI -->

<!-- CHUYỂN SCRIPT VÀO ĐÚNG SECTION DÀNH CHO SCRIPT -->
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        const oldProvince = "{{ old('province_id', $user->province_id ?? '') }}";
        const oldDistrict = "{{ old('district_id', $user->district_id ?? '') }}";
        const oldWard = "{{ old('ward_id', $user->ward_id ?? '') }}";

        axios.get('https://provinces.open-api.vn/api/p/')
            .then(response => {
                response.data.forEach(province => {
                    let option = document.createElement('option');
                    option.value = province.code;
                    option.text = province.name;
                    provinceSelect.appendChild(option);
                });
                if (oldProvince) {
                    provinceSelect.value = oldProvince;
                    loadDistricts(oldProvince, oldDistrict);
                }
            });

        function loadDistricts(provinceCode, districtToSelect = null) {
            districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
            wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            wardSelect.disabled = true;
            wardSelect.classList.remove('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800');
            wardSelect.classList.add('bg-gray-100', 'text-gray-400');

            if (provinceCode) {
                axios.get(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                    .then(response => {
                        response.data.districts.forEach(district => {
                            let option = document.createElement('option');
                            option.value = district.code;
                            option.text = district.name;
                            districtSelect.appendChild(option);
                        });
                        districtSelect.disabled = false;
                        districtSelect.classList.remove('bg-gray-100', 'text-gray-400');
                        districtSelect.classList.add('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800', 'focus:ring-2', 'focus:ring-[#354A3D]');
                        if (districtToSelect) {
                            districtSelect.value = districtToSelect;
                            loadWards(districtToSelect, oldWard);
                        }
                    });
            } else {
                districtSelect.disabled = true;
                districtSelect.classList.remove('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800');
                districtSelect.classList.add('bg-gray-100', 'text-gray-400');
            }
        }

        function loadWards(districtCode, wardToSelect = null) {
            wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            if (districtCode) {
                axios.get(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
                    .then(response => {
                        response.data.wards.forEach(ward => {
                            let option = document.createElement('option');
                            option.value = ward.code;
                            option.text = ward.name;
                            wardSelect.appendChild(option);
                        });
                        wardSelect.disabled = false;
                        wardSelect.classList.remove('bg-gray-100', 'text-gray-400');
                        wardSelect.classList.add('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800', 'focus:ring-2', 'focus:ring-[#354A3D]');
                        if (wardToSelect) {
                            wardSelect.value = wardToSelect;
                        }
                    });
            } else {
                wardSelect.disabled = true;
                wardSelect.classList.remove('bg-gray-50', 'border', 'border-gray-200', 'text-gray-800');
                wardSelect.classList.add('bg-gray-100', 'text-gray-400');
            }
        }

        provinceSelect.addEventListener('change', function () {
            loadDistricts(this.value);
        });

        districtSelect.addEventListener('change', function () {
            loadWards(this.value);
        });
    });
</script>
@endsection