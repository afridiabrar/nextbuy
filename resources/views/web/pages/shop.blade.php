@extends('web.layout.app')
@section('content')
<div class="main-wrapper">
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    @include('web.layout.error')
    <!-- breadcrumb-area end -->
    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-pb mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- shop-product-wrapper start -->
                    <div class="shop-product-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <!-- shop-top-bar start -->
                                <div class="shop-top-bar">
                                    <!-- product-view-mode start -->

                                    <div class="product-mode">
                                        <!--shop-item-filter-list-->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active"><a class="active" data-toggle="tab" href="#grid"><i class="ion-ios-keypad-outline"></i></a></li>
                                            <li><a data-toggle="tab" href="#list"><i class="ion-ios-list-outline"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <!-- product-view-mode end -->
                                    <!-- product-short start -->
                                    <div class="product-short">
                                    <form method="get" action="{{ route('search')}} ">
                                      
                                        <select  style="width: 80%;" class="nice-select" name="sortby">
                                            <option value="A-Z">Name(A - Z)</option>
                                            <option value="Z-A">Name(Z - A)</option>
                                            <option value="price">Price(Low > High)</option>
                                        </select>
                                        <button style="padding: 3px 10p" type="submit" class="my-btn"><i class="ion-ios-search"></i></button>
                                        </form>
                                    </div>
                                    <!-- product-short end -->
                                </div>
                                <!-- shop-top-bar end -->
                            </div>
                        </div>

                        <!-- shop-products-wrap start -->
                        <div class="shop-products-wrap">
                            <div class="tab-content">
                                <div class="tab-pane active" id="grid">
                                    <div class="shop-product-wrap">
                                        <div class="row">
                                            @foreach($product as $k => $vvv)
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <?php $img = (!empty($vvv->featured_image)) ? $vvv->featured_image : 'public/assets/images/product/product-12.jpg' ?>
                                                        <a href="{{ route('product-detail',['id'=>$vvv->id])}}"><img style="height: 200px;width: 200px;object-fit: contain" src="{{ asset($img) }}" alt="Produce Images"></a>
                                                        <div class="product-action">
                                                            <a href="{{ route('signleCart',['id'=>$vvv->id])}}" class="add-to-cart"><i class="ion-ios-cart-outline"></i></a>
                                                            <a href="{{ route('product-detail',['id'=>$vvv->id])}}" class="quick-view" data-toggle="modal" data-target="#exampleModalCenter"><i class="ionicons ion-ios-eye-outline"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                    <h3><a href="product-details.html">{{ $vvv->name}}</a></h3>
                                                        <div class="price-box">
                                                            <span class="new-price">${{ number_format($vvv->price,2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="list">
                                    <div class="shop-product-list-wrap">
                                            @foreach($product as $k => $v)
                                        <div class="row product-layout-list">
                                            <div class="col-lg-4 col-md-5">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                        <?php $img = ($v->featured_image) ? $v->featured_image : 'public/assets/images/product/product-12.jpg' ?>

                                                    <div class="product-image">
                                                        <a href="product-details.html"><img src="{{ asset($img)}}" alt="Produce Images"></a>
                                                        <div class="product-action">
                                                            <a href="#" class="add-to-cart"><i class="ion-ios-cart-outline"></i></a>
                                                            <a href="#" class="quick-view" data-toggle="modal" data-target="#exampleModalCenter"><i class="ionicons ion-ios-eye-outline"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="product-content text-left">
                                                    <h3><a href="product-details.html">{{ $v->name}}</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">${{ number_format($v->price,2) }}</span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis pariatur ipsa sint consectetur velit maiores sit voluptates aut tempora totam, consequatur iste quod suscipit natus. Explicabo facere neque adipisci odio.</p>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop-products-wrap end -->

                        <!-- paginatoin-area start -->
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                        {{ $product->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- paginatoin-area end -->
                    </div>
                    <!-- shop-product-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
</div>

@endsection