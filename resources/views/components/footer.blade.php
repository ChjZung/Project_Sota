<div class="boxfooter_container" id="background-footer">
    <div class="fixwidth">
        <div class="row">
            {{-- Cột 1: Thông tin liên hệ --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="tit_ft">Information Contact</div>
                <div class="des_footer">
                    <p>
                        <strong><img alt="Email" src="/upload/elfinder/Email.png" style="width: 22px; height: 22px; vertical-align: middle; margin-right: 6px;" /> Sale:</strong> 
                        <a href="mailto:{{ setting('email_sale_1', 'sales@nibiplastic.com') }}?subject=Contact%20from%20website%20Nhi%20Binh%20Plastic">{{ setting('email_sale_1', 'sales@nibiplastic.com') }}</a>
                    </p>
                    <p>
                        <strong><img alt="Email" src="/upload/elfinder/Email.png" style="width: 22px; height: 22px; vertical-align: middle; margin-right: 6px;" /> Sale:</strong> 
                        <a href="mailto:{{ setting('email_sale_2', 'nhibinhsale01@gmail.com') }}?subject=Contact%20from%20website%20Nhi%20Binh%20Plastic">{{ setting('email_sale_2', 'nhibinhsale01@gmail.com') }}</a>
                    </p>
                    <p>
                        <strong><img alt="Tel" src="/upload/elfinder/Dien%20thoai.png" style="width: 22px; height: 22px; vertical-align: middle; margin-right: 6px;" /> Tel:</strong> 
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', setting('phone', '02837123748')) }}">{{ setting('phone', '028 3712 3748') }}</a> - <strong>Fax:</strong> {{ setting('fax', '028 3712 3749') }}
                    </p>
                    <p>
                        <strong><img alt="Hotline" src="/upload/elfinder/Dien%20thoai%20di%20dong.png" style="width: 22px; height: 22px; vertical-align: middle; margin-right: 6px;" /> Hotline | Zalo | WhatsApp:</strong>
                    </p>
                    <p style="margin-left: 28px; font-weight: 600;">
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', setting('hotline', '0917543353')) }}" style="color: #ffc107;">{{ setting('hotline', '+84 853 543 353 / 0917 543 353') }}</a>
                    </p>
                    <p>
                        <strong><img alt="Web" src="/upload/elfinder/Qua%20dia%20cau.png" style="width: 22px; height: 22px; vertical-align: middle; margin-right: 6px;" /> Website:</strong> 
                        <a href="{{ url('/') }}" target="_blank">{{ url('/') }}</a>
                    </p>
                </div>
            </div>

            {{-- Cột 2: Thông tin công ty & Nhà máy --}}
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="tit_ft">{{ setting('company_name_en', 'NHI BINH PLASTIC CO., LTD') }}</div>
                <div class="des_footer">
                    <p style="margin-bottom: 6px;">
                        <strong style="color: #ec2d3f; font-size: 15px;">{{ setting('company_name_vi', 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH') }}</strong>
                    </p>
                    <p style="margin-bottom: 6px;">
                        <strong>Mã số thuế (Tax Code):</strong> {{ setting('tax_code', '0308365215') }} do Sở KH&ĐT TP.HCM cấp
                    </p>
                    <p>
                        <strong><img alt="Factory 1" src="/upload/elfinder/Vi%20tri.png" style="height: 22px; width: 22px; vertical-align: middle; margin-right: 6px;" /> Trụ sở chính & Nhà máy 1:</strong><br>
                        {{ setting('address_hq', '33 Đường Nhị Bình 2, Xã Nhị Bình (Đông Thạnh), Huyện Hóc Môn, TP. Hồ Chí Minh, Việt Nam (700000).') }}
                    </p>
                    <p>
                        <strong><img alt="Factory 2" src="/upload/elfinder/Vi%20tri.png" style="height: 22px; width: 22px; vertical-align: middle; margin-right: 6px;" /> Chi nhánh & Nhà máy 2 (VSIP II-A):</strong><br>
                        {{ setting('address_factory', 'Lô 5, KCN VSIP II-A, Đường số 25, P. Vĩnh Tân, TP. Tân Uyên, Tỉnh Bình Dương, Việt Nam.') }}
                    </p>
                </div>
            </div>

            {{-- Cột 3: Chính sách --}}
            <div class="col-md-2 col-sm-6 mb-4">
                <div class="tit_ft">Policy</div>
                <div class="box_cs mb-3">
                    <p><a href="working-process"><i class="fas fa-angle-right mr-1"></i> Working process</a></p>
                    <p><a href="warranty-return"><i class="fas fa-angle-right mr-1"></i> Warranty - return</a></p>
                    <p><a href="payments"><i class="fas fa-angle-right mr-1"></i> Payment policy</a></p>
                    <p><a href="shipping-delivery"><i class="fas fa-angle-right mr-1"></i> Shipping - delivery</a></p>
                    <p><a href="privacy-policy"><i class="fas fa-angle-right mr-1"></i> Privacy Policy</a></p>
                </div>
            </div>

            {{-- Cột 4: Mạng xã hội & Chứng nhận --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="tit_ft">SOCIAL NETWORK</div>
                <div class="d-flex align-items-center flex-wrap mt-3 mb-3">
                    @if(setting('alibaba'))
                        <a href="{{ setting('alibaba') }}" class="ftmxh mr-2 mb-2" target="_blank" title="Nhi Binh Plastic Shop on Alibaba">
                            <img onerror="this.src='/assets/images/noimage.png';" src="/thumbs/0x30x2/upload/photo/alibaba-icon-70490.png" alt="Alibaba" style="height: 32px;" />
                        </a>
                    @endif
                    @if(setting('facebook'))
                        <a href="{{ setting('facebook') }}" class="ftmxh mr-2 mb-2" target="_blank" title="Nhi Binh Plastic Fanpage">
                            <img onerror="this.src='/assets/images/noimage.png';" src="/thumbs/0x30x2/upload/photo/facebook-f-6466.png" alt="Facebook" style="height: 32px;" />
                        </a>
                    @endif
                    @if(setting('youtube'))
                        <a href="{{ setting('youtube') }}" class="ftmxh mr-2 mb-2" target="_blank" title="Nhi Binh Plastic Youtube">
                            <img onerror="this.src='/assets/images/noimage.png';" src="/thumbs/0x30x2/upload/photo/youtube-24010.png" alt="Youtube" style="height: 32px;" />
                        </a>
                    @endif
                    @if(setting('linkedin'))
                        <a href="{{ setting('linkedin') }}" class="ftmxh mr-2 mb-2" target="_blank" title="Linkedin Nhi Binh Plastic">
                            <img onerror="this.src='/assets/images/noimage.png';" src="/thumbs/0x30x2/upload/photo/linkedinlogoinitials-5736.png" alt="Linkedin" style="height: 32px;" />
                        </a>
                    @endif
                </div>

                <div class="mt-2">
                    <a href="http://online.gov.vn/" target="_blank" title="Đã thông báo Bộ Công Thương">
                        <img onerror="this.src='/assets/images/noimage.png';" src="/assets/images/logo-da-thong-bao-bo-cong-thuong-mau-xanh.png" alt="Đã thông báo Bộ Công Thương" style="max-height: 55px;" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="boxfooter_bottom">
    <div class="fixwidth d-flex justify-content-between flex-wrap align-items-center">
        <div>© 2009 - {{ date('Y') }} {{ setting('company_name_vi', 'CÔNG TY TNHH NHỰA NHỊ BÌNH') }} ({{ setting('company_name_en', 'NHI BINH PLASTIC') }}). All rights reserved. Design by sotagroup.vn</div>
        <div>Online: 12 | Hôm nay: 580 | Tổng lượt truy cập: 471,662</div>
    </div>
</div>
