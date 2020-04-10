
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
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pb my-account-page mt-30">
            @include('web.layout.error')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="account-dashboard">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <!-- Nav tabs -->
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Profile</a></li>
                                    <li><a href="#account-details" data-toggle="tab" class="nav-link">Edit Profile</a></li>
                                    <li><a href="#address" data-toggle="tab" class="nav-link">Change Password</a></li>
                                    <li><a href="login-register.html" class="nav-link">logout</a></li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-10">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane active" id="dashboard">
                                        <h3>Profile </h3>
                                        <div class="col-md-12 pb-30 text-center">
                                            <?php $img = (!empty($user->profile_pic)) ? $user->profile_pic  : 'public/assets/images/no-image.png' ?>
                                        <img style="height: 200px;width: 200px" src="{{ asset($img) }}" onerror="" alt="profile">
                                        <p class="">First Name<br> <strong>{{ $user->f_name }}</strong></p>
                                        <p class="">Last Name<br> <strong>{{ $user->l_name }}</strong></p>
                                        <p class="">Email<br> <strong>{{ $user->email }}</strong></p>
                                        <p class="">Gender<br> <strong>{{ ($user->gender) ? $user->gender : "Not Defined" }}</strong></p>
                                        <p class="">Contact<br> <strong>{{ $user->phone_no }}</strong></p>
                                        </div>
                                    </div>
                                
                                    <div class="tab-pane" id="address">
                                        <h3 class="billing-address">Change Password</h3>
                                    <form method="POST" action="{{ route('changePassword') }}">
                                            @csrf
                                       <div class="login-input-box col-md-12">
                                                <input type="password" name="old_password" placeholder="Old Password">
                                                <input type="password" name="password" placeholder="New Password">
                                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                                <div class="button-box pb-30">
                                                    <button class="btn default-btn" type="submit">Save</button>
                                                </div>
                                        </div> 
                                    </form>

                                    </div>
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Account details </h3>
                                        <div class="login">
                                            <div class="login-form-container">
                                                <div class="account-login-form">
                                                <form enctype="multipart/form-data" action="{{ route('UserUpdate')}}" method="POST">
                                                        @csrf
                                                        <div class="account-input-box">
                                                            <label> First Name</label>
                                                            <input type="text" value="{{ $user->f_name}}" name="f_name">
                                                            <label> Last Name</label>
                                                            <input type="text" value="{{ $user->l_name}}" name="l_name">
                                                            <label>Gender</label>
                                                            <select class="myn" name="gender" >
                                                                    <option selected>select Gender</option>
                                                                <option value="Male" {{($user->gender == 'Male' ? "selected" : "")}}>Male</option>
                                                                <option value="Female" {{($user->gender == 'Female' ? "selected" : "")}}>Female</option>
                                                                <option value="Other" {{($user->gender == 'Other' ? "selected" : "")}}>Other</option>
                                                            </select>                                                    
                                                            <label>Contact</label>
                                                            <input type="number" value="{{ $user->phone_no}}" name="phone_no">
                                                            <label>Image Upload</label>
                                                            <input type="file" name="image">
                                                        </div>
                                                        
                                                        
                                                        </div>
                                                        
                                                        <div class="button-box">
                                                            <button class="btn default-btn" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
</div>    
<script>
        window.onload = function()
        {
            @if(Session::has('tab')) 
            $("a[href='#{{ Session::get('tab')}}']").click();
        @endif
        }
     </script>
@endsection

