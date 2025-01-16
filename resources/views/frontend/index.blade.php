@extends('frontend.main_master')
@section('content')

@section('title')
    iKansea - Home
@endsection()

<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
        
        <!-- ================================== TOP NAVIGATION ================================== -->

        <div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> @if (session()->get('language') == 'ind') Kategori @else Categories @endif</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="{{ $category->category_icon }}"></i>
                    @if (session()->get('language') == 'ind')
                        {{ $category->category_name_ind }}
                    @else
                        {{ $category->category_name_en }}
                    @endif
                </a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                            $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                            @endphp
                            @foreach($subcategories as $subcategory)
                            <div class="col-sm-3">
                                <h2 class="title">
                                    @if (session()->get('language') == 'ind')
                                        {{ $subcategory->subcategory_name_ind }}
                                    @else
                                        {{ $subcategory->subcategory_name_en }}
                                    @endif
                                </h2>
                                <ul class="links">
                                    @php
                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                                    @endphp
                                    @foreach($subsubcategories as $subsubcategory)
                                    <li>
                                        <a href="#">
                                            @if (session()->get('language') == 'ind')
                                                {{ $subsubcategory->subsubcategory_name_ind }}
                                            @else
                                                {{ $subsubcategory->subsubcategory_name_en }}
                                            @endif
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                <img class="img-responsive" src="assets/images/banners/top-menu-banner.jpg" alt="">
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            @endforeach
        </ul>
    </nav>
</div>

        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== --> 
        
        <!-- ============================================== HOT DEALS ============================================== -->
        @include('frontend.common.hotdeals_products')
        <!-- ============================================== HOT DEALS: END ============================================== --> 
        
        <!-- ============================================== SPECIAL OFFER ============================================== -->
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Offer</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

              <div class="item">
                <div class="products special-product">
                  
                  @foreach($specialOffer as $product)
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}">
                            @if (session()->get('language') == 'ind')
                                {{ $product->product_name_ind }}
                            @else
                                {{ $product->product_name_en }}
                            @endif</a></h3>

                            <div class="rating rateit-small"></div>
                            @if ($product->discount_price == null)
                                <div class="product-price">
                                  <span class="price"> {{ $product->selling_price }} </span>
                                </div>
                            @else
                                <div class="product-price">
                                  <span class="price"> {{ $product->discount_price }} </span>
                                  <span class="price-before-discount">${{ $product->selling_price }}</span>
                                </div>
                            @endif
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  @endforeach

                </div>
              </div>

            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== SPECIAL OFFER : END ============================================== --> 
        @include ('frontend.common.product_tags')
        <!-- ============================================== SPECIAL DEALS ============================================== -->
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Deals</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

              <div class="item">
                <div class="products special-product">
              
                @foreach($specialDeals as $product)
                <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}">
                            @if (session()->get('language') == 'ind')
                                {{ $product->product_name_ind }}
                            @else
                                {{ $product->product_name_en }}
                            @endif</a></h3>

                            <div class="rating rateit-small"></div>
                            @if ($product->discount_price == null)
                                <div class="product-price">
                                  <span class="price"> {{ $product->selling_price }} </span>
                                </div>
                            @else
                                <div class="product-price">
                                  <span class="price"> {{ $product->discount_price }} </span>
                                  <span class="price-before-discount">${{ $product->selling_price }}</span>
                                </div>
                            @endif
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>

                </div>
                @endforeach
                </div>
              </div>

            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== SPECIAL DEALS : END ============================================== --> 
        <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
          <h3 class="section-title">Newsletters</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <p>Sign Up for Our Newsletter!</p>
            <form>
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
              </div>
              <button class="btn btn-primary">Subscribe</button>
            </form>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== NEWSLETTER: END ============================================== --> 
        
        <!-- ============================================== Testimonials============================================== -->
        <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
          <div id="advertisement" class="advertisement">
            <div class="item">
              <div class="avatar">
                <img src="{{ asset('upload/user_images/bandeng.jpg') }}" alt="Image">
            </div>
            <div class="testimonials">
                <em>"</em>"Ikan segar, berkualitas tinggi, langsung dari laut ke dapur Anda! Kaya nutrisi dan rasa, sempurna untuk hidangan sehat keluarga. Pesan sekarang!"<em>"</em>
            </div>
            <div class="clients_author">Prince Syahrul <span>IkanSea</span></div>
            
              <!-- /.container-fluid --> 
            </div>
            <!-- /.item -->
            
            <div class="item">
              <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
              <div class="testimonials"><em>"</em>"Nikmati kesegaran laut di meja Anda dengan ikan segar berkualitas tinggi! Langsung dari laut, kaya akan nutrisi seperti omega-3 dan protein, cocok untuk semua jenis hidangan favorit Anda. Pesan sekarang dan bawa kelezatan sehat ke dapur Anda hari ini!"<em>"</em></div>
              <div class="clients_author">Taufik Ismail <span>IkaSea</span> </div>
            </div>
            <!-- /.item -->
            
            <div class="item">
              <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
              <div class="testimonials"><em>"</em> "Segarkan hidangan Anda dengan ikan berkualitas tinggi! Kaya nutrisi, lezat, dan langsung dari laut ke meja Anda. Pesan sekarang untuk kelezatan yang sehat dan bergizi!"<em>"</em></div>
              <div class="clients_author">King Fahmi <span>IkanSea</span> </div>
              <!-- /.container-fluid --> 
            </div>
            <!-- /.item --> 
            
          </div>
          <!-- /.owl-carousel --> 
        </div>
        
        <!-- ============================================== Testimonials: END ============================================== -->
        
        <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
              @foreach($sliders as $slider)
                  <div class="item" style="background-image: url({{ asset($slider->slider_img) }});">
                      <div class="container-fluid">
                          <div class="caption bg-color vertical-center text-left">
                              <div class="slider-header fadeInDown-1">Top Brands</div>
                              <div class="big-text fadeInDown-1"> {{ $slider->title }} </div>
                              <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                              <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                          </div>
                          <!-- /.caption --> 
                      </div>
                      <!-- /.container-fluid --> 
                  </div>
                  <!-- /.item -->
              @endforeach
          </div>
          <!-- /.owl-carousel --> 
      </div>

        
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
            <div class="row">
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">money back</h4>
                    </div>
                  </div>
                  <h6 class="text">30 Days Money Back Guarantee</h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">free shipping</h4>
                    </div>
                  </div>
                  <h6 class="text">Shipping on orders over $99</h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Special Sale</h4>
                    </div>
                  </div>
                  <h6 class="text">Extra $5 off on all items </h6>
                </div>
              </div>
              <!-- .col --> 
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.info-boxes-inner --> 
          
        </div>
        <!-- /.info-boxes --> 
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">

              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>

              @foreach($categories as $category)
                  <li>
                      <a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">
                          @if (session()->get('language') == 'ind')
                              {{ $category->category_name_ind }}
                          @else
                              {{ $category->category_name_en }}
                          @endif
                      </a>
                  </li>
              @endforeach

            </ul>
            <!-- /.nav-tabs --> 
          </div>


          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                @foreach($products as $product)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <!-- /.image -->

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount / $product->selling_price) * 100;
                                @endphp

                                @if ($product->discount_price == null)
                                    <div class="tag new"><span>new</span></div>
                                @else
                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                @endif
                            </div>
                            <!-- /.product-image -->

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}">
                                        @if (session()->get('language') == 'ind')
                                            {{ $product->product_name_ind }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>



                                @if ($product->discount_price == null)
                                    <div class="product-price">
                                        <span class="price"> {{ $product->selling_price }} </span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="price"> {{ $product->discount_price }} </span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                    </div>
                                @endif
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-info -->

                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->id }}" onclick="productView(this.id)">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                        </li>


                                        
                                        
                                        <li class="lnk">
                                          <a data-toggle="tooltip" class="add-to-cart" href="" title="Compare">
                                            <i class="fa fa-signal" aria-hidden="true"></i>
                                          </a>
                                        </li>

                                        <li class="add-cart-button btn-group">
                                            <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
                                                <i class="icon fa fa-heart"></i>
                                            </button>
                                        </li>
                                      </ul>
                                </div>
                                <!-- /.action -->
                            </div>
                            <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                    </div>
                    <!-- /.products -->
                </div>
                @endforeach
                <!-- /.item -->


                  

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            

            @foreach($categories as $category)

            @php
                $productsByCategory = App\Models\Products::where('category_id', $category->id)->OrderBy('id', 'DESC')->get();
            @endphp
            <div class="tab-pane" id="category{{ $category->id }}">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">

                @forelse($productsByCategory as $product)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <!-- /.image -->

                                

                                @if ($product->discount_price == null)
                                    <div class="tag new"><span>new</span></div>
                                @else
                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                @endif
                            </div>
                            <!-- /.product-image -->

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="">
                                        @if (session()->get('language') == 'ind')
                                            {{ $product->product_name_ind }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>



                                @if ($product->discount_price == null)
                                    <div class="product-price">
                                        <span class="price"> {{ $product->selling_price }} </span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="price"> {{ $product->discount_price }} </span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                    </div>
                                @endif
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-info -->

                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                        </li>
                                        <li class="lnk wishlist">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.action -->
                            </div>
                            <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                    </div>
                    <!-- /.products -->
                </div>
                @empty
                <!-- /.item -->
                <div class="text-danger">No Product</div>
                @endforelse

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            @endforeach
            <!-- /.tab-pane -->
          
            
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 
        <!-- ============================================== SCROLL TABS : END ============================================== --> 
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="assets/images/banners/home-banner1.jpg" alt=""> </div>
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col -->
            <div class="col-md-5 col-sm-5">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="assets/images/banners/home-banner2.jpg" alt=""> </div>
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

          @foreach($featured as $product)
          <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <!-- /.image -->

                                

                                @if ($product->discount_price == null)
                                    <div class="tag new"><span>new</span></div>
                                @else
                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                @endif
                            </div>
                            <!-- /.product-image -->

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="">
                                        @if (session()->get('language') == 'ind')
                                            {{ $product->product_name_ind }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>



                                @if ($product->discount_price == null)
                                    <div class="product-price">
                                        <span class="price"> {{ $product->selling_price }} </span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="price"> {{ $product->discount_price }} </span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                    </div>
                                @endif
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-info -->

                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                        </li>
                                        <li class="lnk wishlist">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.action -->
                            </div>
                            <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                    </div>
                    <!-- /.products -->
                </div>
          @endforeach
            <!-- /.item -->
            
          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Fish</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

          @foreach($skip_product_0 as $product)
          <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <!-- /.image -->

                                

                                @if ($product->discount_price == null)
                                    <div class="tag new"><span>new</span></div>
                                @else
                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                @endif
                            </div>
                            <!-- /.product-image -->

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="">
                                        @if (session()->get('language') == 'ind')
                                            {{ $product->product_name_ind }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a>
                                </h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>



                                @if ($product->discount_price == null)
                                    <div class="product-price">
                                        <span class="price"> {{ $product->selling_price }} </span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="price"> {{ $product->discount_price }} </span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                    </div>
                                @endif
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-info -->

                            <div class="cart clearfix animate-effect">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                        </li>
                                        <li class="lnk wishlist">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li class="lnk">
                                            <a data-toggle="tooltip" class="add-to-cart" href="" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.action -->
                            </div>
                            <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                    </div>
                    <!-- /.products -->
                </div>
          @endforeach
            <!-- /.item -->
            
          </div>
          <!-- /.home-owl-carousel --> 
        </section>

        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-12">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="assets/images/banners/home-banner.jpg" alt=""> </div>
                <div class="strip strip-text">
                  <div class="strip-inner">
                    <h2 class="text-right">New Mens Fashion<br>
                      <span class="shopping-needs">Save up to 40% off</span></h2>
                  </div>
                </div>
                <div class="new-label">
                  <div class="text">NEW</div>
                </div>
                <!-- /.new-label --> 
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col --> 
            
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== BEST SELLER ============================================== -->
        
        <div class="best-deal wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">Best seller</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
              <div class="item">
                <div class="products best-product">
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p20.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">salmon</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $15 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p21.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">nila</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $10 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="products best-product">
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p22.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">Lobster</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $21 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p23.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">yuyu crab</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $12 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="products best-product">
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p24.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">Tuna</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $41 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p25.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">Bandeng</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $11 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="products best-product">
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p26.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">Bandeng</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $23 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="assets/images/products/p27.jpg" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col2 col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#">Bandeng</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== BEST SELLER : END ============================================== --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->
        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
          <h3 class="section-title">latest form blog</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">iKansea</a></h3>
                    <span class="info">By King Fahmi &nbsp;|&nbsp; 15 January 2025 </span>
                    <p class="text">"Segarkan hidangan Anda dengan ikan berkualitas tinggi! Kaya nutrisi, lezat, dan langsung dari laut ke meja Anda. Pesan sekarang untuk kelezatan yang sehat dan bergizi!"</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Mantap</a></h3>
                    <span class="info">By Taufik Ismail &nbsp;|&nbsp; 16 January 2025 </span>
                    <p class="text">"Nikmati kesegaran laut di meja Anda dengan ikan segar berkualitas tinggi! Langsung dari laut, kaya akan nutrisi seperti omega-3 dan protein, cocok untuk semua jenis hidangan favorit Anda. Pesan sekarang dan bawa kelezatan sehat ke dapur Anda hari ini!"</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">W0W</a></h3>
                    <span class="info">By wahyu &nbsp;|&nbsp; 16/01/2025 </span>
                    <p class="text"> hayati di laut, serta pentingnya menjaga kelestarian ekosistem laut dan ikan-ikan yang ada di dalamnya
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">123</a></h3>
                    <span class="info">By habib &nbsp;|&nbsp; 17/01/2025 </span>
                    <p class="text">Ikan adalah pilihan makanan rendah kalori, terutama jenis ikan tanpa lemak. Karena kandungan proteinnya yang tinggi dan lemak sehat, ikan dapat memberikan rasa kenyang yang lebih lama, membantu mengontrol nafsu makan dan mendukung penurunan berat badan atau menjaga berat badan sehat</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">OREO</a></h3>
                    <span class="info">By ROMI &nbsp;|&nbsp; 16/01/2025 </span>
                    <p class="text">Beberapa jenis ikan, seperti salmon dan sarden, kaya akan vitamin A dan omega-3, yang dapat membantu menjaga kesehatan mata. Asam lemak omega-3 berperan dalam mencegah degenerasi makula yang berkaitan dengan usia (AMD), sebuah kondisi yang dapat menyebabkan kebutaan pada orang dewasa yang lebih tua</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
            </div>
            <!-- /.owl-carousel --> 
          </div>
          <!-- /.blog-slider-container --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section wow fadeInUp new-arriavls">
          <h3 class="section-title">New Arrivals</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p19.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag new"><span>new</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">kakap merah</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $233 </span> <span class="price-before-discount">$ 100</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p28.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag new"><span>new</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">kerapu</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $200 </span> <span class="price-before-discount">$ 50</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p30.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag hot"><span>hot</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">bawal</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $100 </span> <span class="price-before-discount">$ 50</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p1.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag hot"><span>hot</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">tongkol</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $50 </span> <span class="price-before-discount">$ 25</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p2.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag sale"><span>sale</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">Bandeng</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $45 </span> <span class="price-before-discount">$ 25</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href=""><img  src="assets/images/products/p3.jpg" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag sale"><span>sale</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="">patin</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> $42 </span> <span class="price-before-discount">$ 25</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item --> 
          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.body.brands')
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
  </div>
  <!-- /.container --> 
</div>



@endsection