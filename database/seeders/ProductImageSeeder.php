<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $menuData = [
            'bestSeller' => [
                'items' => [
                    ['name' => 'Trà Sữa Truyền Thống', 'image' => 'truyenthong.jpg'],
                    ['name' => 'Matcha Latte Oatside Vị Nguyên Bản', 'image' => 'matchalatte.jpg'],
                    ['name' => 'Trà Đào', 'image' => 'tradao.jpg'],
                ],
            ],
            'tra' => [
                'items' => [
                    ['name' => 'Ô Long Bí Đao', 'image' => 'olong-bidao.jpg'],
                    ['name' => 'Hồng Trà Trân Châu', 'image' => 'hongtra.JPG'],
                    ['name' => 'Trà Dưa Lưới', 'image' => 'tradualuoi.JPG'],
                    ['name' => 'Trà Việt Quất', 'image' => 'travq.JPG'],
                    ['name' => 'Trà Đào', 'image' => 'tradao.jpg'],
                    ['name' => 'Trà Vải', 'image' => 'travai.JPG'],
                    ['name' => 'Trà Dâu', 'image' => 'tradau.JPG'],
                ],
            ],
            'traSua' => [
                'items' => [
                    ['name' => 'Trà Sữa Matcha', 'image' => 'trasuamatcha.JPG'],
                    ['name' => 'Trà Sữa Chocolate', 'image' => 'chocolate.jpg'],
                    ['name' => 'Trà Sữa Khoai Môn', 'image' => 'trasuakhoaimon.JPG'],
                    ['name' => 'Trà Sữa Dưa Lưới', 'image' => 'trasuadualuoi.JPG'],
                    ['name' => 'Trà Sữa Việt Quất', 'image' => 'trasuavq.JPG'],
                    ['name' => 'Trà Sữa Thái Xanh', 'image' => 'thaixanh.jpg'],
                    ['name' => 'Trà Sữa Đào', 'image' => 'trasuadao.JPG'],
                    ['name' => 'Trà Sữa Vải', 'image' => 'trasuavai.JPG'],
                    ['name' => 'Trà Sữa Dâu', 'image' => 'trasuadau.JPG'],
                ],
            ],
            'suaTuoi' => [
                'items' => [
                    ['name' => 'Sữa Tươi Trân Châu Đường Đen', 'image' => 'suatuoi.jpg'],
                ],
            ],
            'milo' => [
                'items' => [
                    ['name' => 'Milo Dầm Trân Châu Đường Đen', 'image' => 'milo.jpg'],
                ],
            ],
        ];

        foreach ($menuData as $category) {
            foreach ($category['items'] as $item) {
                if (!isset($item['image'])) continue;

                $product = Product::where('name', $item['name'])->first();
                if ($product) {
                    ProductImage::updateOrCreate(
                        ['product_id' => $product->id],
                        ['image' => $item['image']]
                    );
                }
            }
        }
    }
}
