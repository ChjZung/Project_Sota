<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Nhi Binh Factory VSIP 2A Front',
                'subtitle' => 'Nhà máy sản xuất Nhựa Nhị Bình hiện đại',
                'image' => '/thumbs/1366x580x1/upload/photo/nhibinhfactoryvsip2afront-71880.jpg',
                'link' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sản phẩm Nhựa Nhị Bình',
                'subtitle' => 'Chuyên gia công ép phun nhựa chính xác',
                'image' => '/thumbs/1366x580x1/upload/photo/nhibinhfactoryvsip2aside-48750.jpg',
                'link' => '/products',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Phòng ép phun tự động hóa',
                'subtitle' => 'Hơn 50 máy ép hiện đại trang bị cánh tay robot',
                'image' => '/thumbs/1366x580x1/upload/photo/nhibinhfactoryvsip2ainjectionroom-4412.jpg',
                'link' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Kho nguyên liệu & thành phẩm',
                'subtitle' => 'Hệ thống kho hàng tiêu chuẩn xuất khẩu',
                'image' => '/thumbs/1366x580x1/upload/photo/warehouse-5-38080.jpg',
                'link' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Phòng đóng gói kiểm tra chất lượng',
                'subtitle' => 'Kiểm soát chất lượng nghiêm ngặt ISO 9001:2015',
                'image' => '/thumbs/1366x580x1/upload/photo/packing-room-75940.jpg',
                'link' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['image' => $banner['image']],
                $banner
            );
        }
    }
}
