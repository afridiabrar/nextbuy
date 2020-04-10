@extends('admin.layout.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

    <div class="content-div">
    @include('admin.layout.error')

    <div class="head col-md-12 d-inline-block">
      <p class="table-heading mt-2">Edit Order</p>
    </div>
    <form action="{{ route('UpdateOrder',['id'=>$order->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="col-md-12">
      <div class="text-left">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td>Receipt No#</td>
              <td>{{ $order->receipt_no }} </td>
         </tr>
        <tr>
              <td>Customer Name</td>
        <td>{{ $order->user->f_name }} {{ $order->user->l_name }}</td>
        </tr>
         <tr>
                <td>Payment Type</td>
                <td>{{ $order->payment_type}} </td>
        </tr>

        <tr>
                <td>Order Status</td>
                <td>{{ $order->status }} </td>
        </tr>
        <tr>
                <td>Additional Note</td>
                <td>{{ $order->note }} </td>
        </tr>
        <tr>
            <td>Grand Total Amount </td>
            <td>{{ number_format($order->total_amount,2) }} </td>
    </tr>
    <tr>
        <td>Grand Total After Discount </td>
        <td>{{ number_format($order->discounted_amount,2)  }} </td>
</tr>
    <tr>
        <td>Additional Note</td>
        <td>{{ $order->note }} </td>
</tr>
        
        <tr>
            <td>Order Delivery Date</td>
        <td><input type="text" value="{{ $order->sent_date }}" name="sent_date"/></td>
       </tr>
       <tr>
          <td>Order Delivery Time</td>
          <td><input type="text" value="{{ $order->sent_time }}" name="sent_time"/></td>
       </tr>
       <tr>
        <td>Time Slot Note</td>
        <td><textarea rows="4" name="sent_slot" cols="4" style="width: 24%">{{ $order->sent_slot }}</textarea> </td>
       </tr>
      </table>
      <div class="col-md-12 text-right mt-2">
        <button style="margin-bottom: 7px;background-color: #84c441;" class="view-button" type="submit">Update Order</button>
        </div>
        <div class="col-md-12 text-left mt-2">
            <button data-fancybox="" data-type="iframe" data-src="" href="{{ route('additem',['id'=>Request::segment(3) ])}}" style="margin-bottom: 7px;background-color: #84c441;" class="view-button" type="submit">Add Item</button>
            </div>
      <table id="dtBasicExample" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #84c441;">
        <thead>
            <th style="background: unset;">Product Name</th>
          <th style="background: unset;">Product Image</th>
          <th style="background: unset;">Quantity</th>
          <th style="background: unset;">Price</th>
          <th style="background: unset;">Sub Total</th>
          <th style="background: unset;">Action</th>
        </thead>
        <tbody>
          @foreach ($order->order_product as $item)
          <?php $img = ($item->product->featured_image) ? $item->product->featured_image  :'https://www.lamonde.com/pub/media/catalog/product/placeholder/default/Lamonde_-_Image_-_No_Product_Image_4.png' ?>
          <tr>
              <td>{{ $item->product->name}}</td>
              <td><img width="100px" height="100px" src="{{ asset($item->product->featured_image) }}"></td>
              <td class="plantmore-product-quantity" style="text-align: center">
                  <img style="height: 30px" onclick="abc('quantity_{{ $item->product_id}}','minus',{{ $item->product_id }})"  src='{{ asset('public/assets/images/minus.png') }}'/>
              <input style="text-align: center" value="{{ $item->qty }}" readonly id="quantity_{{ $item->product_id}}" type="number">
                  <img style="height: 30px" onclick="abc('quantity_{{ $item->product_id}}','plus',{{ $item->product_id }})" src='{{ asset('public/assets/images/add.png') }}'/>
              </td>
              <td>{{ number_format($item->price,2) }} aed</td>
              <td class="product-subtotal"><span class="amount" id="total_amount_{{ $item->product_id }}">{{ number_format($item->total_amount,2) }} aed</span></td>
            <td><a  class="" href="{{ route('orderProductdelete',['id'=>$item->id])}}"><button type="button" style="background: red;" class="view-button">Delete</button></a>
              </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td><span id="all_total">{{ number_format($order->total_amount,2) }}</span> aed</td>
          <td>-</td>
        </tfoot>
      </table>

    </div>
    </div>
    </form>
  </div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

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
          window.onload = function () {
              $('#dtBasicExample').DataTable();
              $('.dataTables_length').addClass('bs-select');
          }
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
              var order_id = '{{ Request::segment(3)}}';

              $.post("{{ route('AjaxCart')}}",{type:type,p_id:id, _token: '{{csrf_token()}}',order_id:order_id},function(e)
                  {
                      var par = JSON.parse(e);
                      if(par.status == 'success')
                      {
                          $("#total_amount_"+id).html(par.total+"aed");
                          $("#all_total").html(par.total_amount);
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
