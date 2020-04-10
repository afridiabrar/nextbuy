@extends('web.layout.app')
@section('content')
<style>
	.modal-dialog {    max-width: 500px;    margin: 1.75rem auto;}
	</style>
<div class="main-wrapper">
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Authencation</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pb lagin-and-register-page mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            <a data-toggle="tab" href="#lg2">
                                <h4> register </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        @include('web.layout.error')
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                    <form action="{{ route('login')}}" method="post">
                                        @csrf
                                            <div class="login-input-box">
                                                <input type="email" name="email" required placeholder="Enter Email">
                                                <input type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox">
                                                    <label>Remember me</label>
                                                    <a href="#" data-toggle="modal" data-target="#exampleModal">Forgot Password?</a>
                                                </div>
                                                <div class="button-box">
                                                    <button class="login-btn btn" type="submit"><span>Login</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                    <form action="{{ route('register')}}" method="post">
                                        @csrf
                                            <div class="login-input-box">
                                                <input type="text" required value="{{ old('f_name') }}"  name="f_name" placeholder="First Name">
                                                <input type="text" required value="{{ old('l_name') }}" name="l_name" placeholder="Last Name">
                                                <input type="text" required value="{{ old('phone_no') }}" name="phone_no" placeholder="Phone No">
                                                <input name="email" required placeholder="Email" type="email">
                                                <input type="password" required name="password" placeholder="Password">
                                                <input type="password" required name="confirm_password" placeholder="Confirm Password">
                                            </div>
                                            <div class="button-box">
                                                <button class="register-btn btn" type="submit"><span>Register</span></button>
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
    <!-- main-content-wrap end -->
</div>    


{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="{{ route('send_mail') }}" method="post">
            @csrf
        <div class="modal-body">          
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>

      </div>
    </div>
  </div>
  {{-- modal end --}}
<script>
    window.onload = function()
    {
        @if(Session::has('tab')) 
        $("a[href='#{{ Session::get('tab')}}']").click();
    @endif
    }
 </script>
@endsection
