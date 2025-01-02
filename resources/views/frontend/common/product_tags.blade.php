  @php
    $tags_en = App\Models\Products::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_ind = App\Models\Products::groupBy('product_tags_ind')->select('product_tags_ind')->get();
  @endphp
  
  <!-- ============================================== PRODUCT TAGS ============================================== -->
        <div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">Product tags</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list">

                @if(session()->get('language') == 'ind')
                    @foreach($tags_ind as $tag)
                    <a class="item active" title="Hard Lure" href="category.html">
                        {{ str_replace(',', ' ', $tag->product_tags_ind) }}
                    </a>
                    @endforeach
                @else
                    @foreach($tags_en as $tag)
                    <a class="item active" title="Hard Lure" href="category.html">
                        {{ str_replace(',', ' ', $tag->product_tags_en) }}
                    </a>
                    @endforeach
                @endif


            </div>
            <!-- /.tag-list --> 
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== PRODUCT TAGS : END ============================================== --> 