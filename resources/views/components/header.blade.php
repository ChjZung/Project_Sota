<div class="header-top">
    <div class="fixwidth d-flex justify-content-between align-self-center flex-wrap">
        <div class="d-flex align-items-center">
            <div class="menu_mobi align-self-center">
                <p class="icon_menu_mobi"><i class="fas fa-bars"></i></p>
                <a href="{{ route('home') }}" class="home_mobi">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
            </div>
            <div class="header_left_mobile align-self-center ml-3">
                <a class="header_logo" href="{{ route('home') }}"><img
                        onerror="this.src='/thumbs/0x1100x1/assets/images/noimage.png';"
                        src="{{ setting('logo', '/upload/photo/nhi-binh-plastic-logo-3632.png') }}" /></a>
            </div>
        </div>
        <div class="menu_mobi_add"></div>

        <div class="diachi-top">{{ setting('address_hq', '33 Nhi Binh 2 Street, Nhi Binh Ward, Hoc Mon District, Ho Chi Minh City, Vietnam 700000') }}</div>
        <div class="menu_baophu"></div>
        <div class="d-flex align-items-center">
            <div class="ngonngu d-flex align-items-center">
                <a href="ngon-ngu?lang=vi" class="ngonngu-vi mr-2"><img src="/thumbs/40x25x1/assets/images/vi.jpg" alt="VI"></a>
                <a href="ngon-ngu?lang=en" class="ngonngu-en"><img src="/thumbs/40x25x1/assets/images/en.jpg" alt="EN"></a>
            </div>
            <div class="menu_mobi menu_mobi1 align-self-center">
                <p class="icon_menu_mobi1 open_search"><i class="fas fa-search"></i></p>
                <p class="icon_menu_mobi1 close_search"><i class="fas fa-times"></i></p>
            </div>
        </div>
        <div class="frm_timkiem frmtim1">
            <input type="text" class="input" id="keyword2345" placeholder="Search ..."
                onkeypress="doEnter(event,'keyword2345');">
            <button type="submit" class="nut_tim" id="nut__tim" onclick="onSearch('keyword2345');"><i
                    class="far fa-search"></i></button>
        </div>
    </div>
</div>
<div class="header">
    <div class="fixwidth d-flex justify-content-between flex-wrap align-items-center">
        <div class="header_left align-self-center">
            <a class="header_logo" href="{{ route('home') }}"><img
                    onerror="this.src='/thumbs/0x100x1/assets/images/noimage.png';"
                    src="{{ setting('logo', '/upload/photo/nhi-binh-plastic-logo-3632.png') }}" /></a>
        </div>
        <div class="header_content">
            <h3 class="header_name">{{ setting('company_name_en', 'NHI BINH PLASTIC') }}</h3>
            <div class="header_slogan">{{ setting('slogan', 'Trusted Partner in Plastic Innovation') }}</div>
        </div>
        <div class="header_right">
            <div class="d-flex flex-column justify-content-center">
                <a href="mailto:{{ setting('email_sale_2', 'nhibinhsale01@gmail.com') }}" class="phone">
                    <i class="far fa-envelope"></i>
                    <span>Email: {{ setting('email_sale_2', 'nhibinhsale01@gmail.com') }}</span>
                </a>
                <a href="mailto:{{ setting('email_sale_1', 'sales@nibiplastic.com') }}" class="phone">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>Email: {{ setting('email_sale_1', 'sales@nibiplastic.com') }}</span>
                </a>
            </div>
        </div>
        <div class="header_right">
            <div class="d-flex flex-column justify-content-center">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', setting('hotline', '84853543353')) }}" class="phone">
                    <i class="fas fa-phone-alt"></i>
                    <span>Hotline: {{ setting('hotline', '+84-853543353') }}</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9]/', '', setting('phone', '842837123748')) }}" class="phone">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Phone: {{ setting('phone', '+84-28 3712 3748') }}</span>
                </a>
            </div>
            <div class="ngonngu d-flex flex-column">
                <a href="ngon-ngu?lang=vi" class="ngonngu-vi mb-1"><img src="/thumbs/40x25x1/assets/images/vi.jpg" alt="VI"></a>
                <a href="ngon-ngu?lang=en" class="ngonngu-en"><img src="/thumbs/40x25x1/assets/images/en.jpg" alt="EN"></a>
            </div>
        </div>
    </div>
</div>