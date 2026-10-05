@extends('layouts.app')

@section('content')
<div class="wrap_slider">

    <div >

        <!-- <div class="catagory-list">

                            <ul>

                                            <li><a title="CUSTOM PLASTIC PRODUCTS" href="custom-plastic-products"><img src="/assets/images/img-data/list.png"> CUSTOM PLASTIC PRODUCTS</a>

                                                    </li>

                                            <li><a title="NHI BINH PLASTIC PRODUCTS" href="nhi-binh-plastic-products"><img src="/assets/images/img-data/list.png"> NHI BINH PLASTIC PRODUCTS</a>

                                                    </li>

                                            <li><a title="Children Plastic Toys -Mibitoi" href="children-plastic-toys-mibitoi"><img src="/assets/images/img-data/list.png"> Children Plastic Toys -Mibitoi</a>

                                                    </li>

                                    </ul>

                        <div class="frm_timkiem">

                <input type="text" class="input" id="keyword1" placeholder="Tìm kiếm" onkeypress="doEnter(event,'keyword1');" >

                <button type="submit" value="" class="nut_tim" onclick="onSearch('keyword1');"><i class="far fa-search"></i></button>

            </div>

        </div> -->

        <div class="slideshow">

            <p class="control-slideshow prev-slideshow transition"><i class="fas fa-chevron-left"></i></p>

            <div id="slider" class="owl-carousel owl-theme owl-slideshow">
                @forelse($banners as $banner)
                    <div class="item_slider">
                        <a href="{{ $banner->link ?: 'javascript:void(0)' }}" target="{{ $banner->link ? '_blank' : '_self' }}" title="{{ $banner->title }}">
                            <img onerror="this.src='/thumbs/910x380x2/assets/images/noimage.png';" 
                                 src="{{ $banner->image }}" 
                                 alt="{{ $banner->title }}" 
                                 title="{{ $banner->title }}"/>
                        </a>
                    </div>
                @empty
                    <div class="item_slider">
                        <a href="javascript:void(0)" title="Nhi Binh Factory">
                            <img src="/thumbs/1366x580x1/upload/photo/nhibinhfactoryvsip2afront-71880.jpg" alt="Nhi Binh Factory"/>
                        </a>
                    </div>
                @endforelse
            </div>

            <p class="control-slideshow next-slideshow transition"><i class="fas fa-chevron-right"></i></p>

        </div>

    </div>

    </div>



        <div class="wrap-home w-clear"><div class="wrap_bottom">
    <div class="fixwidth">
        <div class="row">
            <div class="col-md-6">
                <div class="title_gt" data-aos="fade-right">
                    About us                </div>
                <div class="gt_noidung" data-aos="fade-right">
                    <p style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;">Established in 2009<strong>,</strong> </span><span style="color:#e74c3c;"><strong>Nhi Binh Plastic Company Limited</strong> </span><span style="color:#666666;">specializes in manufacturing plastic products using injection molding and extrusion technologies. Beginning with a modest 100m² facility and only 2 injection molding machines, Nhi Binh Plastic has continuously expanded its production scale from 2010 to 2015, reaching 1,500m² in Hoc Mon District, Ho Chi Minh City, along with adding 14 more modern injection molding machines to its production line.</span></span></span></p>



<p data-sourcepos="5:1-5:205" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   In June 2016,</strong> Nhi Binh Plastic inaugurated its Binh Duong Branch Factory in VSIP II-A Industrial Park with an investment of VND 45 billion. This factory is <strong>{{ setting('stats_factory_area', '10,000') }}m²</strong>. </span></span></span></p>



<p data-sourcepos="7:1-7:483" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   With a long-term vision,</strong> we have continuously expanded our operations, investing heavily in a clean production plant, modern machinery and equipment, applying automation in production, digitalizing management, and training our employees. To date, we have over <strong>{{ setting('stats_machines', '50') }} injection molding machines</strong>, over <strong>{{ setting('stats_employees', '180') }} officers and workers</strong>, with a production capacity of over <strong>{{ setting('stats_capacity', '200') }} tons/month</strong>. All of this is aimed at better meeting the needs of our customers and helping them grow stronger together.</span></span></span></p>

                </div>
                <a href="gioi-thieu" class="xemgt mb-3" data-aos="fade-right">
                    See details                </a>
            </div>
            <div class="col-md-6">
                <div class="gt_img" data-aos="fade-left">
                    <img 
                        src="/thumbs/600x400x1/upload/news/1215300900982990-6129.jpg"
                        alt="" />
                </div>
            </div>
        </div>
        <div class="owl-carousel owl-theme owl-bvgt" data-aos="fade-up">
                            <div class="bvgt_item">
                    <a href="overview-of-nhi-binh-plastics" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/hinh-xuong-2-1205-8143.jpg"
                            alt="OVERVIEW OF NHI BINH PLASTIC" />
                    </a>
                    <a href="overview-of-nhi-binh-plastics" class="bvgt_ten">
                        OVERVIEW OF NHI BINH PLASTIC                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="why-choose-us" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/why-choose-nhi-binh-plastic-8088.jpg"
                            alt="WHY CHOOSE US?" />
                    </a>
                    <a href="why-choose-us" class="bvgt_ten">
                        WHY CHOOSE US?                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="history-of-formation-and-development" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/caynon-4057-7458.jpg"
                            alt="The History of the Establishment and Development of Nhi Binh Plastic" />
                    </a>
                    <a href="history-of-formation-and-development" class="bvgt_ten">
                        The History of the Establishment and Development of Nhi Binh Plastic                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="vision-mission-and-core-values" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/tam-nhin-su-menh-474-3563.jpg"
                            alt="VISION, MISSION AND CORE VALUES" />
                    </a>
                    <a href="vision-mission-and-core-values" class="bvgt_ten">
                        VISION, MISSION AND CORE VALUES                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="sustainable-development-strategy" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/nhua-nhi-binh-phat-trien-ben-vung-8926.jpg"
                            alt="Sustainable Development strategy" />
                    </a>
                    <a href="sustainable-development-strategy" class="bvgt_ten">
                        Sustainable Development strategy                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="quality-management-system" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/700600p546ednmainimgdefiniteguidetoprojectcontrol-8781-3023.png"
                            alt="Quality Management System" />
                    </a>
                    <a href="quality-management-system" class="bvgt_ten">
                        Quality Management System                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="production-capactity" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/nibiplastic-production-capacity-8805.jpg"
                            alt="Production capactity" />
                    </a>
                    <a href="production-capactity" class="bvgt_ten">
                        Production capactity                    </a>
                </div>
                            <div class="bvgt_item">
                    <a href="message-to-customer-vender" class="scale-img">
                        <img 
                            src="/thumbs/400x270x1/upload/news/nhi-binh-plastic-message-to-valued-customer-5560.jpg"
                            alt="Message to customer" />
                    </a>
                    <a href="message-to-customer-vender" class="bvgt_ten">
                        Message to customer                    </a>
                </div>
                    </div>
    </div>
</div>

<div class="wrap_bottom" style="background: #eee6;">
    <div class="fixwidth">
        <ul class="nav nav-pills nav_wrap" id="pills-tab" role="tablist"
            style="justify-content: center; border-bottom: 1px solid #81828542; padding-bottom: 25px; margin-bottom: 25px;"
            data-aos="fade-up">
            @foreach($categories as $idx => $cat)
                <li class="nav-item nav_sp">
                    <a class="nav-link {{ $idx === 0 ? 'active' : '' }} text-align-center"
                        id="pills-{{ $cat->slug }}-tab" data-toggle="pill"
                        href="#pills-{{ $cat->slug }}" role="tab"
                        aria-controls="pills-{{ $cat->slug }}"
                        aria-selected="{{ $idx === 0 ? 'true' : 'false' }}"><span>{{ $cat->name }}</span></a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @foreach($categories as $idx => $cat)
                <div class="tab-pane fade {{ $idx === 0 ? 'show active' : '' }}"
                    id="pills-{{ $cat->slug }}" role="tabpanel"
                    aria-labelledby="pills-{{ $cat->slug }}-tab">
                    <div class="loadkhung_product1 mb-4">
                        @forelse($cat->all_products as $prod)
                            <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="{{ url($prod->slug) }}">
                                    <img src="{{ $prod->image ?: '/thumbs/300x300x1/assets/images/noimage.png' }}"
                                         alt="{{ $prod->name }}" />
                                </a>
                                <div class="sp_content">
                                    <a href="{{ url($prod->slug) }}" title="{{ $prod->name }}" class="sp_name">{{ $prod->name }}</a>
                                    <div class="sp_mota">
                                        @if($prod->summary)
                                            <p>{{ \Illuminate\Support\Str::limit($prod->summary, 120) }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ url($prod->slug) }}" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4 text-muted">
                                <p>Chưa có sản phẩm nào trong danh mục này.</p>
                            </div>
                        @endforelse
                    </div>
                    <a href="{{ url($cat->slug) }}" class="xemgt m-auto" data-aos="fade-up">
                        See details
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="wrap_bottom">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">album</div>
        <div class="loadkhung_product">
            @forelse($albums as $alb)
                <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="{{ url($alb->slug) }}" class="scale-img">
                        <img src="{{ $alb->image ?: '/thumbs/400x300x1/assets/images/noimage.png' }}"
                             alt="{{ $alb->title }}" />
                        <span class="ten_bottom">{{ $alb->title }}</span>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Chưa có ảnh album.</div>
            @endforelse
        </div>
    </div>
</div>

<div class="wrap_bottom" style="background: #eee6;">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">News</div>
        <div class="owl-carousel owl-theme owl-dv mb-4">
            @forelse($news as $item)
                <div class="tintuc_item" data-aos="fade-up">
                    <a href="{{ url($item->slug) }}" class="scale-img">
                        <img src="{{ $item->image ?: '/thumbs/300x200x1/assets/images/noimage.png' }}" alt="{{ $item->title }}" />
                    </a>
                    <a href="{{ url($item->slug) }}" class="tintuc_ten">
                        {{ $item->title }}
                    </a>
                    <div class="tintuc_mota">
                        {{ \Illuminate\Support\Str::limit($item->summary, 140) }}
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Chưa có tin tức.</div>
            @endforelse
        </div>
        <a href="{{ route('news') }}" class="xemgt m-auto" data-aos="fade-up">
            See details
        </a>
    </div>
</div>

<div class="wrap_bottom">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">VIDEO</div>
        <div class="owl-carousel owl-theme auto_video" data-aos="fade-up">
            @forelse($videos as $vid)
                <div class="tailvideo_item1">
                    <a class="" data-fancybox="video" data-src="{{ $vid->video_url }}" title="{{ $vid->title }}">
                        <p class="pic-video">
                            <img src="{{ $vid->image ?: '/thumbs/400x250x1/assets/images/noimage.png' }}" alt="{{ $vid->title }}" />
                        </p>
                    </a>
                    <a data-fancybox="video" data-src="{{ $vid->video_url }}" class="ten_bottom">{{ $vid->title }}</a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Chưa có video.</div>
            @endforelse
        </div>
    </div>
</div>

<div class="wrap_bottom pb-5" id="background-tuvan">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">ACTIVE MARKET</div>
        <div class="owl-carousel owl-theme auto_social" data-aos="fade-up">
            @forelse($markets as $mkt)
                <div class="doitac_item text-center">
                    <div class="scale-img">
                        @if($mkt->link)
                            <a href="{{ $mkt->link }}" target="_blank">
                                <img src="{{ $mkt->image }}" alt="{{ $mkt->name }}" />
                            </a>
                        @else
                            <img src="{{ $mkt->image }}" alt="{{ $mkt->name }}" />
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Chưa có thị trường.</div>
            @endforelse
        </div>
    </div>
</div>
</div>
@endsection
