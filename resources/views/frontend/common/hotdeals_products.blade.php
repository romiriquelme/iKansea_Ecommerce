        <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">Hot Deals</h3>
          <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

          @foreach($hotDeals as $product)
            <div class="item">
              <div class="products">
                <div class="hot-deal-wrapper">
                  <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>

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
                <!-- /.hot-deal-wrapper -->
                
                <div class="product-info text-left m-t-20">
                  <h3 class="name"><a href="{{ url('/detail/'. $product->id. '/'.$product->product_slug_en) }}"> 
                    @if (session()->get('language') == 'ind')
                        {{ $product->product_name_ind }}
                    @else
                        {{ $product->product_name_en }}
                    @endif</a></h3>

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
                    <div class="add-cart-button btn-group">
                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                    </div>
                  </div>
                  <!-- /.action --> 
                </div>
                <!-- /.cart --> 
              </div>
            </div>
          @endforeach

          </div>
          <!-- /.sidebar-widget --> 
        </div>