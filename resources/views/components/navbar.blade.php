<div class="header-height">
        <div id="menu_top">
            <div class="fixwidth clearfix">
                <div class="menu">
                    <ul class="menu_cap_cha d-flex">
                        <li class="menulicha trangchu active"><a href="{{ route('home') }}"
                                title="Home"><i class="fas fa-home mr-2 n_mb"></i> Home</a></li>
                        <li class="menulicha "><a href="{{ route('about') }}"
                                title="About us">About us <i
                                    class="fas fa-chevron-down ml-1 n_mb"></i></a>
                                                            <ul class="menu_cap_con">
                                    <li><a title="About us" href="{{ route('about') }}"
                                            style="text-transform: uppercase;">About us</a>
                                        <div class="mota_menu"><p style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;">Established in 2009<strong>,</strong> </span><span style="color:#e74c3c;"><strong>Nhi Binh Plastic Company Limited</strong> </span><span style="color:#666666;">specializes in manufacturing plastic products using injection molding and extrusion technologies. Beginning with a modest 100m² facility and only 2 injection molding machines, Nhi Binh Plastic has continuously expanded its production scale from 2010 to 2015, reaching 1,500m² in Hoc Mon District, Ho Chi Minh City, along with adding 14 more modern injection molding machines to its production line.</span></span></span></p>



<p data-sourcepos="5:1-5:205" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   In June 2016,</strong> Nhi Binh Plastic inaugurated its Binh Duong Branch Factory in VSIP II-A Industrial Park with an investment of VND 45 billion. This factory is 1<strong>0,000m²</strong>. </span></span></span></p>



<p data-sourcepos="7:1-7:483" style="text-align:justify;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;"><span style="color:#666666;"><strong>   With a long-term vision,</strong> we have continuously expanded our operations, investing heavily in a clean production plant, modern machinery and equipment, applying automation in production, digitalizing management, and training our employees. To date, we have over <strong>50 injection molding machines</strong>, over <strong>180 officers and workers</strong>, with a production capacity of over <strong>200 tons/month</strong>. All of this is aimed at better meeting the needs of our customers and helping them grow stronger together.</span></span></span></p>

                                        </div>

                                    </li>
                                                                            <li><a title="OVERVIEW OF NHI BINH PLASTIC"
                                                href="overview-of-nhi-binh-plastics">OVERVIEW OF NHI BINH PLASTIC</a>
                                            <div class="mota_menu">Nhi Binh Plastic is a leading injection molding plastic factory in Ho Chi Minh City, Vietnam, specializing in plastic product manufacturing with high quality. We leverage advanced technologies such as injection molding for plastic products and extrusion to create a wide array of items tailored to various industrial and consumer needs.</div>
                                        </li>
                                                                            <li><a title="WHY CHOOSE US?"
                                                href="why-choose-us">WHY CHOOSE US?</a>
                                            <div class="mota_menu">When choosing Nhi Binh Plastic, customers not only receive high-quality products and excellent service but also enjoy peace of mind, assurance, and complete satisfaction.</div>
                                        </li>
                                                                            <li><a title="The History of the Establishment and Development of Nhi Binh Plastic"
                                                href="history-of-formation-and-development">The History of the Establishment and Development of Nhi Binh Plastic</a>
                                            <div class="mota_menu">Nhi Binh Plastic's history of sustainable growth and technological innovation since its founding in 2009 has positioned the company as a leading plastic manufacturer</div>
                                        </li>
                                                                            <li><a title="VISION, MISSION AND CORE VALUES"
                                                href="vision-mission-and-core-values">VISION, MISSION AND CORE VALUES</a>
                                            <div class="mota_menu">The company's leadership always strives for a long-term vision, sustainable development, and the application of technological innovations, along with a consistent management system to ensure effective operations</div>
                                        </li>
                                                                            <li><a title="Sustainable Development strategy"
                                                href="sustainable-development-strategy">Sustainable Development strategy</a>
                                            <div class="mota_menu">Nhi Binh Plastic's commitment to sustainability, BSCI certification, green manufacturing, and social responsibility. Investing in advanced technology and community development</div>
                                        </li>
                                                                            <li><a title="Quality Management System"
                                                href="quality-management-system">Quality Management System</a>
                                            <div class="mota_menu">Nhi Binh Plastic  implements a strict quality control process following ISO 9001:2015 standards. We ensure high-quality plastic products that meet the stringent demands of international markets.</div>
                                        </li>
                                                                            <li><a title="Production capactity"
                                                href="production-capactity">Production capactity</a>
                                            <div class="mota_menu">Nhi Binh Plastic, advanced plastic injection molding capability with high technology, large scale production, and export to global markets,  meet all customer demands </div>
                                        </li>
                                                                            <li><a title="Message to customer"
                                                href="message-to-customer-vender">Message to customer</a>
                                            <div class="mota_menu">Nhi Binh Plastic Company sincerely thanks our valued customers for their trust and cooperation with our company during the past period.</div>
                                        </li>
                                                                    </ul>
                                                    </li>

                        <li class="menulicha "><a href="{{ route('products.index') }}"
                                title="Product">Product <i class="fas fa-chevron-down ml-1 n_mb"></i></a>
                            <ul class="menu_cap_con">
                                @if(isset($navCategories) && $navCategories->count())
                                    @foreach($navCategories as $navRoot)
                                        <li><a title="{{ $navRoot->name }}" href="{{ url($navRoot->slug) }}">{{ $navRoot->name }}</a>
                                            @if($navRoot->children && $navRoot->children->count())
                                                <ul class="menu_cap_2">
                                                    @foreach($navRoot->children as $navChild)
                                                        <li><a title="{{ $navChild->name }}" href="{{ url($navChild->slug) }}">{{ $navChild->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>

                        <li class="menulicha "><a href="service"
                                title="Service">Service <i class="fas fa-chevron-down ml-1 n_mb"></i></a>
                                                            <ul class="menu_cap_con">
                                                                            <li><a title="Plastic product design"
                                                href="plastic-product-design">Plastic product design</a>
                                            <div class="mota_menu">Plastic Product Design - Bringing Your Ideas to Life with Nhi Binh Plastic. Do you have an exceptional idea for a plastic product but are unsure where to begin? Allow Nhi Binh Plastic to guide you from the design phase through to production, turning your vision into a fully realized product.</div>
                                        </li>
                                                                            <li><a title="Injection mold manufacturing"
                                                href="injection-mold-manufacturing">Injection mold manufacturing</a>
                                            <div class="mota_menu">Discover Nhi Binh Plastic's advanced capabilities in precision mold-making and injection molding. With over 15 years of experience, we deliver high-quality, ISO-certified plastic products for global markets</div>
                                        </li>
                                                                            <li><a title="Plastic Injection Molding"
                                                href="plastic-injection-molding">Plastic Injection Molding</a>
                                            <div class="mota_menu">Nhi Binh Plastic offers high-precision plastic injection molding services . From custom plastic production to two-color molding and metal insert molding, top-quality products </div>
                                        </li>
                                                                            <li><a title="Printing, plating, and painting on plastic products"
                                                href="printing-on-plastic-products">Printing, plating, and painting on plastic products</a>
                                            <div class="mota_menu">Nhi Binh Plastic offers advanced services in plastic printing, plastic electroplating, and surface coating. Elevate your brand with high-quality printing solutions across a wide range of products and plastic materials.</div>
                                        </li>
                                                                            <li><a title="Extruding plastic pipes, plastic rods"
                                                href="extruding-plastic-pipes-plastic-rods">Extruding plastic pipes, plastic rods</a>
                                            <div class="mota_menu">Nhi Binh Plastic specializes in extruding plastic pipes and rods to order with high quality, safety, and competitive prices.</div>
                                        </li>
                                                                            <li><a title=" Plastic Welding Services"
                                                href="plastic-welding-services"> Plastic Welding Services</a>
                                            <div class="mota_menu">Nhi Binh Plastic Company proudly offers professional and modern plastic welding services, meeting diverse customer requirements. We specialize in two advanced welding methods: heat welding and high-frequency welding, ensuring the highest quality and performance for plastic products.</div>
                                        </li>
                                                                    </ul>
                                                    </li>

                        <li class="menulicha "><a href="album"
                                title="Album">Album</a>

                        </li>
                        <li class="menulicha li_menu_tintuc "><a href="company-news"
                                title="News">News <i class="fas fa-chevron-down ml-1 n_mb"></i></a>
                                                            <ul class="menu_cap_con">
                                                                            <li><a title="Company news" href="company-news">Company news</a>
                                        </li>
                                                                            <li><a title="Product news" href="product-news">Product news</a>
                                        </li>
                                                                            <li><a title="Learning Center" href="learning-center">Learning Center</a>
                                        </li>
                                                                            <li><a title="Life tips" href="life-tips">Life tips</a>
                                        </li>
                                                                    </ul>
                                                    </li>
                        <li class="menulicha "><a href="{{ route('contact') }}"
                                title="Contact us">Contact us</a></li>
                        <li class="menulicha menuli_form" id="menuli_form_id">
                            <a class="btn_tim" title="Search">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                        <li class="menulicha menuli_close">
                            <a class="btn_close" title="Search">
                                <i class="fas fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="frm_timkiem frmtim">
                        <input type="text" class="input" id="keyword234" placeholder="Search ..."
                            onkeypress="doEnter(event,'keyword234');">
                        <button type="submit" class="nut_tim" id="nut__tim" onclick="onSearch('keyword234');"><i
                                class="far fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>