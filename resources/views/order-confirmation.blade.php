@extends('layouts.master')

@section('content')

<!-- start section -->
<section class="top-space-margin half-section bg-gradient-very-light-gray">
    <div class="container">
        <div class="row align-items-center justify-content-center" data-anime='{ "el": "childs", "translateY": [-15, 0], "opacity": [0,1], "duration": 300, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
            <div class="col-12 col-xl-8 col-lg-10 text-center position-relative page-title-extra-large">
                <h1 class="alt-font fw-600 text-dark-gray mb-10px">Order Confirmation</h1> 
            </div>
            <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li> 
                    <li>Order Confirmation</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if(session('success'))
                <div class="alert alert-success p-40px lg-p-30px md-p-25px mb-50px">
                    <i class="feather icon-feather-check-circle text-success icon-medium me-10px"></i>
                    <span class="text-success alt-font fw-600">{{ session('success') }}</span>
                </div>
                @endif
                
                <div class="p-40px lg-p-30px md-p-25px bg-white border-radius-6px box-shadow-large mb-50px">
                    <span class="fs-26 alt-font fw-600 text-dark-gray mb-30px d-block">Thank you for your order!</span>
                    
                    <ul class="list-style-01">
                        <li class="position-relative border-bottom border-color-medium-gray padding-20px-bottom margin-20px-bottom">
                            <span class="text-extra-dark-gray alt-font fw-600">Order Number:</span>
                            <span class="ms-5px">{{ $order->id }}</span>
                        </li>
                        <li class="position-relative border-bottom border-color-medium-gray padding-20px-bottom margin-20px-bottom">
                            <span class="text-extra-dark-gray alt-font fw-600">Date:</span>
                            <span class="ms-5px">{{ $order->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="position-relative border-bottom border-color-medium-gray padding-20px-bottom margin-20px-bottom">
                            <span class="text-extra-dark-gray alt-font fw-600">Total:</span>
                            <span class="ms-5px">₹{{ $order->total }}</span>
                        </li>
                        <li class="position-relative">
                            <span class="text-extra-dark-gray alt-font fw-600">Payment Method:</span>
                            <span class="ms-5px">{{ ucfirst($order->payment_method) }}</span>
                        </li>
                    </ul>
                    
                    <div class="margin-5-rem-top xs-margin-4-rem-top">
                        <span class="fs-22 alt-font fw-600 text-dark-gray mb-30px d-block">Order details</span>
                        
                        <table class="w-100 total-price-table your-order-table">
                            <tbody>
                                <tr>
                                    <th class="w-60 lg-w-55 xs-w-50 fw-600 text-dark-gray alt-font">Product</th>
                                    <td class="fw-600 text-dark-gray alt-font text-end">Total</td>
                                </tr>
                                @foreach($order->items as $item)
                                <tr class="product">
                                    <td class="product-thumbnail">
                                        <span class="text-dark-gray fw-500 d-block lh-initial">{{ $item->product_name }} x {{ $item->quantity }}</span>
                                        @if($item->color)<span class="fs-14 d-block">Color: {{ $item->color }}</span>@endif
                                        @if($item->size)<span class="fs-14 d-block">Size: {{ $item->size }}</span>@endif
                                    </td>
                                    <td class="product-price text-end" data-title="Price">₹{{ $item->price * $item->quantity }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="w-50 fw-600 text-dark-gray alt-font">Subtotal</th>
                                    <td class="text-dark-gray fw-600 text-end">₹{{ $order->subtotal }}</td>
                                </tr>
                                <tr class="shipping">
                                    <th class="fw-600 text-dark-gray alt-font">Shipping</th>
                                    <td class="text-end" data-title="Shipping">₹{{ $order->shipping_cost }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-600 text-dark-gray alt-font">Tax</th>
                                    <td class="text-end" data-title="Tax">₹{{ $order->tax }}</td>
                                </tr>
                                <tr class="total-amount">
                                    <th class="fw-600 text-dark-gray alt-font">Total</th>
                                    <td class="text-end" data-title="Total">
                                        <h6 class="d-block fw-700 mb-0 text-dark-gray alt-font">₹{{ $order->total }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="margin-5-rem-top">
                        <a href="{{ route('home') }}" class="btn btn-dark-gray btn-medium btn-switch-text btn-round-edge w-100">
                            <span>
                                <span class="btn-double-text" data-text="Continue Shopping">Continue Shopping</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section --> 

@endsection 