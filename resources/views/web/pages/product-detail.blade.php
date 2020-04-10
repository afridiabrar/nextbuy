@extends('web.layout.app')
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    @include('web.layout.error')
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pb mt-30 product-details-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <div class="product-details-images">
                        <div class="product_details_container">
                            <!-- product_big_images start -->
                            <div class="product_big_images-top">
                            
                                <div class="portfolio-full-image tab-content">
                                        @foreach ($product->productImages as $kk=>$vv)
                                            @if($vv->type == 'image')
                                <div role="tabpanel" class="tab-pane {{ $kk == 0 ?'active' : '' }} product-image-position" id="img-tab-{{$kk}}">
                                    <a href="{{ asset($vv->prouct_images) }}" class="img-poppu">
                                    <img style="height: 500px;width: 500px;object-fit: contain" src="{{ asset($vv->prouct_images) }}" alt="#">
                                        </a>
                                    </div>
                                    @else
                                    <div role="tabpanel" class="tab-pane {{ $kk == 0 ?'active' : '' }} product-image-position" id="img-tab-{{$kk}}">
                                            <a href="{{ asset($vv->prouct_images) }}" class="img-poppu">
                                                    <video style="height: 100%;width: 100%;object-fit: contain" src="{{ asset($vv->prouct_images) }}" controls>
                                                    </video>
                                            </a>
                                    </div>
                                    @endif
                                        @endforeach
                                </div>
                            </div>
                            <!-- product_big_images end -->
                            <!-- Start Small images -->
                            <ul class="product_small_images-bottom horizantal-product-active nav" role="tablist">
                                @foreach ($product->productImages as $kkk=>$vvv)
                                @if($vvv->type == 'image')
                                <li role="presentation" class="pot-small-img {{ $kkk == 0 ?'active' : '' }}">
                                        <a href="#img-tab-{{ $kkk }}" role="tab" data-toggle="tab">
                                        <img style="height: 100px;width: 200px;object-fit: contain" src="{{asset($vvv->prouct_images)}}" alt="small-image">
                                        </a>
                                </li>
                                    @else
                                    <li role="presentation" class="pot-small-img {{ $kkk == 0 ?'active' : '' }}">
                                            <a href="#img-tab-{{ $kkk }}" role="tab" data-toggle="tab">
                                            <video style="height: 100px;width: 100px;object-fit: contain" src="{{asset($vvv->prouct_images)}}" alt="small-video">
                                            </video>
                                            </a>
                                        </li>
                                    @endif                                        
                                @endforeach
                            
                            </ul>
                            <!-- End Small images -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-6">
                    <!-- product_details_info start -->
                    <div class="product_details_info">
                    <h2>{{ $product->name}}</h2>
                        <!-- pro_rating start -->
                        <div class="pro_rating d-flex">
                         <span class="rat_qun"> Condition: <strong class="green-color">New product</strong>  </span>
                        </div>
                        <!-- pro_rating end -->
                        <!-- pro_details start -->
                        <div class="pro_details">
                        <p>{{  substr($product->description, 0, 100) }}..</p>
                        </div>
                        <!-- pro_details end -->
                        <!-- pro_dtl_prize start -->
                        <ul class="pro_dtl_prize">
                        <li> ${{ number_format($product->price,2) }}</li>
                        </ul>
                        <!-- pro_dtl_prize end -->
                        <!-- product-quantity-action start -->
                    <form method="POST" action="{{ route('addCart') }}">
                        @csrf
                        <div class="product-quantity-action">
                            <div class="prodict-statas"><span>Quantity :</span></div>
                            <div class="product-quantity">
                                    <div class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input value="1" name="qty" type="number">
                                            <input type="hidden" name="p_id" value="{{ $product->id }}">
                                        </div>
                                    </div>
                            </div>
                             <ul class="pro_dtl_btn">
                            <li>
                                    <input type="submit" value="Buy Now">
                            </li>
                        </ul>
                        </div>
                        </form>
                        <!-- product-quantity-action end -->
                        <!-- pro_dtl_btn start -->
                       
                        <!-- pro_dtl_btn end -->
                        <!-- pro_dtl_color start-->
                        {{-- <div class="pro_dtl_color">
                            <h2 class="title_2">Colour</h2>
                            <ul class="pro_choose_color">
                                <li class="red"><a href="#"><i class="ion-record"></i></a></li>
                                <li class="blue"><a href="#"><i class="ion-record"></i></a></li>
                                <li class="perpal"><a href="#"><i class="ion-record"></i></a></li>
                                <li class="yellow"><a href="#"><i class="ion-record"></i></a></li>
                            </ul>
                            
                        </div> --}}
                        <!-- pro_dtl_color end-->
                           <div class="pro_dtl_color">
                            {{ $product->in_stock }} Items 
                           <span class="stock">in stock</span>
                        </div>
                        
                    </div>
                    <!-- product_details_info end -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details-tab mt-60">
                        <ul role="tablist" class="nav">
                            <li class="active" role="presentation">
                                <a data-toggle="tab" role="tab" href="#description" class="active">Description</a>
                            </li>                         
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_details_tab_content tab-content">
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                            <div class="product_description_wrap">
                                <div class="product_desc mb--30 col-md-12">
                                <p>{{ $product->description}}</p>
                                </div>
                                
                            </div>
                        </div>
                        <!-- End Single Content -->
            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->

    <div class="porduct-area section-pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="section-title">
                            <h4>Related Products</h4>
                            
                        </div>
                    </div>
                </div>

                <div class="row product-active-lg-4">

                    @if(count($related) > 0)
                        @foreach ($related as $item)
                    <div class="col-lg-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="{{ asset('public/assets/images/product/product-04.jpg')}}" alt="Produce Images"></a>
                                <div class="product-action">
                                    <a href="#" class="add-to-cart"><i class="ion-ios-cart-outline"></i></a>
                                    <a href="#" class="quick-view" data-toggle="modal" data-target="#exampleModalCenter"><i class="ionicons ion-ios-eye-outline"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Product Title</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$100</span>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>
                    @endforeach
                    @endif
                    


                </div>
            </div>
        </div>
@endsection