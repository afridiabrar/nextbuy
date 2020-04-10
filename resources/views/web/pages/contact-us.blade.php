@extends('web.layout.app')
@section('content')
    
<div class="main-wrapper">
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    @include('web.layout.error')
    <!-- Page Conttent -->
    <main class="page-content section-pb mt-30">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-infor">
                        <div class="contact-title">
                            <h3>CONTACT US</h3>
                        </div>
                        <div class="contact-dec">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam nam ex odio expedita, officia temporibus ipsum, placeat magni quibusdam sint, atque distinctio </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam nam ex odio expedita, officia temporibus ipsum, placeat magni quibusdam sint, atque distinctio </p>
                        </div>
                        <div class="contact-address">
                            <ul>
                                <li><i class="ion-android-pin"></i> Abcd Street, AR 72469, USA</li>
                                <li><i class="ionicons ion-ios-email"></i> info@yourwishon.com</li>
                                <li><i class="ion-android-call"></i> Hotline: + 123 456 789</li>
                            </ul>
                        </div>
                     
                    </div>
                </div>
                
                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form">
                        <div class="contact-form-info">
                            <div class="contact-title">
                                <h3>Send your comments</h3>
                            </div>
                        <form  action="{{ route('contactStore')}}" method="post">
                            @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        <?php $user = Auth::user() ?>
                                        <div class="contact-inner">
                                        <input name="name" value="{{ (!empty($user) && $user->is_admin == 0) ? $user->f_name : '' }}" type="text" placeholder="Name *">
                                        </div>
                                        <div class="contact-inner">
                                            <input name="email" value="{{ (!empty($user) && $user->is_admin == 0) ? $user->email : '' }}" type="email" placeholder="Email *">
                                        </div>
                                        <div class="contact-inner">
                                            <input name="phone_no" value="{{ (!empty($user) && $user->is_admin == 0) ? $user->phone_no : '' }}" type="number" placeholder="Phone *">
                                        </div>
                                        <div class="contact-inner contact-message">
                                            <textarea name="message" placeholder="Message *"></textarea>
                                        </div>
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button class="submit-btn" type="submit">Send Email</button>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mapouter mt-20"><div class="gmap_canvas"><iframe width="1140" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:400px;width:1140px;}.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:1140px;}</style></div>
            
        </div>
    </main>
    <!--// Page Conttent -->
</div>
@endsection

