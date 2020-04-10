@extends('admin.layout.app')
@section('content')
<div class="content-div">
  
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">payment</p>
        </div>
        <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>Transaction Id</th>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>User Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total Amount</th>
              <th>Action</th>
            </tr>
            @foreach ($payment as $v)
            <tr>
            <td>{{ $v->transaction_id}}</td>
                <td>
                    @foreach ($v->orders->order_product as $vv)
                  <?= $vv->product->label ?> </br>
                  @endforeach
                </td> 
              <td>
                  @foreach ($v->orders->order_product as $vv)
                <?= $vv->product->name ?> </br>
                @endforeach
              </td> 
              <td>{{ $v->users->f_name }} {{ $v->users->l_name }}</td>
              <td>
                  @foreach ($v->orders->order_product as $vv)
                <?= $vv->qty ?> </br>
                @endforeach
              </td> 
              <td>
                  @foreach ($v->orders->order_product as $vv)
                $<?= number_format($vv->product->price,2) ?> </br>
                @endforeach
              </td> 
              <td>
                  @foreach ($v->orders->order_product as $vv)
                <?= number_format($vv->total_amount,2) ?> </br>
                @endforeach
              </td> 
              <td>
              
              <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('view_payment')}}" class="">
                <button class="view-button">View</button>
              </a>
                
                </td>
            </tr>
            @endforeach
  
          </table>
          <div class="paging">
            
            
                
                
                </div>
        </div>
      </div>
      @endsection
