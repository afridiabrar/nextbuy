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
<script type="text/javascript" src="https://cdnjs.com/libraries/popper.js "></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/bootstrap.bundle.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/adminasset/js/jquery.fancybox.min.js')}}"></script>


<!--JS End-->

</head>

<body>
<div class="header-top"> <img style="width: 12%;" src="{{ asset('public/adminasset/white.png')}}" width="auto" height="auto" alt="logo" /> </div>
<div class="header-text">Company Admin Panel</div>
<div class="sidebar">
  <div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true"> 
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('users') ? 'active' : '' }}" role="button" href="{{ route('users')}}">Users</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title">
             <a class="{{ Request::routeIs('view-category') ? 'active' : '' }}" role="button"
             href="{{ route('view-category')}}">categories</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title">
             <a class="{{ Request::routeIs('sub-category') ? 'active' : '' }}" role="button"
             href="{{ route('sub-category')}}">Sub Categories</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
        <h4 class="panel-title">
           <a class="{{ Request::routeIs('driver') ? 'active' : '' }}" role="button"
           href="{{ route('driver')}}">Driver</a>
          </h4>
      </div>
    </div>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title">
             <a class="{{ Request::routeIs('coupon') ? 'active' : '' }}" role="button"
             href="{{ route('coupon')}}">Coupon</a>
            </h4>
        </div>
      
    </div>
      <!---**** Panel-Default Close ****--->
          <!---**** Panel-Default Close ****--->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title">
             <a class="{{ Request::routeIs('banner') ? 'active' : '' }}" role="button"
             href="{{ route('banner')}}">Banner</a>
            </h4>
        </div>
      </div>
       <!---**** Panel-Default Close ****--->
      
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
        <h4 class="panel-title"> <a class="{{ Request::routeIs('media') ? 'active' : '' }}" role="button"
          href="{{ route('media')}}">Product Media</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****--->
      <!---**** Panel-Default Close ****--->
      
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
        <h4 class="panel-title"> <a class="{{ Request::routeIs('product') ? 'active' : '' }}" role="button"
          href="{{ route('product')}}">Product</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    
    {{-- <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
        <h4 class="panel-title"> <a  class="{{ Request::routeIs('payment') ? 'active' : '' }}" role="button" href="{{ route('payment')}}">payment</a> </h4>
      </div>
    </div> --}}
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('orders') ? 'active' : '' }}" role="button" href="{{ route('orders')}}">Orders</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('query') ? 'active' : '' }}" role="button" href="{{ route('query')}}">Queries</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('about-us') ? 'active' : '' }}" role="button" href="{{ route('about-us')}}">About Us</a> </h4>

      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('privacy-policy') ? 'active' : '' }}" role="button" href="{{ route('privacy-policy')}}">Privacy Policy</a> </h4>

      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
          <h4 class="panel-title"> <a  class="{{ Request::routeIs('terms') ? 'active' : '' }}" role="button" href="{{ route('terms')}}">Term & Condition</a> </h4>

      </div>
    </div>
    <!---**** Panel-Default Close ****--->
    
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title"> <a class="" role="button" href="{{ route('admin/logout')}}">Logout</a> </h4>
      </div>
    </div>
    <!---**** Panel-Default Close ****---> 
    
  </div>
  <!---**** AccordionMenu Close ****---> 
</div>
<!---**** Sidebar Close ****--->
@yield('content')
</body>
</html>