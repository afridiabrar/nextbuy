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
                            <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active">Order Summary</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area end -->
        @include('web.layout.error')

        <!-- main-content-wrap start -->
        <div class="main-content-wrap section-pb checkout-page mt-30">
            <div class="container">
			<div class="col-12 row"><h4>Order Summary</h4></div>
			
			<div class="col-12 row">Complete/generate your shipping and payment details below</div>
                <!-- checkout-details-wrapper start -->
                <div class="checkout-details-wrapper mt-30">
                    <div class="row">
                    
                        @if($s_address != NULL)
					    <div class="col-lg-6 col-md-6">
                            <!-- your-order-wrapper start -->
                            <div class="your-order-wrapper">
                                <h3 class="shoping-checkboxt-title">Shipping & Billing Information</h3>
                                <!-- your-order-wrap start-->
                                <div class="your-order-wrap">
								<div class="row">
								<div class="col-lg-6 col-md-6 shipping-info">
								<p><strong>Name</strong></p>
								</div>
								<div class="col-lg-6 col-md-6 shipping-info">
								<p>{{ $s_address->first_name }} {{ $s_address->last_name }}</p>
								</div>
								</div>
								
		
								
								<div class="row mt-20">
								<div class="col-lg-6 col-md-6 shipping-info">
								<p><strong>Adress</strong></p>
								</div>
								<div class="col-lg-6 col-md-6 shipping-info">
								<p>{{ $s_address->address1 }}</p>
								</div>
                                </div>
                                <div class="row mt-20">
                                        <div class="col-lg-6 col-md-6 shipping-info">
                                        <p><strong>Adress 2</strong></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 shipping-info">
                                        <p>{{ $s_address->address2 }}</p>
                                        </div>
                                        </div>
                                        
								
								<div class="row mt-20">
								<div class="col-lg-6 col-md-6 shipping-info">
								<p><strong>City</strong></p>
								</div>
								<div class="col-lg-6 col-md-6 shipping-info">
								<p>{{ $s_address->city}}</p>
								</div>
								</div>
								
								<div class="row mt-20">
								<div class="col-lg-6 col-md-6 shipping-info">
								<p><strong>State</strong></p>
								</div>
								<div class="col-lg-6 col-md-6 shipping-info">
                                        <p>{{ $s_address->state}}</p>
								</div>
								</div>
								
								<div class="row mt-20">
								<div class="col-lg-6 col-md-6 shipping-info">
								<p><strong>ZIP</strong></p>
								</div>
								<div class="col-lg-6 col-md-6 shipping-info">
                                        <p>{{ $s_address->postcode}}</p>
								</div>
								</div>
								
                                </div>
								<div class="billing-details-wrap">
                                        <form action="{{ route('addAddress')}}" method="POST">
                                                @csrf
									<div class="col-lg-12 row mt-30">
                                            <div class="checkout-box-wrap">
                                                <label id="chekout-box-2"><input type="checkbox"> Ship to a different address?</label>
                                                <div class="ship-box-info">
                                                        <div class="row">
                                                                <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <p class="single-form-row">
                                                                                    <label>First Name<span class="required">*</span></label>
                                                                                    <input type="text" required placeholder="First Name" name="first_name">
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <p class="single-form-row">
                                                                                    <label>Last Name<span class="required">*</span></label>
                                                                                    <input type="text" required placeholder="Last Name" name="last_name">
                                                                                    </p>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-lg-12">
                                                                            <p class="single-form-row">
                                                                                <label>Street address 1<span class="required">*</span></label>
                                                                                <input type="text" required placeholder="House number and street name" name="address1">
                                                                            </p>
                                                                     </div>    
                                                                     <div class="col-lg-12">
                                                                            <p class="single-form-row">
                                                                                <label>Street address 2<span class="required">*</span></label>
                                                                                <input type="text" placeholder="House number and street name" name="address2">
                                                                            </p>
                                                                    </div>  
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <p class="single-form-row">
                                                                                    <label>Post Code<span class="required">*</span></label>
                                                                                    <input type="text" required placeholder="Postal Code" name="postcode">
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <p class="single-form-row">
                                                                                    <label>Town / City <span class="required">*</span></label>
                                                                                    <input type="text" required placeholder="Town / City" name="city">
                                                                                    </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="col-lg-12">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <p class="single-form-row">
                                                                                        <label>State<span class="required">*</span></label>
                                                                                        <input type="text" required placeholder="Postal Code" name="state">
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                <p class="single-form-row">
                                                                                        <label>Phone No <span class="required">*</span></label>
                                                                                        <input type="text" required placeholder="Phone No" name="phone">
                                                                                        </p>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-lg-12">
                                                                                <input type="submit" class="form-control my-btn" value="Save">
                                                                        </div>
        
                                                                        
                                                                                      
                                                         </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6 col-md-6">
                                <!-- your-order-wrapper start -->
                                <div class="your-order-wrapper">
                                    <h3 class="shoping-checkboxt-title">Shipping & Billing Information</h3>
                                    <!-- your-order-wrap start-->

                                    <div class="billing-details-wrap">
                                    <form action="{{ route('addAddress')}}" method="POST">
                                        @csrf
                                        <div class="col-lg-12 row mt-30">
                                                <div class="row">
                                                        <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="single-form-row">
                                                                            <label>First Name<span class="required">*</span></label>
                                                                            <input type="text" required placeholder="First Name" name="first_name">
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <p class="single-form-row">
                                                                            <label>Last Name<span class="required">*</span></label>
                                                                            <input type="text" required placeholder="Last Name" name="last_name">
                                                                            </p>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-12">
                                                                    <p class="single-form-row">
                                                                        <label>Street address 1<span class="required">*</span></label>
                                                                        <input type="text" required placeholder="House number and street name" name="address1">
                                                                    </p>
                                                             </div>    
                                                             <div class="col-lg-12">
                                                                    <p class="single-form-row">
                                                                        <label>Street address 2<span class="required">*</span></label>
                                                                        <input type="text" placeholder="House number and street name" name="address2">
                                                                    </p>
                                                            </div>  
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="single-form-row">
                                                                            <label>Post Code<span class="required">*</span></label>
                                                                            <input type="text" required placeholder="Postal Code" name="postcode">
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <p class="single-form-row">
                                                                            <label>Town / City <span class="required">*</span></label>
                                                                            <input type="text" required placeholder="Town / City" name="city">
                                                                            </p>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <p class="single-form-row">
                                                                                <label>State<span class="required">*</span></label>
                                                                                <input type="text" required placeholder="Postal Code" name="state">
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <p class="single-form-row">
                                                                                <label>Phone No <span class="required">*</span></label>
                                                                                <input type="text" required placeholder="Phone No" name="phone">
                                                                                </p>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-lg-12">
                                                                        <input type="submit" class="form-control my-btn" value="Save">
                                                                </div>

                                                                
                                                                              
                                                 </div>
                                        </div>
                                            
                                    </div>
                                    </form>
                                </div>
                            </div>
                        @endif
						
						<div class="col-lg-6 col-md-6">
                            <!-- billing-details-wrap start -->
                            <div class="billing-details-wrap">
                                <form>
                                    <h3 class="shoping-checkboxt-title">Payment Information</h3>
                                    <div class="container-fluid py-3">
    <div class="row">
        <div class="col-12">
            <div id="pay-invoice" class="card">
                <div class="card-body">
                    <form action="/echo" method="post" novalidate="novalidate" class="needs-validation">
                    
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">Name on card</label>
                            <input id="cc-name" name="cc-name" type="text" class="form-control cc-name" required autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="invalid-feedback">Enter the name as shown on credit card</span>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Card number</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" required="" pattern="[0-9]{16}">
                            <span class="invalid-feedback">Enter a valid 16 digit card number</span>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                    <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" required placeholder="MM / YY" autocomplete="cc-exp">
                                    <span class="invalid-feedback">Enter the expiration date</span>
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Pay ${{ $total}}.00</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                                        
                                    </div>
                                </form>
                            </div>
                            <!-- billing-details-wrap end -->
                        </div>
                    </div>
                </div>
                <!-- checkout-details-wrapper end -->
            </div>
        </div>
        <!-- main-content-wrap end -->






    </div>

    <script>
            var stripe = Stripe('pk_test_AbFzzp03LiiEuoiop3j84x0I00IyqZeygR');
        
            // Create an instance of Elements.
            var elements = stripe.elements();
        
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
        
            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
        
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
        
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
        
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
        
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
        
                // Submit the form
                form.submit();
            }
        </script>
@endsection
