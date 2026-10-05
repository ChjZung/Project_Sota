<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Trần Văn An',
                'email' => 'an.tran@tanphat-mech.vn',
                'phone' => '0912 345 678',
                'company' => 'Công ty CP Cơ Khí Tân Phát',
                'message' => 'Xin chào Quý công ty, chúng tôi cần báo giá gia công ép nhựa kỹ thuật số lượng 20,000 vỏ hộp thiết bị điện tử chất liệu nhựa ABS nguyên sinh chống cháy UL94-V0 theo bản vẽ 3D.',
                'admin_notes' => null,
                'status' => 'pending',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'name' => 'Nguyễn Thị Mai',
                'email' => 'mai.nguyen@adongpack.com',
                'phone' => '0988 765 432',
                'company' => 'Công ty TNHH Bao Bì Á Đông',
                'message' => 'Cần tìm đối tác sản xuất nắp chai lọ nhựa dược phẩm số lượng định kỳ 50,000 cái/tháng, chất liệu HDPE nguyên sinh đạt chuẩn an toàn thực phẩm & y tế.',
                'admin_notes' => null,
                'status' => 'pending',
                'created_at' => now()->subHours(8),
                'updated_at' => now()->subHours(8),
            ],
            [
                'name' => 'David Miller',
                'email' => 'david.miller@globalsourcing.us',
                'phone' => '+1 (555) 234-5678',
                'company' => 'Global Precision Sourcing LLC',
                'message' => 'We are looking for an OEM injection molding partner in Vietnam for export to North America. We require BSCI audit and ISO 9001:2015 certification. Could you please send your factory audit profile and standard lead time?',
                'admin_notes' => 'Đã gửi email hồ sơ năng lực nhà máy và chứng chỉ ISO 9001, BSCI lúc 10:00.',
                'status' => 'processing',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(5),
            ],
            [
                'name' => 'Lê Hoàng Quân',
                'email' => 'quan.lh@hoangquanmold.com',
                'phone' => '0903 112 233',
                'company' => 'Công ty Cổ phần Thiết Bị Gia Dụng Hoàng Quân',
                'message' => 'Tư vấn chế tạo khuôn ép nhựa chính xác cho sản phẩm gia dụng cao cấp, dự kiến đặt hàng 5 bộ khuôn và sản xuất đơn hàng đầu tiên trong Quý 4.',
                'admin_notes' => 'Bộ phận kỹ thuật khuôn mẫu đã liên hệ trao đổi file CAD và hẹn lịch làm việc tại văn phòng công ty.',
                'status' => 'processing',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
            [
                'name' => 'Vũ Đình Trọng',
                'email' => 'trong.vu@thinhphatplastic.vn',
                'phone' => '0938 998 877',
                'company' => 'Nhựa Thịnh Phát',
                'message' => 'Yêu cầu kiểm tra tiến độ giao hàng cho đơn hàng linh kiện phụ tùng nhựa xe máy theo hợp đồng khung số NB-2026/08.',
                'admin_notes' => 'Đã phối hợp kho xuất hàng hoàn tất giao 10,000 sản phẩm đợt 1 vào ngày hôm qua.',
                'status' => 'closed',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::updateOrCreate(
                ['email' => $inquiry['email']],
                $inquiry
            );
        }
    }
}
