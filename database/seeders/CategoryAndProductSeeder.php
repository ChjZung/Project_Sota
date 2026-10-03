<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryAndProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cấu trúc Cây Danh Mục 2 Cấp chuẩn theo website
        $categoryTree = [
            [
                'name' => 'CUSTOM PLASTIC PRODUCTS',
                'slug' => 'custom-plastic-products',
                'sort_order' => 1,
                'description' => 'Sản xuất các sản phẩm nhựa kỹ thuật cao theo yêu cầu của khách hàng, với nhà xưởng và máy móc hiện đại.',
                'image' => '/assets/images/img-data/list.png',
                'children' => [
                    ['name' => 'Plastic Pet Toys, Dog Toys, Cat Toys', 'slug' => 'plastic-toys-for-pets', 'sort_order' => 1],
                    ['name' => 'Household Plastic Products', 'slug' => 'household-plastic-products', 'sort_order' => 2],
                    ['name' => 'Engineering Plastic Products, Technical Plastic Parts', 'slug' => 'engineering-plastic-parts', 'sort_order' => 3],
                    ['name' => 'Plastic Products For The Textile Industry', 'slug' => 'plastic-products-for-the-textile-industry', 'sort_order' => 4],
                    ['name' => 'Plastic Accessories For The Woodworking Industry', 'slug' => 'plastic-accessories-for-the-woodworking-industry', 'sort_order' => 5],
                    ['name' => 'Plastic Products For The Medical Industry', 'slug' => 'plastic-products-for-the-medical-industry', 'sort_order' => 6],
                    ['name' => 'Plastic Products For The Food Industry', 'slug' => 'plastic-products-for-the-food-industry', 'sort_order' => 7],
                    ['name' => 'Other Plastic Products, Plastic Parts', 'slug' => 'other-plastic-products-plastic-parts', 'sort_order' => 8],
                ]
            ],
            [
                'name' => 'NHI BINH PLASTIC PRODUCTS',
                'slug' => 'nhi-binh-plastic-products',
                'sort_order' => 2,
                'description' => 'Dòng sản phẩm nhựa mang thương hiệu Nhựa Nhị Bình phục vụ tiêu dùng, lưu trữ và bao bì.',
                'image' => '/assets/images/img-data/list.png',
                'children' => [
                    ['name' => 'False Eyelashes Plastic Storage Box', 'slug' => 'false-eyelashes-plastic-storage-box', 'sort_order' => 1],
                    ['name' => 'Plastic Products For The Packaging Industry', 'slug' => 'plastic-products-for-the-packaging-industry', 'sort_order' => 2],
                    ['name' => 'Consumer Plastic Products', 'slug' => 'consumer-plastic-products', 'sort_order' => 3],
                ]
            ],
            [
                'name' => 'Children Plastic Toys -Mibitoi',
                'slug' => 'children-plastic-toys-mibitoi',
                'sort_order' => 3,
                'description' => 'Thương hiệu đồ chơi trẻ em cao cấp Mibitoi an toàn, đạt chuẩn Châu Âu và Mỹ.',
                'image' => '/assets/images/img-data/list.png',
                'children' => [
                    ['name' => 'Plastic Beach Toys', 'slug' => 'plastic-beach-toys', 'sort_order' => 1],
                    ['name' => 'Children Plastic Educational Toys', 'slug' => 'children-plastic-educational-toys', 'sort_order' => 2],
                    ['name' => 'Plastic Kitchen Toys', 'slug' => 'plastic-kitchen-toys', 'sort_order' => 3],
                ]
            ],
        ];

        // Tạo hoặc cập nhật Category
        $catMap = [];
        foreach ($categoryTree as $rootData) {
            $children = $rootData['children'];
            unset($rootData['children']);

            $root = Category::updateOrCreate(
                ['slug' => $rootData['slug']],
                $rootData
            );
            $catMap[$root->slug] = $root->id;

            foreach ($children as $childData) {
                $childData['parent_id'] = $root->id;
                $child = Category::updateOrCreate(
                    ['slug' => $childData['slug']],
                    $childData
                );
                $catMap[$child->slug] = $child->id;
            }
        }

        // 2. Danh sách Sản Phẩm Thật với hình ảnh đầy đủ trong website
        $productsData = [
            // Tab 1: Custom Plastic Products
            [
                'name' => 'Small Black ABS Plastic Broom Handle End Cap with Hanging Loop',
                'slug' => 'small-black-abs-plastic-broom-handle-end-cap-with-hanging-loop',
                'cat_slug' => 'engineering-plastic-parts',
                'image' => '/thumbs/300x300x1/upload/product/1-4383.png',
                'product_code' => 'NBP-CAP-01',
                'material' => 'ABS nguyên sinh chịu lực',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
                'summary' => 'Nắp chụp đuôi cán chổi nhựa ABS nhỏ màu đen có móc treo tiện lợi, độ bền cao.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'Nhựa ABS kỹ thuật',
                    'Màu sắc' => 'Đen bóng',
                    'Đường kính' => '22 - 25 mm',
                    'Ứng dụng' => 'Cán chổi, cán cây lau nhà, dụng cụ vệ sinh',
                ]
            ],
            [
                'name' => 'Large white ABS lock',
                'slug' => 'large-white-abs-lock',
                'cat_slug' => 'household-plastic-products',
                'image' => '/thumbs/300x300x1/upload/product/2-3981.png',
                'product_code' => 'NBP-LOCK-L',
                'material' => 'ABS nguyên sinh cao cấp',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
                'summary' => 'Khóa nhựa ABS trắng loại lớn, cơ chế chốt gài thông minh, chịu lực kéo vượt trội.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'ABS chịu va đập',
                    'Màu sắc' => 'Trắng sứ',
                    'Kích thước' => '85 x 45 mm',
                    'Chứng nhận' => 'ISO 9001:2015, RoHS',
                ]
            ],
            [
                'name' => 'Small white ABS lock',
                'slug' => 'small-white-abs-lock',
                'cat_slug' => 'household-plastic-products',
                'image' => '/thumbs/300x300x1/upload/product/1-3909.png',
                'product_code' => 'NBP-LOCK-S',
                'material' => 'ABS nguyên sinh',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
                'summary' => 'Khóa nhựa ABS trắng loại nhỏ, tinh xảo, bề mặt hoàn thiện bóng mịn.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'ABS',
                    'Màu sắc' => 'Trắng sứ',
                    'Kích thước' => '55 x 30 mm',
                ]
            ],
            [
                'name' => 'ABS Plastic Hook TXF',
                'slug' => 'abs-plastic-hook-txf',
                'cat_slug' => 'household-plastic-products',
                'image' => '/thumbs/300x300x1/upload/product/1-2316.png',
                'product_code' => 'NBP-HOOK-TXF',
                'material' => 'ABS kỹ thuật',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
                'summary' => 'Móc treo nhựa ABS TXF chắc chắn, chịu tải trọng lớn, chống gãy nứt.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'ABS cao cấp',
                    'Tải trọng' => 'Lên đến 5kg',
                    'Màu sắc' => 'Trắng / Đen / Xám',
                ]
            ],
            [
                'name' => 'Soft cover foot 2',
                'slug' => 'soft-cover-foot-2',
                'cat_slug' => 'plastic-accessories-for-the-woodworking-industry',
                'image' => '/thumbs/300x300x1/upload/product/soft-cover-foot-2-6016.png',
                'product_code' => 'NBP-FOOT-02',
                'material' => 'Nhựa dẻo PP / TPE',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình)',
                'summary' => 'Nút bọc chân bàn ghế cao su mềm dẻo chống trầy xước sàn nhà, chống ồn.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'TPE / Soft PP',
                    'Ứng dụng' => 'Nội thất gỗ, chân ghế kim loại',
                ]
            ],
            [
                'name' => 'Plastic Bobbin Holder Textile',
                'slug' => 'plastic-bobbin-holder-textile',
                'cat_slug' => 'plastic-products-for-the-textile-industry',
                'image' => '/thumbs/300x300x1/upload/product/loi-bang-keo-1-9928.png',
                'product_code' => 'NBP-TEX-01',
                'material' => 'PP chống mài mòn',
                'origin' => 'Việt Nam',
                'summary' => 'Ống suốt cuộn chỉ nhựa chuyên dụng cho ngành dệt may tốc độ cao.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'Polypropylene (PP)',
                    'Khả năng chịu nhiệt' => '120°C',
                ]
            ],

            // Tab 2: Nhi Binh Plastic Products
            [
                'name' => 'False Eyelashes Plastic Storage Box Clear',
                'slug' => 'false-eyelashes-plastic-storage-box-clear',
                'cat_slug' => 'false-eyelashes-plastic-storage-box',
                'image' => '/thumbs/300x300x1/upload/product/logo-hop-bin-lon-trong-suot-1-1480-3985.jpg',
                'product_code' => 'NBP-EYE-01',
                'material' => 'Nhựa GPPS / Acrylic trong suốt cao cấp',
                'origin' => 'Việt Nam (Nhà máy Nhựa Nhị Bình - VSIP II-A)',
                'summary' => 'Hộp đựng lông mi giả trong suốt có nắp chốt khít, độ trong suốt quang học cao.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'GPPS trong suốt đạt chuẩn FDA',
                    'Đặc tính' => 'Không mùi, kháng bụi, siêu nhẹ',
                    'Kích thước' => '110 x 50 x 15 mm',
                ]
            ],
            [
                'name' => 'Multi-compartment False Eyelashes Storage Case Red',
                'slug' => 'multi-compartment-false-eyelashes-storage-case-red',
                'cat_slug' => 'false-eyelashes-plastic-storage-box',
                'image' => '/thumbs/300x300x1/upload/product/logo-hop-bin-do-co-vach-ngan-3-4176-5791.jpg',
                'product_code' => 'NBP-EYE-RED',
                'material' => 'PS / ABS cao cấp',
                'origin' => 'Việt Nam',
                'summary' => 'Hộp đựng mi giả và phụ kiện có vách ngăn tiện lợi màu đỏ sang trọng.',
                'is_featured' => true,
                'specs' => [
                    'Số ngăn' => '3 ngăn phân loại',
                    'Màu sắc' => 'Đỏ ruby phối nắp trong',
                ]
            ],
            [
                'name' => 'Plastic Packaging Box for Sugar and Candy',
                'slug' => 'plastic-packaging-box-for-sugar-and-candy',
                'cat_slug' => 'plastic-products-for-the-packaging-industry',
                'image' => '/thumbs/300x300x1/upload/product/nhi-binh-plastic-plastic-box-for-sugar-8784.jpg',
                'product_code' => 'NBP-PKG-01',
                'material' => 'PET / PP an toàn thực phẩm',
                'origin' => 'Việt Nam',
                'summary' => 'Hộp nhựa đựng thực phẩm, kẹo, đường có nắp đậy kín khí.',
                'is_featured' => true,
                'specs' => [
                    'Tiêu chuẩn' => 'Food Grade, FDA & RoHS',
                    'Dung tích' => '350 ml / 500 ml',
                ]
            ],
            [
                'name' => 'Custom Plastic Cover for Milk Can',
                'slug' => 'custom-plastic-cover-for-milk-can',
                'cat_slug' => 'consumer-plastic-products',
                'image' => '/thumbs/300x300x1/upload/product/nhua-nhi-binh-plastic-cover-for-milk-can-4-4296.jpg',
                'product_code' => 'NBP-CAN-04',
                'material' => 'PE dẻo nguyên sinh',
                'origin' => 'Việt Nam',
                'summary' => 'Nắp nhựa đậy lon sữa tiệt trùng, kín khít, dễ mở.',
                'is_featured' => true,
                'specs' => [
                    'Chất liệu' => 'LDPE mềm dẻo',
                    'Đường kính' => 'Standard can sizes (99mm, 127mm)',
                ]
            ],

            // Tab 3: Children Plastic Toys - Mibitoi
            [
                'name' => 'Miclik Smart Educational Assembly Toy Set 14',
                'slug' => 'miclik-smart-educational-assembly-toy-set-14',
                'cat_slug' => 'children-plastic-educational-toys',
                'image' => '/thumbs/300x300x1/upload/product/micliksbolapghepthongminh14-5479-1988.jpg',
                'product_code' => 'MIBI-EDU-14',
                'material' => 'PP không độc hại (BPA Free)',
                'origin' => 'Việt Nam (Mibitoi by Nhi Binh Plastic)',
                'summary' => 'Bộ đồ chơi lắp ghép thông minh Miclik rèn luyện tư duy không gian và sáng tạo cho bé.',
                'is_featured' => true,
                'specs' => [
                    'Độ tuổi phù hợp' => 'Từ 3 tuổi trở lên',
                    'Chứng nhận an toàn' => 'EN71 (Châu Âu), ASTM F963 (Mỹ)',
                    'Số chi tiết' => '48 mảnh ghép đa màu sắc',
                ]
            ],
            [
                'name' => 'Miclik Smart Construction Blocks L-3',
                'slug' => 'miclik-smart-construction-blocks-l-3',
                'cat_slug' => 'children-plastic-educational-toys',
                'image' => '/thumbs/300x300x1/upload/product/smart-toys-miclik-l-3-1922.png',
                'product_code' => 'MIBI-BLK-03',
                'material' => 'Nhựa nguyên sinh an toàn tuyệt đối',
                'origin' => 'Việt Nam',
                'summary' => 'Khối ghép hình học tư duy sáng tạo phát triển trí não trẻ thơ.',
                'is_featured' => true,
                'specs' => [
                    'Tiêu chuẩn' => 'BSCI, ISO 9001, RoHS',
                    'Đặc tính' => 'Bo tròn góc cạnh, chống trầy xước tay bé',
                ]
            ],
            [
                'name' => 'Children Domino Alphabet and Math Numbers Set',
                'slug' => 'children-domino-alphabet-and-math-numbers-set',
                'cat_slug' => 'children-plastic-educational-toys',
                'image' => '/thumbs/300x300x1/upload/product/bodominochucai-va-so-07-2819-6452.jpg',
                'product_code' => 'MIBI-DOM-07',
                'material' => 'ABS / HIPS nguyên sinh',
                'origin' => 'Việt Nam',
                'summary' => 'Bộ cờ domino chữ cái và con số học tập vừa chơi vừa học cho trẻ mầm non.',
                'is_featured' => true,
                'specs' => [
                    'Số lượng quân cờ' => '54 quân cờ',
                    'Màu sắc' => 'In UV sắc nét bền màu',
                ]
            ],
            [
                'name' => 'Pet Feeding Water Automatic Dispenser Green',
                'slug' => 'pet-feeding-water-automatic-dispenser-green',
                'cat_slug' => 'plastic-toys-for-pets',
                'image' => '/thumbs/300x300x1/upload/product/may-uong-nuoc-tu-dong-xanh-la-1-2698.png',
                'product_code' => 'NBP-PET-WATER',
                'material' => 'PP kháng khuẩn',
                'origin' => 'Việt Nam',
                'summary' => 'Bình cấp nước uống tự động cho thú cưng chó mèo màu xanh lá.',
                'is_featured' => true,
                'specs' => [
                    'Dung tích' => '1.5 Lít',
                    'Cơ chế' => 'Trọng lực tự động cấp bù nước',
                ]
            ],
        ];

        foreach ($productsData as $pData) {
            $catId = $catMap[$pData['cat_slug']] ?? null;
            if (!$catId) {
                // Fallback to first category
                $catId = Category::first()->id;
            }

            Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id'    => $catId,
                    'name'           => $pData['name'],
                    'product_code'   => $pData['product_code'],
                    'material'       => $pData['material'],
                    'origin'         => $pData['origin'],
                    'summary'        => $pData['summary'],
                    'description'    => '<p><strong>' . $pData['name'] . '</strong> là sản phẩm được thiết kế và sản xuất chính xác tại <strong>Công ty TNHH Nhựa Nhị Bình</strong>.</p><p>Sản phẩm đạt tiêu chuẩn quản lý chất lượng <strong>ISO 9001:2015</strong>, chứng nhận an toàn trách nhiệm xã hội <strong>BSCI</strong> và chứng chỉ <strong>RoHS / REACH</strong> xuất khẩu sang thị trường Mỹ, Nhật Bản và Châu Âu.</p>',
                    'image'          => $pData['image'],
                    'specifications' => $pData['specs'],
                    'is_featured'    => $pData['is_featured'] ?? true,
                    'is_active'      => true,
                ]
            );
        }
    }
}
