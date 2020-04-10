
@extends('web.layout.app')
@section('content')
    
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Thank You</li>
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
   <div class="container text-center">
   <h1>Thanks for your order!</h1>
   <p>Woot! You successfully made a payment with Strip.<p>
<p>We just sent your receipt to your email address, and your item will be on their way shortly.</p>
   </div>
   </main>
    <!--// Page Conttent -->

@endsection
