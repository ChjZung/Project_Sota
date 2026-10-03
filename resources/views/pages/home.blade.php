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



<p data-sourcepos="5:1-5:205" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   In June 2016,</strong> Nhi Binh Plastic inaugurated its Binh Duong Branch Factory in VSIP II-A Industrial Park with an investment of VND 45 billion. This factory is 1<strong>0,000m²</strong>. </span></span></span></p>



<p data-sourcepos="7:1-7:483" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   With a long-term vision,</strong> we have continuously expanded our operations, investing heavily in a clean production plant, modern machinery and equipment, applying automation in production, digitalizing management, and training our employees. To date, we have over <strong>50 injection molding machines</strong>, over <strong>180 officers and workers</strong>, with a production capacity of over <strong>200 tons/month</strong>. All of this is aimed at better meeting the needs of our customers and helping them grow stronger together.</span></span></span></p>

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
                            <li class="nav-item nav_sp">
                    <a class="nav-link active text-align-center"
                        id="pills-custom-plastic-products-tab" data-toggle="pill"
                        href="#pills-custom-plastic-products" role="tab"
                        aria-controls="pills-custom-plastic-products"
                        aria-selected="true"><span>CUSTOM PLASTIC PRODUCTS</span></a>
                </li>
                            <li class="nav-item nav_sp">
                    <a class="nav-link  text-align-center"
                        id="pills-nhi-binh-plastic-products-tab" data-toggle="pill"
                        href="#pills-nhi-binh-plastic-products" role="tab"
                        aria-controls="pills-nhi-binh-plastic-products"
                        aria-selected="true"><span>NHI BINH PLASTIC PRODUCTS</span></a>
                </li>
                            <li class="nav-item nav_sp">
                    <a class="nav-link  text-align-center"
                        id="pills-children-plastic-toys-mibitoi-tab" data-toggle="pill"
                        href="#pills-children-plastic-toys-mibitoi" role="tab"
                        aria-controls="pills-children-plastic-toys-mibitoi"
                        aria-selected="true"><span>Children Plastic Toys -Mibitoi</span></a>
                </li>
                    </ul>
        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active"
                    id="pills-custom-plastic-products" role="tabpanel"
                    aria-labelledby="pills-custom-plastic-products-tab">
                    <div class="loadkhung_product1 mb-4">
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="small-black-abs-plastic-broom-handle-end-cap-with-hanging-loop">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-4383.png"
                                        alt="Small Black ABS Plastic Broom Handle End Cap with Hanging Loop" />
                                </a>
                                <div class="sp_content">
                                    <a href="small-black-abs-plastic-broom-handle-end-cap-with-hanging-loop" title="Small Black ABS Plastic Broom Handle End Cap with Hanging Loop"
                                        class="sp_name">Small Black ABS Plastic Broom Handle End Cap with Hanging Loop</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="small-black-abs-plastic-broom-handle-end-cap-with-hanging-loop" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="large-white-abs-lock">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/2-3981.png"
                                        alt="Large white ABS lock" />
                                </a>
                                <div class="sp_content">
                                    <a href="large-white-abs-lock" title="Large white ABS lock"
                                        class="sp_name">Large white ABS lock</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="large-white-abs-lock" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="small-white-abs-lock">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-3909.png"
                                        alt="Small white ABS lock" />
                                </a>
                                <div class="sp_content">
                                    <a href="small-white-abs-lock" title="Small white ABS lock"
                                        class="sp_name">Small white ABS lock</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="small-white-abs-lock" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="abs-plastic-hook-txf">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-2316.png"
                                        alt="ABS Plastic Hook TXF" />
                                </a>
                                <div class="sp_content">
                                    <a href="abs-plastic-hook-txf" title="ABS Plastic Hook TXF"
                                        class="sp_name">ABS Plastic Hook TXF</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="abs-plastic-hook-txf" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="high-quality-small-abs-plastic-hook">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-5140.png"
                                        alt="High-Quality Small ABS Plastic Hook" />
                                </a>
                                <div class="sp_content">
                                    <a href="high-quality-small-abs-plastic-hook" title="High-Quality Small ABS Plastic Hook"
                                        class="sp_name">High-Quality Small ABS Plastic Hook</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="high-quality-small-abs-plastic-hook" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="large-abs-plastic-impact-collar">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-3131.png"
                                        alt="Large ABS Plastic Impact Collar" />
                                </a>
                                <div class="sp_content">
                                    <a href="large-abs-plastic-impact-collar" title="Large ABS Plastic Impact Collar"
                                        class="sp_name">Large ABS Plastic Impact Collar</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="large-abs-plastic-impact-collar" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="small-abs-plastic-impact-collar">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-2213.png"
                                        alt="Small ABS Plastic Impact Collar" />
                                </a>
                                <div class="sp_content">
                                    <a href="small-abs-plastic-impact-collar" title="Small ABS Plastic Impact Collar"
                                        class="sp_name">Small ABS Plastic Impact Collar</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="small-abs-plastic-impact-collar" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="lightweight-and-durable-pp-funnel-shaped-plastic-ferrule">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/co-nhua-pp-hinh-pheujpg-8748.png"
                                        alt="Lightweight and Durable PP Funnel-Shaped Plastic Ferrule" />
                                </a>
                                <div class="sp_content">
                                    <a href="lightweight-and-durable-pp-funnel-shaped-plastic-ferrule" title="Lightweight and Durable PP Funnel-Shaped Plastic Ferrule"
                                        class="sp_name">Lightweight and Durable PP Funnel-Shaped Plastic Ferrule</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="lightweight-and-durable-pp-funnel-shaped-plastic-ferrule" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="high-quality-abs-handle-for-ostrich-feather-duster">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/1-2850.png"
                                        alt="High-Quality ABS Handle for Ostrich Feather Duster" />
                                </a>
                                <div class="sp_content">
                                    <a href="high-quality-abs-handle-for-ostrich-feather-duster" title="High-Quality ABS Handle for Ostrich Feather Duster"
                                        class="sp_name">High-Quality ABS Handle for Ostrich Feather Duster</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="high-quality-abs-handle-for-ostrich-feather-duster" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="100-recycled-pp-plastic-sanding-pad-backing-plate-durable-high-quality">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/4-6780.png"
                                        alt="100% Recycled PP Plastic Sanding Pad Backing Plate - Durable &amp; High Quality" />
                                </a>
                                <div class="sp_content">
                                    <a href="100-recycled-pp-plastic-sanding-pad-backing-plate-durable-high-quality" title="100% Recycled PP Plastic Sanding Pad Backing Plate - Durable &amp; High Quality"
                                        class="sp_name">100% Recycled PP Plastic Sanding Pad Backing Plate - Durable &amp; High Quality</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="100-recycled-pp-plastic-sanding-pad-backing-plate-durable-high-quality" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="best-plastic-automatic-flower-water-fountain3l-for-pet-cat-and-dogs">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/may-uong-nuoc-tu-dong-xanh-la-1-2698.png"
                                        alt="Best Plastic Automatic Flower Water Fountain/3L For Pet Cat and Dogs" />
                                </a>
                                <div class="sp_content">
                                    <a href="best-plastic-automatic-flower-water-fountain3l-for-pet-cat-and-dogs" title="Best Plastic Automatic Flower Water Fountain/3L For Pet Cat and Dogs"
                                        class="sp_name">Best Plastic Automatic Flower Water Fountain/3L For Pet Cat and Dogs</a>
                                    <div class="sp_mota">
                                        <p>The perfect solution for clean and fresh water. Smart design, large capacity, quiet operation, easy to clean, and made from safe materials. Ensure the health of your pets!</p>

                                    </div>
                                    <a href="best-plastic-automatic-flower-water-fountain3l-for-pet-cat-and-dogs" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="plastic-squeaky-ball-toy-teeth-cleaning-for-small-medium-dogs">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/doggyman-xanh-9281.png"
                                        alt="Plastic Squeaky Ball Toy Teeth Cleaning for Small Medium Dogs" />
                                </a>
                                <div class="sp_content">
                                    <a href="plastic-squeaky-ball-toy-teeth-cleaning-for-small-medium-dogs" title="Plastic Squeaky Ball Toy Teeth Cleaning for Small Medium Dogs"
                                        class="sp_name">Plastic Squeaky Ball Toy Teeth Cleaning for Small Medium Dogs</a>
                                    <div class="sp_mota">
                                        <p>Plastic dog chew ball toy is a fun and safe product for your pet's health. Made from flexible and BPA-free TPE plastic.This toy not only reduces stress and stimulates natural chewing behavior but also supports your dog's dental health.</p>
                                    </div>
                                    <a href="plastic-squeaky-ball-toy-teeth-cleaning-for-small-medium-dogs" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                            </div>
                    <a href="custom-plastic-products" class="xemgt m-auto" data-aos="fade-up">
                        See details                    </a>
                    <!-- <a href="custom-plastic-products" class="btn_lienhe m-auto">Xem thêm</a> -->
                </div>
                                            <div class="tab-pane fade "
                    id="pills-nhi-binh-plastic-products" role="tabpanel"
                    aria-labelledby="pills-nhi-binh-plastic-products-tab">
                    <div class="loadkhung_product1 mb-4">
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="jelly-color-clear-hair-claw-clips-for-thick-hair-fashion-elegant-headwear-hair-accessories">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/kep-toc-cam-trong-suot-2-5639.png"
                                        alt="Jelly Color Clear Hair Claw Clips for Thick Hair Fashion Elegant Headwear Hair Accessories" />
                                </a>
                                <div class="sp_content">
                                    <a href="jelly-color-clear-hair-claw-clips-for-thick-hair-fashion-elegant-headwear-hair-accessories" title="Jelly Color Clear Hair Claw Clips for Thick Hair Fashion Elegant Headwear Hair Accessories"
                                        class="sp_name">Jelly Color Clear Hair Claw Clips for Thick Hair Fashion Elegant Headwear Hair Accessories</a>
                                    <div class="sp_mota">
                                        <p>Hair claw clips are a type of hair accessory designed with a unique style and elegant jelly clear color, using lightweight and safe PS plastic. They have a simple design, making it easy to style your hair without causing hair loss</p>

                                    </div>
                                    <a href="jelly-color-clear-hair-claw-clips-for-thick-hair-fashion-elegant-headwear-hair-accessories" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="plastic-pastel-hair-claw-clips-strong-hold-for-women-girls-thin-thick-hair">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/kep-cam-2169.png"
                                        alt="Plastic Pastel Hair Claw Clips Strong Hold for Women Girls Thin Thick Hair" />
                                </a>
                                <div class="sp_content">
                                    <a href="plastic-pastel-hair-claw-clips-strong-hold-for-women-girls-thin-thick-hair" title="Plastic Pastel Hair Claw Clips Strong Hold for Women Girls Thin Thick Hair"
                                        class="sp_name">Plastic Pastel Hair Claw Clips Strong Hold for Women Girls Thin Thick Hair</a>
                                    <div class="sp_mota">
                                        <p>Rectangular-shaped crab claw hair clips with soft Korean pastel colors and lightweight, safe PS plastic material, these hair clips not only keep your hair tidy but also add a stylish touch to your hairstyle.</p>

                                    </div>
                                    <a href="plastic-pastel-hair-claw-clips-strong-hold-for-women-girls-thin-thick-hair" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="rectangle-marble-plastic-hair-claw-clip-non-slip-clips-hair-accessories">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/kep-cam-thach-5755.png"
                                        alt="Rectangle Marble Plastic Hair Claw Clip Non Slip Clips Hair Accessories" />
                                </a>
                                <div class="sp_content">
                                    <a href="rectangle-marble-plastic-hair-claw-clip-non-slip-clips-hair-accessories" title="Rectangle Marble Plastic Hair Claw Clip Non Slip Clips Hair Accessories"
                                        class="sp_name">Rectangle Marble Plastic Hair Claw Clip Non Slip Clips Hair Accessories</a>
                                    <div class="sp_mota">
                                        <p>Rectangle claw hair clips with unique marble colors and lightweight, safe PS plastic material, not only keep your hair tidy but also add a stylish touch to your hairstyle.</p>

                                    </div>
                                    <a href="rectangle-marble-plastic-hair-claw-clip-non-slip-clips-hair-accessories" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="non-slip-plastic-folding-step-stool-with-large-handle-for-kitchen-bathroom-and-bedroom-safety-for-adults-kids-toddlers">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/ghe-xep-1-7405.png"
                                        alt="Non-slip Plastic Folding Step Stool with Large Handle for Kitchen, Bathroom and Bedroom Safety for Adults, Kids, Toddlers" />
                                </a>
                                <div class="sp_content">
                                    <a href="non-slip-plastic-folding-step-stool-with-large-handle-for-kitchen-bathroom-and-bedroom-safety-for-adults-kids-toddlers" title="Non-slip Plastic Folding Step Stool with Large Handle for Kitchen, Bathroom and Bedroom Safety for Adults, Kids, Toddlers"
                                        class="sp_name">Non-slip Plastic Folding Step Stool with Large Handle for Kitchen, Bathroom and Bedroom Safety for Adults, Kids, Toddlers</a>
                                    <div class="sp_mota">
                                        <p>The foldable plastic chair is made from durable PP plastic, safe for consumer health. It has good load-bearing capacity and is suitable for both indoor and outdoor use. </p>

                                    </div>
                                    <a href="non-slip-plastic-folding-step-stool-with-large-handle-for-kitchen-bathroom-and-bedroom-safety-for-adults-kids-toddlers" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="13cm-multicolor-plastic-carton-handles-for-easy-transport">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/logo-dsc2913-6963-1164.jpg"
                                        alt="13cm Multicolor Plastic Carton Handles For Easy Transport" />
                                </a>
                                <div class="sp_content">
                                    <a href="13cm-multicolor-plastic-carton-handles-for-easy-transport" title="13cm Multicolor Plastic Carton Handles For Easy Transport"
                                        class="sp_name">13cm Multicolor Plastic Carton Handles For Easy Transport</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="13cm-multicolor-plastic-carton-handles-for-easy-transport" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="15cm-multicolor-plastic-carton-handles-for-easy-transport">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/logo-dsc2914-6921-4899.jpg"
                                        alt="15cm Multicolor Plastic Carton Handles For Easy Transport" />
                                </a>
                                <div class="sp_content">
                                    <a href="15cm-multicolor-plastic-carton-handles-for-easy-transport" title="15cm Multicolor Plastic Carton Handles For Easy Transport"
                                        class="sp_name">15cm Multicolor Plastic Carton Handles For Easy Transport</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="15cm-multicolor-plastic-carton-handles-for-easy-transport" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-115-x-55-x-17mm-kh-01">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/logo-kh01-kh02-2-9503-9082.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 115 x 55 x 17mm KH-01" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-115-x-55-x-17mm-kh-01" title="Empty False Eyelashes Plastic Storage Box, 115 x 55 x 17mm KH-01"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 115 x 55 x 17mm KH-01</a>
                                    <div class="sp_mota">
                                        <p>KH-01 Empty False Eyelash Plastic Storage Box is crafted from lightweight, durable, and safe. The lid is clear and the base is multi-color such as white, black, clear, gold metallic, silver metallic, and more.</p>

                                    </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-115-x-55-x-17mm-kh-01" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-120-x-69-x-15mm-kh-06">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/dsc3062-7228-8099.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 120 x 69 x 15mm KH-06" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-120-x-69-x-15mm-kh-06" title="Empty False Eyelashes Plastic Storage Box, 120 x 69 x 15mm KH-06"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 120 x 69 x 15mm KH-06</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-120-x-69-x-15mm-kh-06" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-1175-x-65-x-17mm-kh-02">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/dsc3080-9949-4260.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 117,5 x 65 x 17mm KH-02" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-1175-x-65-x-17mm-kh-02" title="Empty False Eyelashes Plastic Storage Box, 117,5 x 65 x 17mm KH-02"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 117,5 x 65 x 17mm KH-02</a>
                                    <div class="sp_mota">
                                        <p>KH-02 Empty False Eyelash Plastic Storage Box is crafted from lightweight, durable, and safe. The lid is clear and the base is multi-color such as white, black, clear, gold metallic, silver metallic, and more.</p>

                                    </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-1175-x-65-x-17mm-kh-02" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-115x55x145mm-kh-03">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/logo-kh03-hop-long-mi-chot-dung-9543-9106.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 115x55x14,5mm KH-03" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-115x55x145mm-kh-03" title="Empty False Eyelashes Plastic Storage Box, 115x55x14,5mm KH-03"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 115x55x14,5mm KH-03</a>
                                    <div class="sp_mota">
                                        <p>KH-03 Empty False Eyelash Plastic Storage Box is crafted from lightweight, durable, and safe. The lid is clear and the base is multi-color such as white, black, clear, gold metallic, silver metallic, and more.</p>

                                    </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-115x55x145mm-kh-03" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-115x-55x-145-mm-kh-04">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/dsc3088-1245-1599.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 115x 55x 14,5 mm KH-04" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-115x-55x-145-mm-kh-04" title="Empty False Eyelashes Plastic Storage Box, 115x 55x 14,5 mm KH-04"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 115x 55x 14,5 mm KH-04</a>
                                    <div class="sp_mota">
                                        <p>KH-04 Empty False Eyelash Plastic Storage Box is crafted from lightweight, durable, and safe. The lid is clear and the base is multi-color such as white, black, clear, gold metallic, silver metallic, and more.</p>

                                    </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-115x-55x-145-mm-kh-04" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="empty-false-eyelashes-plastic-storage-box-65x-55x-18mm-kh-07">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/dsc3073-3139-7980.jpg"
                                        alt="Empty False Eyelashes Plastic Storage Box, 65x 55x 18mm KH-07" />
                                </a>
                                <div class="sp_content">
                                    <a href="empty-false-eyelashes-plastic-storage-box-65x-55x-18mm-kh-07" title="Empty False Eyelashes Plastic Storage Box, 65x 55x 18mm KH-07"
                                        class="sp_name">Empty False Eyelashes Plastic Storage Box, 65x 55x 18mm KH-07</a>
                                    <div class="sp_mota">
                                                                            </div>
                                    <a href="empty-false-eyelashes-plastic-storage-box-65x-55x-18mm-kh-07" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                            </div>
                    <a href="nhi-binh-plastic-products" class="xemgt m-auto" data-aos="fade-up">
                        See details                    </a>
                    <!-- <a href="nhi-binh-plastic-products" class="btn_lienhe m-auto">Xem thêm</a> -->
                </div>
                                            <div class="tab-pane fade "
                    id="pills-children-plastic-toys-mibitoi" role="tabpanel"
                    aria-labelledby="pills-children-plastic-toys-mibitoi-tab">
                    <div class="loadkhung_product1 mb-4">
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="colorful-plastic-plane-geometric-shapes-construction-set">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/hinh-hoc-phang-1-5760.png"
                                        alt="Colorful Plastic Plane Geometric Shapes Construction Set" />
                                </a>
                                <div class="sp_content">
                                    <a href="colorful-plastic-plane-geometric-shapes-construction-set" title="Colorful Plastic Plane Geometric Shapes Construction Set"
                                        class="sp_name">Colorful Plastic Plane Geometric Shapes Construction Set</a>
                                    <div class="sp_mota">
                                        <p>The smart construction toy set consists of basic geometric shapes, including squares, triangles, circles, rectangles, trapezoids, rhombuses, pentagons, and stars.</p>

                                    </div>
                                    <a href="colorful-plastic-plane-geometric-shapes-construction-set" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="miclik-colorful-plastic-assembly-kids-toy-set-size-l">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/smart-toys-miclik-l-3-1922.png"
                                        alt="Miclik Colorful Plastic Assembly Kids Toy Set Size L" />
                                </a>
                                <div class="sp_content">
                                    <a href="miclik-colorful-plastic-assembly-kids-toy-set-size-l" title="Miclik Colorful Plastic Assembly Kids Toy Set Size L"
                                        class="sp_name">Miclik Colorful Plastic Assembly Kids Toy Set Size L</a>
                                    <div class="sp_mota">
                                        <p>Miclik Assembly Kids Toy Set Size L is packaged in a square box for long-term storage. It includes 60 plastic pieces and a detailed instruction sheet with various colors.</p>



<p> </p>

                                    </div>
                                    <a href="miclik-colorful-plastic-assembly-kids-toy-set-size-l" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="plastic-alphabet-and-numbers-dominoes-set-learning-fun-for-kids">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/bodominochucai-va-so-07-2819-6452.jpg"
                                        alt=" Plastic Alphabet and Numbers Dominoes Set- Learning Fun For Kids" />
                                </a>
                                <div class="sp_content">
                                    <a href="plastic-alphabet-and-numbers-dominoes-set-learning-fun-for-kids" title=" Plastic Alphabet and Numbers Dominoes Set- Learning Fun For Kids"
                                        class="sp_name"> Plastic Alphabet and Numbers Dominoes Set- Learning Fun For Kids</a>
                                    <div class="sp_mota">
                                        <p>Assist children in becoming familiar with letters, numbers, and colors. The set consists of 39 cards, measuring 72 mm x 36 mm, printed on both sides with Vietnamese letters and numbers from 1 to 10.</p>

                                    </div>
                                    <a href="plastic-alphabet-and-numbers-dominoes-set-learning-fun-for-kids" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="colorful-plastic-mastering-math-dominoes-set-for-kids-learning">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/dominotoanhoc-03-6062-9385.jpg"
                                        alt="Colorful Plastic Mastering Math Dominoes Set For Kids' Learning" />
                                </a>
                                <div class="sp_content">
                                    <a href="colorful-plastic-mastering-math-dominoes-set-for-kids-learning" title="Colorful Plastic Mastering Math Dominoes Set For Kids' Learning"
                                        class="sp_name">Colorful Plastic Mastering Math Dominoes Set For Kids' Learning</a>
                                    <div class="sp_mota">
                                        <p>Assist children in becoming familiar with flat shapes, solid figures, and comparative numbers. The set consists of 56 pieces, each measuring 72 mm x 36 mm.</p>

                                    </div>
                                    <a href="colorful-plastic-mastering-math-dominoes-set-for-kids-learning" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                                    <div class="sp_item" data-aos="fade-up">
                                <a class="scale-img" href="miclik-colorful-plastic-assembly-kids-toy-set-size-s-creative-building-toy">
                                    <img 
                                        src="/thumbs/300x300x1/upload/product/micliksbolapghepthongminh14-5479-1988.jpg"
                                        alt="Miclik  Colorful Plastic Assembly Kids Toy Set  Size S- Creative Building Toy" />
                                </a>
                                <div class="sp_content">
                                    <a href="miclik-colorful-plastic-assembly-kids-toy-set-size-s-creative-building-toy" title="Miclik  Colorful Plastic Assembly Kids Toy Set  Size S- Creative Building Toy"
                                        class="sp_name">Miclik  Colorful Plastic Assembly Kids Toy Set  Size S- Creative Building Toy</a>
                                    <div class="sp_mota">
                                        <p>Miclik size S smart assembly toy set is packaged in a square box, ensuring long-term protection for the pieces. It includes 48 plastic pieces, four wheels, and one detailed instruction sheet featuring various colors.</p>

                                    </div>
                                    <a href="miclik-colorful-plastic-assembly-kids-toy-set-size-s-creative-building-toy" class="chitiet_sp">Details</a>
                                </div>
                            </div>
                                            </div>
                    <a href="children-plastic-toys-mibitoi" class="xemgt m-auto" data-aos="fade-up">
                        See details                    </a>
                    <!-- <a href="children-plastic-toys-mibitoi" class="btn_lienhe m-auto">Xem thêm</a> -->
                </div>
                    </div>
    </div>
</div>

<div class="wrap_bottom">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">album</div>
        <div class="loadkhung_product">
                            <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="outside-the-plastic-product-manufacturing-factory-at-vsip-2a-binh-duong" class="scale-img">
                        <img 
                            src="/thumbs/400x300x1/upload/news/nhua-nhi-binh-nha-may-ep-nhua-vsip-2a-binh-duong-4998.jpg"
                            alt="Outside the plastic product manufacturing factory at VSIP 2A, Binh Duong" />
                        <a href="outside-the-plastic-product-manufacturing-factory-at-vsip-2a-binh-duong" class="ten_bottom">Outside the plastic product manufacturing factory at VSIP 2A, Binh Duong</a>
                    </a>
                    <!-- <div class="bvgt_ten">
                    Outside the plastic product manufacturing factory at VSIP 2A, Binh Duong                </div> -->
                </div>
                            <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="injection-molding-area-with-modern-automated-injection-machines-equipped-with-robotic-arms" class="scale-img">
                        <img 
                            src="/thumbs/400x300x1/upload/news/3-4418-3847.jpeg"
                            alt="Injection molding area with modern, automated injection machines equipped with robotic arms" />
                        <a href="injection-molding-area-with-modern-automated-injection-machines-equipped-with-robotic-arms" class="ten_bottom">Injection molding area with modern, automated injection machines equipped with robotic arms</a>
                    </a>
                    <!-- <div class="bvgt_ten">
                    Injection molding area with modern, automated injection machines equipped with robotic arms                </div> -->
                </div>
                            <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="warehouse-for-plastic-raw-materials-plastic-products-and-packaging" class="scale-img">
                        <img 
                            src="/thumbs/400x300x1/upload/news/nhi-binh-plastic-warehouse-5517.jpg"
                            alt="Warehouse for plastic raw materials, plastic products, and packaging" />
                        <a href="warehouse-for-plastic-raw-materials-plastic-products-and-packaging" class="ten_bottom">Warehouse for plastic raw materials, plastic products, and packaging</a>
                    </a>
                    <!-- <div class="bvgt_ten">
                    Warehouse for plastic raw materials, plastic products, and packaging                </div> -->
                </div>
                            <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="plastic-product-assembly-and-packaging-room" class="scale-img">
                        <img 
                            src="/thumbs/400x300x1/upload/news/manufacture-plastic-product-packing-room-1033.jpeg"
                            alt="Plastic product assembly and packaging room" />
                        <a href="plastic-product-assembly-and-packaging-room" class="ten_bottom">Plastic product assembly and packaging room</a>
                    </a>
                    <!-- <div class="bvgt_ten">
                    Plastic product assembly and packaging room                </div> -->
                </div>
                            <div class="bvgt_item" style="margin: 0;" data-aos="fade-up">
                    <a href="album-2" class="scale-img">
                        <img 
                            src="/thumbs/400x300x1/upload/news/nhibinh2406028-6552-2098.jpg"
                            alt="Inauguration Ceremony of the Plastic Factory in Binh Duong Province - Phase I" />
                        <a href="album-2" class="ten_bottom">Inauguration Ceremony of the Plastic Factory in Binh Duong Province - Phase I</a>
                    </a>
                    <!-- <div class="bvgt_ten">
                    Inauguration Ceremony of the Plastic Factory in Binh Duong Province - Phase I                </div> -->
                </div>
                    </div>
    </div>
</div>

<div class="wrap_bottom" style="background: #eee6;">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">News</div>
        <div class="owl-carousel owl-theme owl-dv mb-4">
                            <div class="tintuc_item" data-aos="fade-up">
                    <a organizing-the-15th-anniversary-of-the-establishment-of-nhi-binh-plastic-company class="scale-img">
                        <img src="/thumbs/300x200x1/upload/news/nhua-nhi-binh-15-nam-1-7957.jpg" alt="Organizing the 15th anniversary of the establishment of Nhi Binh Plastic Company" />
                    </a>
                    <a href="organizing-the-15th-anniversary-of-the-establishment-of-nhi-binh-plastic-company" class="tintuc_ten">
                        Organizing the 15th anniversary of the establishment of Nhi Binh Plastic Company                    </a>
                    <div class="tintuc_mota">
                        Organizing tourism, team building, gala dinner to celebrate the 15th anniversary of the establishment of Nhi Binh Plastic Company 2009-2024                    </div>
                </div>
                            <div class="tintuc_item" data-aos="fade-up">
                    <a organizing-a-vacation-for-staff-and-employees-in-2018 class="scale-img">
                        <img src="/thumbs/300x200x1/upload/news/cb14798d8cc874962dd9-4881-2312.jpg" alt="Organizing a vacation for staff and employees in 2018" />
                    </a>
                    <a href="organizing-a-vacation-for-staff-and-employees-in-2018" class="tintuc_ten">
                        Organizing a vacation for staff and employees in 2018                    </a>
                    <div class="tintuc_mota">
                        Organizing a vacation for staff and employees in 2018                    </div>
                </div>
                            <div class="tintuc_item" data-aos="fade-up">
                    <a groundbreaking-ceremony-for-the-construction-of-binh-duong-factory-phase-2 class="scale-img">
                        <img src="/thumbs/300x200x1/upload/news/dsc1177-7553-6242.jpg" alt="Groundbreaking Ceremony for the Construction of Binh Duong Factory Phase 2" />
                    </a>
                    <a href="groundbreaking-ceremony-for-the-construction-of-binh-duong-factory-phase-2" class="tintuc_ten">
                        Groundbreaking Ceremony for the Construction of Binh Duong Factory Phase 2                    </a>
                    <div class="tintuc_mota">
                        Groundbreaking Ceremony for the Construction of Binh Duong Factory Phase 2                    </div>
                </div>
                    </div>
        <a href="tin-tuc" class="xemgt m-auto" data-aos="fade-up">
            See details        </a>
    </div>
</div>
<div class="wrap_bottom">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">VIDEO</div>
        <div class="owl-carousel owl-theme auto_video" data-aos="fade-up">
                            <div class="tailvideo_item1">
                    <a class="" data-fancybox="video" data-src="https://youtu.be/3r_do9QYJkU?si=zyDU3wRDA-D9Gltw" title="About Nhi Binh Plastic Company">
                        <p class="pic-video"><img 
                                src="/thumbs/400x250x1/upload/news/nhua-nhi-binh-nha-may-ep-nhua-vsip-2a-binh-duong-2640.jpg" alt="About Nhi Binh Plastic Company" />
                        </p>
                    </a>
                    <a data-fancybox="video" data-src="https://youtu.be/3r_do9QYJkU?si=zyDU3wRDA-D9Gltw" class="ten_bottom">About Nhi Binh Plastic Company</a>
                </div>
                            <div class="tailvideo_item1">
                    <a class="" data-fancybox="video" data-src="https://www.youtube.com/watch?v=CVmL6suEY2A&amp;t=1s" title="Nhi Binh Plastic Company - Factory improvement program.">
                        <p class="pic-video"><img 
                                src="/thumbs/400x250x1/upload/news/5451232747994690-2719.jpg" alt="Nhi Binh Plastic Company - Factory improvement program." />
                        </p>
                    </a>
                    <a data-fancybox="video" data-src="https://www.youtube.com/watch?v=CVmL6suEY2A&amp;t=1s" class="ten_bottom">Nhi Binh Plastic Company - Factory improvement program.</a>
                </div>
                            <div class="tailvideo_item1">
                    <a class="" data-fancybox="video" data-src="https://www.youtube.com/watch?v=XM6xWJm19_Y" title="Inauguration ceremony of phase 1 - Nhi Binh Plastic factory at VSIP 2A Industrial Park - Binh Duong">
                        <p class="pic-video"><img 
                                src="/thumbs/400x250x1/upload/news/dsc1177-7553-5199.jpg" alt="Inauguration ceremony of phase 1 - Nhi Binh Plastic factory at VSIP 2A Industrial Park - Binh Duong" />
                        </p>
                    </a>
                    <a data-fancybox="video" data-src="https://www.youtube.com/watch?v=XM6xWJm19_Y" class="ten_bottom">Inauguration ceremony of phase 1 - Nhi Binh Plastic factory at VSIP 2A Industrial Park - Binh Duong</a>
                </div>
                            <div class="tailvideo_item1">
                    <a class="" data-fancybox="video" data-src="https://www.youtube.com/watch?v=a9R5yG021EU" title="Why should you choose Nhi Binh Plastic as a strategic supplier?">
                        <p class="pic-video"><img 
                                src="/thumbs/400x250x1/upload/news/z5448116717809391c65151dcb657d1bae230a111edb71-1484-4275.jpg" alt="Why should you choose Nhi Binh Plastic as a strategic supplier?" />
                        </p>
                    </a>
                    <a data-fancybox="video" data-src="https://www.youtube.com/watch?v=a9R5yG021EU" class="ten_bottom">Why should you choose Nhi Binh Plastic as a strategic supplier?</a>
                </div>
                    </div>
    </div>
</div>
<div class="wrap_bottom pb-5" id="background-tuvan">
    <div class="fixwidth">
        <div class="title" data-aos="fade-up">ACTIVE MARKET</div>
        <div class="owl-carousel owl-theme auto_social" data-aos="fade-up">
                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhuanhibinhvietnammarket-1545.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhibinhplasticusamarket-1609.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhuanhibinhjapanmarket-4762.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhibinhplasticchinamarket-3025.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhibinhplasticnetherlandmarket-3885.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhibinhplasticspainmarket-1820.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhuanhibinhcanadamarket-3384.png" />
                    </div>
                </div>

                            <div class="doitac_item text-center">
                    <div class="scale-img">
                        <img 
                            src="/thumbs/200x100x1/upload/photo/nhibinhplasticenglandmarket-6239.png" />
                    </div>
                </div>

                    </div>
    </div>
</div></div>

        
@endsection
