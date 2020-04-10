
@extends('web.layout.app')
@section('content')
 <!-- breadcrumb-area start -->
 <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Order View</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pb cart-page mt-30">
        <div class="container">
        <div class="col-md-12">
        </div>
            <div class="row">
                <div class="col-12">
                    <form action="#" class="cart-table">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="plantmore-product-thumbnail">Product</th>
                                        <th class="cart-product-name">Title</th>
                                        <th class="plantmore-product-price">Price</th>
                                        <th class="plantmore-product-price">Quantity</th>
                                        <th class="plantmore-product-price">Total</th>
                                                                
    
                                    </tr>
                                </thead>
                                <tbody>        
                                     <?php $qty = 0;$total = 0?>                       
                                    @foreach ($order->order_product as $v)
                                    <?php  $qty += $v->qty;
                                    $total += $v->total_amount;
                                   ?>  
                                    <?php $img = ($v->product->featured_image) ? $v->product->featured_image : 'assets/images/other/01.jpg'; ?>  
                                    <tr>
                                    <td class="plantmore-product-thumbnail"><a href="#"><img style="height: 100px;width:100px" src="{{asset($img)}}" alt=""></a></td>
                                        <td class="plantmore-product-name"><a href="#">{{ $v->product->name }}</a></td>
                                        <td class="plantmore-product-price"><span class="amount">{{ number_format($v->product->price,2) }}</span></td>
                                        <td class="plantmore-product-price"><span class="amount">{{ $v->qty }}</span></td>
                                        <td class="plantmore-product-price"><span class="amount">{{ number_format($v->total_amount,2) }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfooter><tr>
                                        <td class="plantmore-product-thumbnail">-</td>
                                        <td>-</td>
                                        <td>-</td>
                                <td>{{ $qty}}</td>
                                <td>{{number_format($total,2)}}</td>
                                        </tr>
                                </tfooter>
                            </table>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->



@endsection
