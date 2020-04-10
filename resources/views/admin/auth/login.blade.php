<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Next Buy | Admin Panel</title>
<!--Css Start-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-grid.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-reboot.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/jquery.fancybox.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/style.css')}}"/>

<!--Css End-->

<!--JS Start-->
<script type="text/javascript" src="{{ asset('public/adminasset/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/bootstrap.bundle.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/jquery.fancybox.min.js')}}"></script>
<!--JS End-->
</head>

<body>
<div class="header-top"> <img style="width: 12%" src="{{ asset('public/adminasset/white.png')}}" width="auto" height="auto" alt="logo" /> </div>
<div class="header-text"> Admin Panel </div>
<div class="container mt-4">
        @include('web.layout.error')
  <div class="row pt-5">
    <div class="col-md-6 ">
      <div class="bordr-rite"></div>
      <img class="float-right mt-4 p-5" src="{{ asset('public/adminasset/192.png')}}" width="auto" alt="BigLogo" /> </div>
      <div class="col-md-6">
        <form method="post" action="{{ route('admin_login') }}">
                @csrf
      <div class="login-panel-rite">
        <h1>login</h1>
        <input class="user" type="email" name="email" placeholder="xyz@gmail.com" />
        <input class="pass" type="password" name="password" placeholder="*******" />
        <input style="margin-top:4px;" type="checkbox" name="remember_me" class="remember" />
        {{-- <span>Remember me</span> <a  data-fancybox="" data-type="iframe" data-src="" href="forget-pass.html" class="subpgpf fancybox.iframe">Fotget Password</a> --}}
        <button type="submit">Login</button>
      </div>
    </form>
    </div>
  </div>
</div>

</body>
</html>