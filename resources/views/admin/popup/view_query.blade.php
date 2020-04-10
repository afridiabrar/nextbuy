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
</head>

<body class="bg-white">
<section class="popup view-popup">
  <div class="red-heading">
    <h4 class="p-2 text-uppercase">View queries</h4>
  </div>
  <div class="col-md-12 text-left">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
      <tr>
        <td>User&nbsp;Name</td>
        <td>{{ $query->name}}</td>
      </tr>
      <tr>
        <td>Email&nbsp;Email</td>
        <td>{{ $query->email}}</td>
      </tr>
      <tr>
        <td>Contact&nbsp;Number</td>
        <td>{{ $query->phone_no}}</td>
      </tr>
      <tr>
        <td>Massage</td>
        <td>{{ $query->message}}</td>
      </tr>
    </table>
  </div>
</section>
</body>
</html>