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
    <h4 class="p-2 text-uppercase">Add CSV Product</h4>
  </div>
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
  <div class="col-md-12 text-left mt-4">
    @csrf
    <table width="100%" border="0" cellspacing="0" cellpadding="0">    
      <tr>
        <td>Upload Csv</td>
        <td><input type="file" name="file" accept=".csv" class="form-control"></td>
      </tr>
    </table>
    <div class="col-md-12 text-center mt-5">
      <button class="view-button" type="submit">Add CSV</button>
     </div>
  </div>
</form>
</section>
</body>
</html>