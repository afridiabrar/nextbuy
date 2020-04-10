@extends('web.layout.app')
@section('content')
<div class="main-wrapper">
    <!-- Hero Section Start -->
    <div class="hero-slider hero-slider-one"> 
      <!-- Single Slide Start -->
      @if(count($banner) > 0)
      @foreach ($banner as $item)
      <?php $img = ($item->banner_image) ? $item->banner_image : 'public/assets/images/slider/slide-bg-1.jpg' ?>
      <div class="single-slide" style="background-image: url({{ asset($img)}})"> 
        <!-- Hero Content One Start -->
        <div class="hero-content-one container">
          <div class="row">
            <div class="col-lg-10 col-md-10">
              <div class="slider-text-info">
              <h2>{{ $item->title}}</h2>
               
                <!--  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words...</p>-->
                <div class="hero-btn"> <a href="{{ route('category') }}/{{ $item->slug}}" class="slider-btn uppercase"><span>SHOP NOW</span></a> </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Hero Content One End --> 
      </div>    
      @endforeach
      @endif
      
      <!-- Single Slide End -->
    </div>
    <!-- Hero Section End -->
    <section id="tabs">
      <div class="container mt-30">
        <div class="row">
          <div class="col-md-12 ">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist"> 
                @foreach ($category as $k => $item)                
                <style>

#nav-home-tab-{{ $item->id}} {
	background: url({{ asset($item->icon) }}) no-repeat center;
	text-align: center;
	width: 139px;
	height: 207px;
}
#nav-home-tab-{{ $item->id}} p {
	display: none;
}
#nav-home-tab-{{ $item->id}}:hover {
	background: url({{ asset($item->hover_icon) }}) no-repeat #418b47 center;
	text-align: center;
	width: 139px;
	height: 207px;
}
#nav-home-tab-{{ $item->id}}:hover p {
	display: block;
	color: #fff;
	text-transform: uppercase;
	margin-top: 160px;
}
a#nav-home-tab-{{ $item->id}}.active {
	background: url({{ asset($item->hover_icon) }}) no-repeat #418b47 center !important;
	text-align: center;
	width: 139px;
	height: 207px;
}
a#nav-home-tab-{{ $item->id}}.active p {
	display: block;
	color: #fff;
	text-transform: uppercase;
	margin-top: 160px;
}
                  </style>
              <a class="nav-item nav-link {{ ($k == 0 ? 'active' : '')}}"  id="nav-home-tab-{{ $item->id}}" data-toggle="tab" href="#nav-home-{{ $item->id}}" role="tab" aria-controls="nav-home" aria-selected="true">
                <p>{{ $item->name}}</p>
               </a>     
                @endforeach
              
            </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
              @foreach ($category as $kk => $item)
             
            <div class="tab-pane fade {{ ($kk == 0 ? 'show active' : '')}}" id="nav-home-{{ $item->id}}" role="tabpanel" aria-labelledby="nav-home-tab"> 
                  <!-- Start Product Area -->
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="col-lg-12 row">
                          <div class="section-title mt-30">
                            <h4>Featured Products</h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit</p>
                          <a  class="mt-20 d-block" href="#">All Product</a> <a class="mt-20" href="#"><img src="{{ asset('public/assets/images/banner/banner-ad.jpg')}}" alt="banner Images"></a> </div>
                        </div>
                      </div>
                   
                      <div class="col-lg-9">
                        <div class="porduct-area section-pb row">
                          <div class="container">
                            <div class="row product-two-row-4">
                              @foreach ($item->products as $key => $val)
                              @if($val->is_featured == 1)
                              <?php $img = ($val->featured_image) ? $val->featured_image : 'public/assets/images/product/product-12.jpg' ?>
                              <div class="col-lg-12 row"> 
                                  <!-- single-product-wrap start -->
                                  <div class="single-product-wrap">
                                  <div class="product-image"> <a href="product-details.html"><img src="{{ asset($img)}}" alt="Produce Images"></a>
                                      <div class="product-action"> <a href="#" class="add-to-cart"><i class="ion-ios-cart-outline"></i></a> <a href="#" class="quick-view" data-toggle="modal" data-target="#exampleModalCenter"><i class="ionicons ion-ios-eye-outline"></i></a> </div>
                                    </div>
                                    <div class="product-content">
                                      <h3><a href="product-details.html">Computers Accessories</a></h3>
                                      <div class="price-box"> <span class="new-price">$75.00</span> </div>
                                    </div>
                                  </div>
                                  <!-- single-product-wrap end --> 
                                </div>
                                @endif
                                @endforeach
                              
                            </div>
                          </div>
                        </div>
                        <!-- Start Product End --> 
                      </div>
                    </div>
                  </div>
                </div>    
              @endforeach
              
            
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Start Product Area --> 
    
    <!-- Start Product End --> 
    
    <!-- Start Product Area -->
    <div class="porduct-area section-pb mt-30">
      <div class="container box-shadow">
        <div class="col-lg-12 row">
          <div class="section-title mt-20 col-md-12 border-bottom">
            <div class=" row">
              <h4 class="col-md-9">Recents Products</h4>
              <a class="col-md-3 text-right green-color" href="#">VIEW ALL</a> </div>
          </div>
        </div>
        <div class="row product-two-row-4">
          @foreach ($product as $item)
          <?php $img = ($item->featured_image) ? $item->featured_image : 'public/assets/images/product/product-12.jpg' ?>
          <div class="col-lg-12"> 
              <!-- single-product-wrap start -->
              <div class="single-product-wrap">
              <div class="product-image"> <a href="product-details.html"><img style="height: 200px;width: 200px;object-fit: contain" src="{{ asset($img)}}" alt="Produce Images"></a>
                  <div class="product-action"> <a href="#" class="add-to-cart"><i class="ion-ios-cart-outline"></i></a> <a href="#" class="quick-view" data-toggle="modal" data-target="#exampleModalCenter"><i class="ionicons ion-ios-eye-outline"></i></a> </div>
                </div>
                <div class="product-content">
                  <h3><a href="product-details.html">Product Title</a></h3>
                  <div class="price-box"> <span class="new-price">$45</span> </div>
                </div>
              </div>
              <!-- single-product-wrap end --> 
            </div>
               
          @endforeach
          
        </div>
      </div>
    </div>
    <!-- Start Product End -->
  </div>
  @endsection