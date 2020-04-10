
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
                        <li class="breadcrumb-item active">Order</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pb my-account-page mt-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="account-dashboard">
                        <div class="row">
                                <div class="tab-pane col-12" id="orders">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Address</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($order) > 0)
                                                    @foreach ($order as $item)
                                                        <?php $qty = 0; $total = 0?>
                                                        @foreach ($item->order_product as $kk=>$vv)

                                                            <?php  $qty += $vv->qty;
                                                            $total += $vv->total_amount; ?>    
                                                        @endforeach
                                                    <tr>
                                                    <td>{{ $item->receipt_no}}</td>
                                                            <td>{{ date('Y-m-d',strtotime($item->created_at))}}</td>
                                                            <td>{{ $item->status}}</td>
                                                    <td>
                                                        <p>{{ $item->address->first_name }} {{ $item->address->last_name }}</p>
                                                        <p>{{ $item->address->address1 }} ,{{ $item->address->postcode }},{{ $item->address->city }}</p>
                                                     
                                                    </td>
                                                    <td><a href="{{ route('order-detail',['id'=>$item->id])}}" class="view">view</a></td>
                                                        </tr>                                                            
                                                    @endforeach
                                                    @endif

                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->

</div>
@endsection
