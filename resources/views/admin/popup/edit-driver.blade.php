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
<form method="POST" enctype="multipart/form-data" action="{{ route('EditDriver',['id'=>$driver->id])}}">
  @csrf
  <div class="col-md-12 text-left mt-4">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Name</td>
      <td><input type="text" value="{{ $driver->name }}" name="name" placeholder="Driver Name" /></td>
      </tr>
      <tr>
        <td>Phone No</td>
        <td><input type="number" value="{{ $driver->phone_no }}"  name="phone_no" placeholder="Phone No" /></td>
      </tr>
      <tr>
        <td>License Number</td>
      <td><input type="text" value="{{ $driver->driving_lic }}" name="driving_lic" placeholder="License Number" /></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" value="{{ $driver->email }}" name="email" placeholder="Email" /></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><input type="text" value="{{ $driver->Address }}" name="Address" placeholder="Address" /></td>
      </tr>
      <tr>
        <td>City</td>
        <td><input type="text" value="{{ $driver->city }}" name="city" placeholder="City" /></td>
      </tr>
      <tr>
        <td>Mobile No</td>
        <td><input type="text" value="{{ $driver->phone_no_2 }}" name="phone_no_2" placeholder="Phone No 2" /></td>
      </tr>
      <tr>
        <td>National Card Number</td>
        <td><input type="text" value="{{ $driver->identity }}" name="identity" placeholder="National Card Number" /></td>
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