@extends('web.layout.app')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Error 404</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main-content-wrap start -->
<div class="main-content-wrap section-pb wishlist-page mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="search-error-wrapper">
                    <h1>404</h1>
                    <h2>PAGE NOT BE FOUND</h2>
                    <p class="home-link">Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.</p>
                   
                    <a href="{{ route('index') }}" class="home-bacck-button">Back to home page</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->    
@endsection
