<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use Illuminate\Database\Seeder;

class MediaAndPagesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Albums (Nhà xưởng & sự kiện)
        $albums = [
            [
                'title' => 'Outside the plastic product manufacturing factory at VSIP 2A, Binh Duong',
                'slug' => 'outside-the-plastic-product-manufacturing-factory-at-vsip-2a-binh-duong',
                'image' => '/thumbs/400x300x1/upload/news/nhua-nhi-binh-nha-may-ep-nhua-vsip-2a-binh-duong-4998.jpg',
                'summary' => 'Toàn cảnh khuôn viên nhà máy sản xuất ép nhựa Nhị Bình tại KCN VSIP 2A Bình Dương quy mô 10,000m².',
                'type' => 'album',
            ],
            [
                'title' => 'Injection molding area with modern, automated injection machines equipped with robotic arms',
                'slug' => 'injection-molding-area-with-modern-automated-injection-machines-equipped-with-robotic-arms',
                'image' => '/thumbs/400x300x1/upload/news/3-4418-3847.jpeg',
                'summary' => 'Khu vực phòng máy ép phun nhựa tự động hóa cao trang bị cánh tay robot gắp sản phẩm chính xác.',
                'type' => 'album',
            ],
            [
                'title' => 'Warehouse for plastic raw materials, plastic products, and packaging',
                'slug' => 'warehouse-for-plastic-raw-materials-plastic-products-and-packaging',
                'image' => '/thumbs/400x300x1/upload/news/nhi-binh-plastic-warehouse-5517.jpg',
                'summary' => 'Hệ thống kho lưu trữ nguyên vật liệu hạt nhựa nguyên sinh, thành phẩm và vật liệu đóng gói tiêu chuẩn cao.',
                'type' => 'album',
            ],
            [
                'title' => 'Plastic product assembly and packaging room',
                'slug' => 'plastic-product-assembly-and-packaging-room',
                'image' => '/thumbs/400x300x1/upload/news/manufacture-plastic-product-packing-room-1033.jpeg',
                'summary' => 'Phòng lắp ráp hoàn thiện và đóng gói sản phẩm sạch sẽ, tuân thủ tiêu chuẩn phòng sạch kiểm soát chất lượng.',
                'type' => 'album',
            ],
            [
                'title' => 'Inauguration Ceremony of the Plastic Factory in Binh Duong Province - Phase I',
                'slug' => 'album-2',
                'image' => '/thumbs/400x300x1/upload/news/nhibinh2406028-6552-2098.jpg',
                'summary' => 'Lễ khánh thành nhà máy Nhựa Nhị Bình chi nhánh Bình Dương Giai đoạn 1 với tổng vốn đầu tư 45 tỷ đồng.',
                'type' => 'album',
            ],
        ];

        foreach ($albums as $alb) {
            Post::updateOrCreate(
                ['slug' => $alb['slug']],
                array_merge($alb, ['is_published' => true])
            );
        }

        // 2. Seed News (Tin tức hoạt động công ty)
        $news = [
            [
                'title' => 'Organizing the 15th anniversary of the establishment of Nhi Binh Plastic Company',
                'slug' => 'organizing-the-15th-anniversary-of-the-establishment-of-nhi-binh-plastic-company',
                'image' => '/thumbs/300x200x1/upload/news/nhua-nhi-binh-15-nam-1-7957.jpg',
                'summary' => 'Organizing tourism, team building, gala dinner to celebrate the 15th anniversary of the establishment of Nhi Binh Plastic Company 2009-2024.',
                'content' => '<p>Công ty TNHH SX TM Nhựa Nhị Bình tưng bừng tổ chức kỷ niệm 15 năm thành lập (2009 - 2024) với chuỗi sự kiện du lịch, team building và đêm tiệc Gala Dinner ấm cúng tri ân toàn thể cán bộ công nhân viên và quý đối tác.</p>',
                'type' => 'news',
            ],
            [
                'title' => 'Organizing a vacation for staff and employees in 2018',
                'slug' => 'organizing-a-vacation-for-staff-and-employees-in-2018',
                'image' => '/thumbs/300x200x1/upload/news/cb14798d8cc874962dd9-4881-2312.jpg',
                'summary' => 'Chương trình nghỉ mát thường niên gắn kết tinh thần đoàn kết nội bộ công ty Nhựa Nhị Bình.',
                'content' => '<p>Chương trình du lịch nghỉ dưỡng thường niên mang lại những giây phút thư giãn, tái tạo năng lượng cho đội ngũ cán bộ công nhân viên sau thời gian cống hiến hết mình.</p>',
                'type' => 'news',
            ],
            [
                'title' => 'Groundbreaking Ceremony for the Construction of Binh Duong Factory Phase 2',
                'slug' => 'groundbreaking-ceremony-for-the-construction-of-binh-duong-factory-phase-2',
                'image' => '/thumbs/300x200x1/upload/news/dsc1177-7553-6242.jpg',
                'summary' => 'Khởi công xây dựng nhà máy Nhựa Nhị Bình Giai đoạn 2 tại KCN VSIP 2A nhằm nâng công suất sản xuất lên hơn 400 tấn/tháng.',
                'content' => '<p>Lễ khởi công xây dựng Giai đoạn 2 của nhà máy Nhựa Nhị Bình tại KCN VSIP II-A Bình Dương đánh dấu bước phát triển vượt bậc nhằm phục vụ nhu cầu xuất khẩu sang các thị trường quốc tế như Mỹ, Nhật Bản, Châu Âu.</p>',
                'type' => 'news',
            ],
        ];

        foreach ($news as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['is_published' => true])
            );
        }

        // 3. Seed Videos (Video YouTube)
        $videos = [
            [
                'title' => 'About Nhi Binh Plastic Company',
                'slug' => 'about-nhi-binh-plastic-company',
                'video_url' => 'https://youtu.be/3r_do9QYJkU?si=zyDU3wRDA-D9Gltw',
                'image' => '/thumbs/400x250x1/upload/news/nhua-nhi-binh-nha-may-ep-nhua-vsip-2a-binh-duong-2640.jpg',
                'summary' => 'Video phóng sự giới thiệu toàn diện về năng lực sản xuất và quy mô Công ty TNHH Nhựa Nhị Bình.',
                'type' => 'video',
            ],
            [
                'title' => 'Nhi Binh Plastic Company - Factory improvement program.',
                'slug' => 'nhi-binh-plastic-factory-improvement-program',
                'video_url' => 'https://www.youtube.com/watch?v=CVmL6suEY2A&t=1s',
                'image' => '/thumbs/400x250x1/upload/news/5451232747994690-2719.jpg',
                'summary' => 'Chương trình cải tiến liên tục (Kaizen / 5S) tại xưởng sản xuất ép phun nhựa.',
                'type' => 'video',
            ],
            [
                'title' => 'Inauguration ceremony of phase 1 - Nhi Binh Plastic factory at VSIP 2A Industrial Park - Binh Duong',
                'slug' => 'inauguration-ceremony-phase-1-nhi-binh-factory',
                'video_url' => 'https://www.youtube.com/watch?v=XM6xWJm19_Y',
                'image' => '/thumbs/400x250x1/upload/news/dsc1177-7553-5199.jpg',
                'summary' => 'Video toàn cảnh lễ khánh thành nhà máy Nhựa Nhị Bình chi nhánh KCN VSIP 2A Bình Dương.',
                'type' => 'video',
            ],
            [
                'title' => 'Why should you choose Nhi Binh Plastic as a strategic supplier?',
                'slug' => 'why-choose-nhi-binh-plastic-supplier',
                'video_url' => 'https://www.youtube.com/watch?v=a9R5yG021EU',
                'image' => '/thumbs/400x250x1/upload/news/z5448116717809391c65151dcb657d1bae230a111edb71-1484-4275.jpg',
                'summary' => 'Lý do khách hàng quốc tế tin chọn Nhựa Nhị Bình làm nhà cung cấp chiến lược.',
                'type' => 'video',
            ],
        ];

        foreach ($videos as $vid) {
            Post::updateOrCreate(
                ['slug' => $vid['slug']],
                array_merge($vid, ['is_published' => true])
            );
        }

        // 4. Seed Partners (Active Markets - Thị trường xuất khẩu)
        $markets = [
            ['name' => 'Vietnam Market', 'image' => '/thumbs/200x100x1/upload/photo/nhuanhibinhvietnammarket-1545.png', 'sort_order' => 1],
            ['name' => 'USA Market', 'image' => '/thumbs/200x100x1/upload/photo/nhibinhplasticusamarket-1609.png', 'sort_order' => 2],
            ['name' => 'Japan Market', 'image' => '/thumbs/200x100x1/upload/photo/nhuanhibinhjapanmarket-4762.png', 'sort_order' => 3],
            ['name' => 'China Market', 'image' => '/thumbs/200x100x1/upload/photo/nhibinhplasticchinamarket-3025.png', 'sort_order' => 4],
            ['name' => 'Netherland Market', 'image' => '/thumbs/200x100x1/upload/photo/nhibinhplasticnetherlandmarket-3885.png', 'sort_order' => 5],
            ['name' => 'Spain Market', 'image' => '/thumbs/200x100x1/upload/photo/nhibinhplasticspainmarket-1820.png', 'sort_order' => 6],
            ['name' => 'Canada Market', 'image' => '/thumbs/200x100x1/upload/photo/nhuanhibinhcanadamarket-3384.png', 'sort_order' => 7],
            ['name' => 'England Market', 'image' => '/thumbs/200x100x1/upload/photo/nhibinhplasticenglandmarket-6239.png', 'sort_order' => 8],
        ];

        foreach ($markets as $mkt) {
            Partner::updateOrCreate(
                ['name' => $mkt['name']],
                [
                    'image' => $mkt['image'],
                    'type' => 'market',
                    'sort_order' => $mkt['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 5. Seed Core CMS Pages
        $pages = [
            [
                'slug' => 'about-us',
                'title' => 'About Us - Công Ty TNHH SX TM Nhựa Nhị Bình',
                'banner_image' => '/thumbs/1366x300x1/upload/photo/nhibinhfactoryvsip2afront-71880.jpg',
                'content' => '<p>Được thành lập vào năm 2009, <strong>Công ty TNHH SX TM Nhựa Nhị Bình</strong> chuyên sản xuất các sản phẩm nhựa kỹ thuật cao theo yêu cầu của khách hàng bằng công nghệ ép phun và ép đùn hiện đại.</p><p>Nhà máy tại KCN VSIP II-A Bình Dương rộng 10,000m² với hơn 50 máy ép nhựa đời mới, đội ngũ hơn 180 cán bộ nhân viên lành nghề, công suất đạt trên 200 tấn/tháng.</p>',
                'meta' => [
                    'title' => 'Giới Thiệu Về Nhựa Nhị Bình | Plastic Injection Molding Vietnam',
                    'description' => 'Nhà máy sản xuất đồ nhựa kỹ thuật cao, gia công khuôn ép nhựa uy tín xuất khẩu sang Mỹ, Nhật Bản, Châu Âu.',
                ]
            ],
            [
                'slug' => 'factory',
                'title' => 'Factory Facilities & Production Capacity',
                'banner_image' => '/thumbs/1366x300x1/upload/photo/nhibinhfactoryvsip2aside-48750.jpg',
                'content' => '<p>Khuôn viên nhà máy chi nhánh Bình Dương tại KCN VSIP II-A được đầu tư bài bản, trang bị hệ thống máy ép phun nhựa tự động từ 50 tấn đến 850 tấn của Nhật Bản và Đài Loan.</p>',
                'meta' => [
                    'title' => 'Năng Lực Nhà Máy & Máy Móc | Nhựa Nhị Bình',
                    'description' => 'Khám phá cơ sở vật chất, hệ thống máy ép phun và quy trình kiểm soát chất lượng tại Nhựa Nhị Bình.',
                ]
            ],
            [
                'slug' => 'service',
                'title' => 'Our Services - Dịch Vụ Gia Công Ép Nhựa & Khuôn Ép',
                'banner_image' => '/thumbs/1366x300x1/upload/photo/nhibinhfactoryvsip2ainjectionroom-4412.jpg',
                'content' => '<p>Chúng tôi cung cấp giải pháp toàn diện từ khâu thiết kế sản phẩm 3D, gia công chế tạo khuôn mẫu chính xác đến ép phun hàng loạt và đóng gói xuất khẩu theo tiêu chuẩn quốc tế.</p>',
                'meta' => [
                    'title' => 'Dịch Vụ Ép Nhựa & Làm Khuôn Ép Nhựa | Nhựa Nhị Bình',
                    'description' => 'Dịch vụ thiết kế và gia công ép phun nhựa chính xác theo yêu cầu OEM / ODM.',
                ]
            ],
            [
                'slug' => 'contact-us',
                'title' => 'Contact Us - Liên Hệ Nhựa Nhị Bình',
                'banner_image' => '/thumbs/1366x300x1/upload/photo/nhibinhfactoryvsip2afront-71880.jpg',
                'content' => '<p>Quý khách hàng có nhu cầu hợp tác gia công hoặc nhận báo giá sản phẩm nhựa, vui lòng liên hệ trực tiếp với chúng tôi qua số Hotline hoặc gửi thông tin qua form liên hệ.</p>',
                'meta' => [
                    'title' => 'Liên Hệ Nhà Máy Nhựa Nhị Bình',
                    'description' => 'Thông tin địa chỉ văn phòng, nhà xưởng và số điện thoại liên hệ Công ty TNHH Nhựa Nhị Bình.',
                ]
            ]
        ];

        foreach ($pages as $pg) {
            Page::updateOrCreate(
                ['slug' => $pg['slug']],
                $pg
            );
        }
    }
}
