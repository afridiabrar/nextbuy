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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">My cart</li>
                            </ul>
                            <!-- breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
            @include('web.layout.error')
            <!-- breadcrumb-area end -->
            
    
            <!-- main-content-wrap start -->
            <div class="main-content-wrap section-pb cart-page mt-30">
                <div class="container">
                <div class="col-md-12">
                <div class="row black-bar">
                    <div class="col-md-8">Shipping & taxes calculated at checkout</div>
                    <div class="col-md-4 text-right">{{ $totalCartCount }} Items</div>
                </div>
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
                                                <th class="plantmore-product-quantity">Quantity</th>
                                                <th class="plantmore-product-subtotal">Total</th>
                                                <th class="plantmore-product-remove">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                        
                                            <tr>
                                                <?php $img = ($item->attributes->image) ? $item->attributes->image : 'public/assets/images/other/01.jpg' ?>
                                            <td class="plantmore-product-thumbnail"><a href="#"><img style="width: 100px;height: 100px;object-fit: contain" src="{{ asset($img)}}" alt=""></a></td>
                                            <td class="plantmore-product-name"><a href="#">{{ $item->name}}</a></td>
                                                <td class="plantmore-product-price"><span class="amount">${{$item->price}}</span></td>
                                                {{-- <td class="plantmore-product-price"><span class="amount">{{$item->quantity}}</span></td> --}}
                                                <td class="plantmore-product-quantity">
                                                    <img style="height: 30px" onclick="abc('quantity_{{ $item->id}}','minus',{{ $item->id }})"  src='{{ asset('public/assets/images/minus.png') }}'/>
                                                <input value="{{ $item->quantity }}" id="quantity_{{ $item->id}}" type="number">
                                                    <img style="height: 30px" onclick="abc('quantity_{{ $item->id}}','plus',{{ $item->id }})" src='{{ asset('public/assets/images/add.png') }}'/>
                                                </td>
                                            <td class="product-subtotal"><span class="amount" id="total_amount_{{ $item->id }}">${{ number_format($item->attributes->p_total,2) }}</span></td>
                                                <td class="plantmore-product-remove"><a href="{{ route('removeItem',['id'=>$item->id])}}"><i class="ion-close"></i></a></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="coupon-all">
    
                                            <div class="coupon2">
                                                {{-- <input class="submit btn" name="update_cart" value="Update cart" type="submit"> --}}
                                            <a href="{{ route('shop') }}" class="btn continue-btn">Continue Shopping</a>
                                            </div>
    
                                            {{-- <div class="coupon">
                                                <h3>Coupon</h3>
                                                <p>Enter your coupon code if you have one.</p>
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul>
                                                {{-- <li>Subtotal <span>$170.00</span></li> --}}
                                            <li>Total <span id="total_total_amount">${{ $getTotal}}</span></li>
                                            </ul>
                                        <a href="{{ route('checkout') }}" class="proceed-checkout-btn">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-content-wrap end -->
    </div>
    <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/bootstrap.min.css"/>
    <script>
        function abc(eleid,type,id)
        {
            count =  parseInt($("#"+eleid).val());
            if(type == 'plus')
            {
                if(count < 20)
                {
                    count = count + 1;
                }else{
                    var notification = alertify.notify('Limit Exceeded', 'error', 5, function(){  console.log('dismissed'); }); 
                    return ;
                }

            }else if(type == 'minus')
            {
                if(count > 1)
                {
                    count = count - 1;
                }else{
                   var notification = alertify.notify('Value should be Greater Than 0', 'error', 5, function(){  console.log('dismissed'); });
                   return ;

                }

            }
            $("#"+eleid).val(count);
            //var url = 'http://202.142.180.147:90/yourwishon/signleCart/'+id;
            $.post("{{ route('AjaxCart')}}",{type:type,p_id:id, _token: '{{csrf_token()}}'},function(e)
                {
                  
                    var par = JSON.parse(e);
                    if(par.status == 'success')
                    {
                    
                        $("#total_amount_"+id).html("$"+par.total);
                        $("#total_total_amount").html("$"+par.total_amount);

                        
                        var notification = alertify.notify('Cart Has Been Updated', 'success', 5, function(){  console.log('dismissed'); });
                    }else if(par.status == 'error'){
                        var notification = alertify.notify('Error Occured Please Try Again Letter', 'error', 5, function(){  console.log('dismissed'); });
                    }else if(par.status == 'qty_error')
                    {
                        var notification = alertify.notify('Stock Quantity Must Be less Then Stock Or equal to In Stock', 'error', 5, function(){  console.log('dismissed'); });

                    }
                })
           
        }
        </script>
@endsection
