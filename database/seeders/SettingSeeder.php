<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Thông tin chung (general)
            ['key' => 'company_name_vi', 'value' => 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH', 'group' => 'general'],
            ['key' => 'company_name_en', 'value' => 'NHI BINH PLASTIC CO., LTD', 'group' => 'general'],
            ['key' => 'tax_code', 'value' => '0308365215', 'group' => 'general'],
            ['key' => 'logo', 'value' => '/upload/photo/nhi-binh-plastic-logo-3632.png', 'group' => 'general'],
            ['key' => 'favicon', 'value' => '/assets/images/favicon.ico', 'group' => 'general'],
            ['key' => 'slogan', 'value' => 'Nhà sản xuất ép phun nhựa kỹ thuật cao theo yêu cầu - Xuất khẩu Mỹ, Nhật Bản, EU', 'group' => 'general'],

            // Thông tin liên hệ (contact)
            ['key' => 'hotline', 'value' => '+84 853 543 353 / 0917 543 353', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '028 3712 3748', 'group' => 'contact'],
            ['key' => 'fax', 'value' => '028 3712 3749', 'group' => 'contact'],
            ['key' => 'email_sale_1', 'value' => 'sales@nibiplastic.com', 'group' => 'contact'],
            ['key' => 'email_sale_2', 'value' => 'nhibinhsale01@gmail.com', 'group' => 'contact'],
            ['key' => 'address_hq', 'value' => '33 Đường Nhị Bình 2, Xã Nhị Bình (Đông Thạnh), Huyện Hóc Môn, TP. Hồ Chí Minh, Việt Nam (700000)', 'group' => 'contact'],
            ['key' => 'address_factory', 'value' => 'Lô 5, KCN VSIP II-A, Đường số 25, P. Vĩnh Tân, TP. Tân Uyên, Tỉnh Bình Dương, Việt Nam', 'group' => 'contact'],
            ['key' => 'google_maps', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.9547019864276!2d106.6789!3d10.8912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDUzJzI4LjMiTiAxMDbCsDQwJzQ0LjAiRQ!5e0!3m2!1svi!2s!4v1', 'group' => 'contact'],

            // Mạng xã hội & liên kết (social)
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/nibiplastic', 'group' => 'social'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com/@nhibinhplastic2668', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://www.linkedin.com/company/nhi-binh-plastic/mycompany/?viewAsMember=true', 'group' => 'social'],
            ['key' => 'zalo', 'value' => '0917543353', 'group' => 'social'],
            ['key' => 'alibaba', 'value' => 'https://nibiplastic.trustpass.alibaba.com', 'group' => 'social'],

            // Số liệu năng lực sản xuất (stats)
            ['key' => 'stats_factory_area', 'value' => '10,000', 'group' => 'stats'],
            ['key' => 'stats_machines', 'value' => '50', 'group' => 'stats'],
            ['key' => 'stats_employees', 'value' => '180', 'group' => 'stats'],
            ['key' => 'stats_capacity', 'value' => '200', 'group' => 'stats'],

            // Cấu hình SEO mặc định (seo)
            ['key' => 'meta_title', 'value' => 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH | Custom Plastic Injection Molding Manufacturer in Vietnam', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Sản xuất các sản phẩm nhựa kỹ thuật cao theo yêu cầu của khách hàng, với nhà xưởng và máy móc hiện đại. Products are exported to the US, Japan, EU.', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'sản xuất đồ nhựa, ép nhựa, gia công khuôn nhựa, Nhựa Nhị Bình, plastic injection molding', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
