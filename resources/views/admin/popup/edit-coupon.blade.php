<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Wish On | Admin Panel</title>

<!--Css Start-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-grid.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-reboot.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/style.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/jquery.fancybox.min.css')}}" />
<!--Css End-->


</head>

<body class="bg-white">
    @include('web.layout.error')
<section class="popup view-popup">
  <div class="red-heading">
    <h4 class="p-2 text-uppercase">Add Driver</h4>
  </div>
<form method="POST" enctype="multipart/form-data" action="{{ route('EditCoupon',['id'=>$coupon->id])}}">
  @csrf
  <div class="col-md-12 text-left mt-4">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Name</td>
      <td><input type="text" value="{{ $coupon->name }}" name="name" placeholder="Driver Name" /></td>
      </tr>
      <tr>
        <td>Code</td>
        <td><input type="text" value="{{ $coupon->code }}"  name="code" placeholder="Phone No" /></td>
      </tr>
      <tr>
        <td>Coupon Value</td>
      <td><input type="number" value="{{ $coupon->coupon_value }}" name="coupon_value" placeholder="License Number" /></td>
      </tr>
      <tr>
          <td>Type</td>
          <td>
            <select name="type" required>
              <option value="percentage" {{ $coupon->type == 'percentage' ? "selected" : ""}}>Percentage</option>
              <option value="dollar" {{ $coupon->type == 'dollar' ? "selected" : ""}}>Dollar</option>
            </select>
          </td>
        </tr>
    </table>
    <div class="col-md-12 text-center mt-5"> <a href="" class="">
      <button type="submit" class="view-button">Edit Driver</button>  
    </div>
  </div>
</form>
</section>

</body>
</html>