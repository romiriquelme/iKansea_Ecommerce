@extends('frontend.main_master')
@section('content')

@section('title')
    Product Detail
@endsection



<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row single-product">
            <div class="col-md-3 sidebar">
                <div class="sidebar-module-container">
                    <div class="home-banner outer-top-n">
                        <img src="assets/images/banners/LHS-banner.jpg" alt="Image">
                    </div>

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('frontend.common.hotdeals_products')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
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
                    </div>
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget wow fadeInUp outer-top-vs">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliquam morbi non sem lacus port mollis. Nunc condimentum metus eu molestie sed consectetur.<em>"</em></div>
                                <div class="clients_author">John Doe<span>Abc Company</span></div>
                            </div>

                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliquam morbi non sem lacus port mollis. Nunc condimentum metus eu molestie sed consectetur.<em>"</em></div>
                                <div class="clients_author">Stephen Doe<span>Xperia Designs</span></div>
                            </div>

                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliquam morbi non sem lacus port mollis. Nunc condimentum metus eu molestie sed consectetur.<em>"</em></div>
                                <div class="clients_author">Saraha Smith<span>Datsun &amp; Co</span></div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================== Testimonials: END ============================================== -->

                </div>
            </div>
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach($multiImg as $img)
                                    <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                        <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name) }}">
                                            <img class="img-responsive" alt="" src="{{ asset($img->photo_name) }}" />
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        @foreach($multiImg as $img)
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name) }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name" id="pname">
                                    @if(Session::get('language') == 'ind'){{ $product->product_name_ind }}@else{{ $product->product_name_en }}@endif
                                </h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(13 Reviews)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">{{ $product->product_qty }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="description-container m-t-20">
                                    @if(Session::get('language') == 'ind'){{ $product->short_desc_ind }}@else{{ $product->short_desc_en }}@endif
                                </div>

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if($product->discount_price == NULL)
                                                <span class="price">{{ $product->selling_price }}</span>
                                                @else
                                                <span class="price">{{ $product->discount_price }}</span>
                                                <span class="price-strike">{{ $product->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity-container info-container">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input type="number" id="qty" min="1" value="1" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

                                        <div class="col-sm-7">
                                            <button type="submit" onClick="addToCart()" class="btn btn-primary">
                                                <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-tabs inner-bottom-xs wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">@if(Session::get('language') == 'ind'){!! $product->long_desc_ind !!}@else{!! $product->long_desc_en !!}@endif</p>
                                    </div>
                                </div>

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title">
                                                        <span class="summary">We love this product</span>
                                                        <span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span>
                                                    </div>
                                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam suscipit."</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac velit hendrerit, gravida dui at, varius eros.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
