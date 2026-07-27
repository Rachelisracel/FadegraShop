<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $menuData = [
            'bestSeller' => [
                'label' => 'Best Seller',
                'items' => [
                    ['name' => 'Trà Sữa Truyền Thống', 'price' => 20],
                    ['name' => 'Matcha Latte Oatside Vị Nguyên Bản', 'price' => 28],
                    ['name' => 'Trà Đào', 'price' => 20],
                ],
            ],
            'tra' => [
                'label' => 'Trà',
                'items' => [
                    ['name' => 'Ô Long Bí Đao', 'price' => 15],
                    ['name' => 'Hồng Trà Trân Châu', 'price' => 20],
                    ['name' => 'Trà Dưa Lưới', 'price' => 20],
                    ['name' => 'Trà Việt Quất', 'price' => 20],
                    ['name' => 'Trà Đào', 'price' => 20],
                    ['name' => 'Trà Vải', 'price' => 20],
                    ['name' => 'Trà Dâu', 'price' => 20],
                ],
            ],
            'traSua' => [
                'label' => 'Trà Sữa',
                'items' => [
                    ['name' => 'Trà Sữa Matcha', 'price' => 28],
                    ['name' => 'Trà Sữa Chocolate', 'price' => 20],
                    ['name' => 'Trà Sữa Khoai Môn', 'price' => 20],
                    ['name' => 'Trà Sữa Dưa Lưới', 'price' => 20],
                    ['name' => 'Trà Sữa Việt Quất', 'price' => 20],
                    ['name' => 'Trà Sữa Thái Xanh', 'price' => 20],
                    ['name' => 'Trà Sữa Đào', 'price' => 20],
                    ['name' => 'Trà Sữa Vải', 'price' => 20],
                    ['name' => 'Trà Sữa Dâu', 'price' => 20],
                ],
            ],
            'suaTuoi' => [
                'label' => 'Sữa Tươi',
                'items' => [
                    ['name' => 'Sữa Tươi Trân Châu Đường Đen', 'price' => 25],
                ],
            ],
            'milo' => [
                'label' => 'Milo',
                'items' => [
                    ['name' => 'Milo Dầm Trân Châu Đường Đen', 'price' => 25],
                ],
            ],
            'topping' => [
                'label' => 'Topping thêm',
                'items' => [
                    ['name' => 'Bánh Flan', 'price' => 7],
                    ['name' => 'Trân Châu Đen', 'price' => 6],
                    ['name' => 'Pudding (4)', 'price' => 6],
                    ['name' => 'Sương Sáo (8)', 'price' => 6],
                    ['name' => 'Trân Châu Giòn', 'price' => 6],
                    ['name' => 'Thạch Khoai Dẻo', 'price' => 6],
                    ['name' => 'Thạch Rau Câu', 'price' => 6],
                    ['name' => 'Đào miếng (4)', 'price' => 5],
                    ['name' => 'Vải ngâm (3)', 'price' => 6],
                ],
            ],
        ];

        foreach ($menuData as $key => $catData) {
            $category = Category::firstOrCreate([
                'name' => $catData['label']
            ], [
                'slug' => Str::slug($catData['label'])
            ]);

            foreach ($catData['items'] as $item) {
                // Kiểm tra xem đã có chưa
                Product::firstOrCreate([
                    'name' => $item['name']
                ], [
                    'category_id' => $category->id,
                    'slug' => Str::slug($item['name']),
                    'price' => $item['price'] * 1000,
                    'stock' => 100,
                    'status' => 'active',
                    'unit' => $key === 'topping' ? 'phần' : 'ly'
                ]);
            }
        }
    }
}
