
@extends('web.layout.app')
@section('content')
    
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Terms and Conditions</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Page Conttent -->
    <main class="page-content section-pb mt-30">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-infor">
                        <div class="contact-title">
                            <h3>Terms and Conditions</h3>
                        </div>
                        <div class="contact-dec">
                            <p>{{ $page->term_condition}}</p>
                        
                        
                        </div>
                       
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </main>
    <!--// Page Conttent -->
@endsection
