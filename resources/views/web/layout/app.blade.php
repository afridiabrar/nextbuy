<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Your Wish On | Home Page</title>
<meta name="robots" content="noindex, follow" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/favicon.ico') }}">
<!-- CSS    ============================================ -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/vendor/bootstrap.min.css') }}">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/vendor/ionicons.min.css') }}">
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/plugins/slick.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/css/plugins/animation.css')}}">
<link rel="stylesheet" href="{{ asset('public/assets/css/plugins/jqueryui.min.css')}}">
<!-- Main Style CSS (Please use minify version for better website load performance) -->
<link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
<!--<link rel="stylesheet" href="assets/css/style.min.css">-->
</head>
<body>
    <header class="fl-header"> 
        <!-- Header Top Start -->
        <div class="header-top-area d-none d-lg-block">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="header-top-inner">
                  <div class="row">
                    <div class="col-lg-4 col-md-3">
                      <div class="social-top">
                        <ul>
                          <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                          <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                          <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                          <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-9">
                      <div class="top-info-wrap text-right">
                        <ul class="top-info">
                          <li><a href="#"><i class="ionicons ion-ios-email-outline"></i> info@yourwishon.com</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Header Top End --> 
        
        <!-- haeader bottom Start -->
        <div class="haeader-bottom-area">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-2 col-md-4 col-5">
              <div class="logo-area"> <a href="{{ route('index') }}"><img src="{{ asset('public/assets/images/logo/logo.png')}}" alt=""></a> </div>
              </div>
              <div class="col-lg-8 d-none d-lg-block">
                <div class="main-menu-area text-center"> 
                  <!--  Start Mainmenu Nav-->
                  <nav class="main-navigation">
                    <ul>
                    <li class="{{request()->is('index') ? 'active':''}}"><a href="{{ route('index')}}">Home</a></li>
                    <li class="{{request()->is('category') ? 'active':''}}"><a href="{{ route('category')}}">Categories</a></li>
                      <li class="{{request()->is('shop') ? 'active':''}}"><a href="{{ route('shop')}}">Shop </a></li>
                      <li class="{{request()->is('contact') ? 'active':''}}"><a href="{{ route('contact')}}">Contact</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-lg-2 col-md-8 col-7">
                <div class="right-blok-box d-flex">
                  @if(!empty(Auth::user()) && Auth::user()->is_admin == 0)
                  <div class="user-wrap"> <a href="#"><i class="ionicons ion-ios-contact-outline"></i></a>
                    <ul class="user-cart">
                      <li class="cart-item">
                          <?php $img = (Auth::user()->profile_pic) ? Auth::user()->profile_pic : 'public/assets/images/other/profile-img.jpg'   ?>

                      <div class="profile-image"> <a href="{{ route('account')}}"><img style="height: 100px;width: 100px;object-fit: contain" alt="" src="{{ asset($img)}}"></a> </div>
                      <div class="user-title"> <a href="{{ route('account')}}">
                          <h4>Edit Profile</h4>
                          </a> </div>
                        <div class="user-title"> <a href="{{ route('order')}}">
                          <h4>Order</h4>
                          </a> 
                        </div>
                        
                      </li>
                      <li class="mini-cart-btns">
                        <div class="cart-btns"> <a href="{{ route('logout')}}" style="width:100%;border-radius: 0px;">LOGOUT</a> </div>
                      </li>
                    </ul>
                  </div>
                  @else
                  <div class="user-wrap"> 
                  <a href="{{ route('authentication')}}"><i class="ionicons ion-ios-contact-outline"></i></a>
                  </div>
                  @endif
                  <?php $cart = \Cart::getContent(); 
                  $total = $cart->count();
                  $getTotal = Cart::getTotal();?>
                  <div class="shopping-cart-wrap"> <a href="#"><i class="ion-ios-cart-outline"></i> <span id="cart-total">{{$total}}</span></a>
                    <ul class="mini-cart">
                      @foreach ($cart as $item)    
                      <?php $img = ($item->attributes->image) ? $item->attributes->image : 'public/assets/images/product/product-01.jpg'?>

                      <li class="cart-item">
                      <div class="cart-image"> <a href="product-details.html">
                        <img alt="" style="height: 100px;width: 100px;object-fit: contain" src="{{ asset($img)}}"></a> 
                      </div>
                        <div class="cart-title"> <a href="product-details.html">
                          <h4>{{ $item->name }}</h4>
                          </a> <span class="quantity">1 ×</span>
                          <div class="price-box"><span class="new-price">${{ $item->price }}</span></div>
                          <a class="remove_from_cart" href="#"><i class="icon-trash icons"></i></a> </div>
                      </li>
                      @endforeach
                     
                      <li class="subtotal-titles">
                        <div class="subtotal-titles">
                          <h3>Sub-Total :</h3>
                          <span>$ {{$getTotal}}</span> </div>
                      </li>
                      <li class="mini-cart-btns">
                      <div class="cart-btns"> <a href="{{ route('cart')}}">View cart</a> 
                        <a href="{{ route('checkout')}}">Checkout</a>
                       </div>
                      </li>
                    </ul>
                  </div>
                  <div class="mobile-menu-btn d-block d-lg-none">
                    <div class="off-canvas-btn"> <i class="my-ctn ion-android-menu"></i> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class=" container">
                <form method="get" action="{{ route('search')}}">
            
              <div class="row">
                <div class="input-group col-md-9">
                  <input type="hidden" name="sortby" value="main_search" >
                  <input type="text" class="form-control" name="search" aria-label="Text input with segmented dropdown button" placeholder="What are you looking for...">
                  <a class="search-icon" href="#"><i class="ionicons ionicons ion-ios-eye-outline-strong"></i></a>
                  <div class="input-group-append">
                    {{-- <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All Categories </button>
                    <div class="dropdown-menu"> <a class="dropdown-item" href="#">Computer & Laptop</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Kitchen & Dining</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">jewellery</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Baby & Kids</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Office</a> </div> --}}
                      <select required class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" name="search_category">
                          <?php $cat = App\Category::get() ?>
                          @foreach ($cat as $item)
                          <option value="{{ $item->slug}}">{{ $item->name}}</option>
                              
                          @endforeach
                      </select>
                  </div>
                  <div class="">
                    <button type="submit" class="my-btn"><i class="ion-ios-search"></i></button>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="row">
                  <div class="col-md-3 text-center"><img src="{{ asset('public/assets/images/icon/support-icon.png')}}" alt=""></div>
                    <div class="col-md-9 text-left"style="line-height: 19px;">SUPPORT 24/7<br>
                      Hotline: +123 456 789</div>
                  </div>
                </div>
              </div>
                </form>
            </div>
          </div>
        </div>
        <!-- haeader bottom End --> 
        
        <!-- main-search start -->
        <div class="main-search-active">
          <div class="sidebar-search-icon">
            <button class="search-close"><span class="ion-android-close"></span></button>
          </div>
          <div class="sidebar-search-input">
            <form>
              <div class="form-search">
                <input id="search" class="input-text" value="" placeholder="Search entire store here ..." type="search">
                <button class="search-btn" type="button"> <i class="ionicons ion-ios-eye-outline"></i> </button>
                
              </div>
            </form>
          </div>
        </div>
        <!-- main-search start --> 
        
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
          <div class="off-canvas-overlay"></div>
          <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas"> <i class="ion-android-close"></i> </div>
            <div class="off-canvas-inner"> 
              
              <!-- mobile menu start -->
              <div class="mobile-navigation"> 
                
                <!-- mobile menu navigation start -->
                <nav>
                  <ul class="mobile-menu">
                    <li class="menu-item-has-children"><a href="#">Home</a></li>
                    <li class="menu-item-has-children "><a href="#">Categories</a></li>
                    <li class="menu-item-has-children "><a href="#">Shop</a></li>
                    <li><a href="contact-us.html">Contact</a></li>
                  </ul>
                </nav>
                <!-- mobile menu navigation end --> 
              </div>
              <!-- mobile menu end --> 
              
              <!-- offcanvas widget area start -->
              <div class="offcanvas-widget-area">
                <div class="off-canvas-contact-widget">
                  <ul>
                    <li> <a href="#"><i class="ionicons ion-ios-email-outline"></i> info@yourwishon.com</a> </li>
                  </ul>
                </div>
                <div class="off-canvas-social-widget"> <a href="#"><i class="ion-social-facebook"></i></a> <a href="#"><i class="ion-social-twitter"></i></a> <a href="#"><i class="ion-social-tumblr"></i></a> <a href="#"><i class="ion-social-googleplus"></i></a> </div>
              </div>
              <!-- offcanvas widget area end --> 
            </div>
          </div>
        </aside>
        <!-- off-canvas menu end --> 
        
      </header>

      @yield('content')


<footer>
  <div class="footer-top section-pb">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="widget-footer mt-30">
            <h6 class="title-widget">About Us</h6>
            <p>long established fact that a reader will be distracted by the readable content by the readable content established fact that</p>
          </div>
          <div class="col-md-12 row mt-20">
            <div class="social-top">
              <ul>
                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                <li><a href="#"><i class="ion-social-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="widget-footer mt-30">
            <h6 class="title-widget">Information</h6>
            <ul class="footer-list">
            <li><a href="{{ route('index') }}"><i class="ion-android-arrow-dropright"></i>Home</a></li>
              <li><a href="{{ route('category') }}"><i class="ion-android-arrow-dropright"></i>Categories</a></li>
              <li><a href="{{ route('shop') }}"><i class="ion-android-arrow-dropright"></i>Shop</a></li>
              <li><a href="{{ route('contact') }}"><i class="ion-android-arrow-dropright"></i>Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="widget-footer mt-30">
            <h6 class="title-widget">MY account</h6>
            <ul class="footer-list">
              <li><a href="{{ route('contact') }}"><i class="ion-android-arrow-dropright"></i>My Order</a></li>
            <li><a href="{{ route('authentication')}}"><i class="ion-android-arrow-dropright"></i>Login</a></li>
              <li><a href="{{ route('account') }}"><i class="ion-android-arrow-dropright"></i>Personal Info</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="widget-footer mt-30">
            <h6 class="title-widget">Customer</h6>
            <ul class="footer-list">
            <li><a href="{{ route('help')}}"><i class="ion-android-arrow-dropright"></i>Help & FAQ?</a></li>
            <li><a href="{{ route('term')}}"><i class="ion-android-arrow-dropright"></i>Term & Condition</a></li>
            <li><a href="{{ route('privacy')}}"><i class="ion-android-arrow-dropright"></i>Privacy Policy</a></li>
              {{-- <li><a href="order-summary.html"><i class="ion-android-arrow-dropright"></i>Shipping Info</a></li> --}}
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="widget-footer mt-30">
            <h6 class="title-widget">Store</h6>
            <ul class="footer-contact">
              <li><i class="ion-android-pin"></i> Abcd Street, AR 72469, USA</li>
              <li><i class="ion-android-call"></i> + 123 456 789</li>
            </ul>
          <div class="col-md-12 row mt-30"> <img src="{{ asset('public/assets/images/icon/v-card.png')}}" alt="cards"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="copy-right-text text-center">
            <p>Copyright &copy; <a href="#">Yourwishon</a> All Right Reserved</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- JS
============================================ --> 

<!-- Modernizer JS --> 
<script src="{{ asset('public/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script> 
<!-- jQuery JS --> 
<script src="{{ asset('public/assets/js/vendor/jquery-3.3.1.min.js')}}"></script> 
<!-- Bootstrap JS --> 
<script src="{{ asset('public/assets/js/vendor/popper.min.js')}}"></script> 
<script src="{{ asset('public/assets/js/vendor/bootstrap.min.js')}}"></script> 

<!-- Slick Slider JS --> 
<script src="{{ asset('public/assets/js/plugins/slick.min.js')}}"></script> 
<!--  Jquery ui JS --> 
<script src="{{ asset('public/assets/js/plugins/jqueryui.min.js')}}"></script> 
<!--  Scrollup JS --> 
<script src="{{ asset('public/assets/js/plugins/scrollup.min.js')}}"></script> 
<script src="{{ asset('public/assets/js/plugins/ajax-contact.js')}}"></script> 

<!-- Main JS --> 
<script src="{{ asset('public/assets/js/main.js')}}"></script>
</body>
</html>