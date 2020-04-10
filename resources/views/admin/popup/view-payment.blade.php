<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Wish On | Admin Panel</title>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-grid.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-reboot.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/style.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/jquery.fancybox.min.css')}}" />
</head>

<body class="bg-white">
<section class="popup view-popup">
  <div class="red-heading">
    <h4 class="p-2 text-uppercase">View Payment</h4>
  </div>
  <div class="col-md-12 text-left">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
      <tr>
        <td>Stripe Transaction Id</td>
      <td>{{ $order->transaction_id }}</td>
      </tr>
      <tr>
        <td>Product Id</td>
        <td>
            @foreach ($order->orders->order_product as $vv)
          <?= $vv->product->label ?> </br>
          @endforeach
        </td>
      </tr>
      <tr>
        <td>Product Name</td>
        <td>
            @foreach ($order->orders->order_product as $vv)
          <?= $vv->product->name ?> </br>
          @endforeach
        </td>
      </tr>
      <tr>
        <td>Quantity</td>
        <td>
            @foreach ($order->orders->order_product as $vv)
          <?= $vv->qty ?> </br>
          @endforeach
        </td> 
      </tr>
      <tr>
        <td>Price</td>
        <td>
            @foreach ($order->orders->order_product as $vv)
          $ <?= number_format($vv->product->price,2) ?> </br>
          @endforeach
        </td> 
      </tr>
      <tr>
          <td>Total Price Per Product Quantity</td>
          <td>
              @foreach ($order->orders->order_product as $vv)
            $ <?= number_format($vv->total_amount,2) ?> </br>
            @endforeach
          </td> 
        </tr>

        <tr>
          <td>payment Type</td>
        <td>{{ $order->payment_type}}</td>
        </tr>
        <tr>
            <td>Status</td>
          <td>{{ $order->status}}</td>
          </tr>
          <tr>
              <td>Grand Total</td>
            <td>{{ $order->total_amount}}</td>
            </tr>
      
    </table>
    
  </div>
</section>
</body>
</html>