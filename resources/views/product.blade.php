@extends('layouts.master')
@section('content')
    <!-- start section -->
    <section class="top-space-margin half-section bg-gradient-very-light-gray">
        <div class="container">
            <div class="row align-items-center justify-content-center"
                data-anime='{ "el": "childs", "translateY": [-15, 0], "opacity": [0,1], "duration": 300, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>
                <div class="col-12 col-xl-8 col-lg-10 text-center position-relative page-title-extra-large">
                    <h1 class="alt-font fw-600 text-dark-gray mb-10px">Shop</h1>
                </div>
                <div class="col-12 breadcrumb breadcrumb-style-01 d-flex justify-content-center">
                    <ul>
                        <li><a href="demo-fashion-store.html">Home</a></li>
                        <li>Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <section class="pt-0 ps-6 pe-6 lg-ps-2 lg-pe-2 sm-ps-0 sm-pe-0">
        <div class="container-fluid">
            <div class="row">

                <div class="col-xxl-2 col-lg-3 shop-sidebar"
                    data-anime='{ "el": "childs", "translateY": [-15, 0], "opacity": [0,1], "duration": 300, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="mb-30px">
                        <span class="alt-font fw-500 fs-19 text-dark-gray d-block mb-10px">Filter by categories</span>
                        <ul class="shop-filter category-filter fs-16">
                            @foreach($categories as $category)
                                <li><a href="#" data-filter=".{{ strtolower($category->category) }}"><span
                                            class="product-cb product-category-cb"></span>{{ $category->category }}</a><span
                                        class="item-qty">{{ $products->where('category', $category->category)->count() }}</span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="mb-30px">
                        <span class="alt-font fw-500 fs-19 text-dark-gray d-block mb-10px">Filter by color</span>
                        <ul class="shop-filter color-filter fs-16">
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#232323"></span>Black</a><span class="item-qty">05</span>
                            </li>
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#5881bf"></span>Blue</a><span class="item-qty">24</span>
                            </li>
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#9f684f"></span>Brown</a><span class="item-qty">32</span>
                            </li>
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#87a968"></span>Green</a><span class="item-qty">22</span>
                            </li>
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#b14141"></span>Maroon</a><span class="item-qty">09</span>
                            </li>
                            <li><a href="#"><span class="product-cb product-color-cb"
                                        style="background-color:#d9653e"></span>Orange</a><span class="item-qty">06</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-30px">
                        <span class="alt-font fw-500 fs-19 text-dark-gray d-block mb-10px">Filter by size</span>
                        <ul class="shop-filter price-filter fs-16">
                            <li><a href="#"><span class="product-cb product-category-cb"></span>S</a><span
                                    class="item-qty">08</span></li>
                            <li><a href="#"><span class="product-cb product-category-cb"></span>M</a><span
                                    class="item-qty">05</span></li>
                            <li><a href="#"><span class="product-cb product-category-cb"></span>L</a><span
                                    class="item-qty">25</span></li>
                            <li><a href="#"><span class="product-cb product-category-cb"></span>XL</a><span
                                    class="item-qty">18</span></li>
                            <li><a href="#"><span class="product-cb product-category-cb"></span>XXL</a><span
                                    class="item-qty">36</span></li>
                        </ul>
                    </div>
                    <div class="mb-30px">
                        <div class="d-flex align-items-center mb-20px">
                            <span class="alt-font fw-500 fs-19 text-dark-gray">New arrivals</span>
                            <div class="d-flex ms-auto">
                                <!-- start slider navigation -->
                                <div
                                    class="slider-one-slide-prev-1 icon-very-small swiper-button-prev slider-navigation-style-08 me-5px">
                                    <i class="fa-solid fa-arrow-left text-dark-gray"></i>
                                </div>
                                <div
                                    class="slider-one-slide-next-1 icon-very-small swiper-button-next slider-navigation-style-08 ms-5px">
                                    <i class="fa-solid fa-arrow-right text-dark-gray"></i>
                                </div>
                                <!-- end slider navigation -->
                            </div>
                        </div>
                        <div class="swiper slider-one-slide"
                            data-slider-options='{ "slidesPerView": 1, "loop": true, "autoplay": { "delay": 5000, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
                            <div class="swiper-wrapper">
                                <!-- start text slider item -->
                                <div class="swiper-slide">
                                    <div class="shop-filter new-arribals">
                                        <div class="d-flex align-items-center mb-20px">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Textured
                                                    sweater</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$30.00</del>$23.00</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-20px">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Traveller
                                                    shirt</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$50.00</del>$43.00</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Crewneck
                                                    tshirt</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$20.00</del>$15.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end text slider item -->
                                <!-- start text slider item -->
                                <div class="swiper-slide">
                                    <div class="shop-filter new-arribals">
                                        <div class="d-flex align-items-center mb-20px">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Skinny
                                                    trousers</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$15.00</del>$10.00</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-20px">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Sleeve
                                                    sweater</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$35.00</del>$30.00</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <figure class="mb-0">
                                                <a href="demo-fashion-store-single-product.html">
                                                    <img class="border-radius-4px w-80px"
                                                        src="https://via.placeholder.com/600x765" alt="">
                                                </a>
                                            </figure>
                                            <div class="col ps-25px">
                                                <a href="demo-fashion-store-single-product.html"
                                                    class="text-dark-gray alt-font fw-500 d-inline-block lh-normal">Pocket
                                                    white</a>
                                                <div class="fs-15 lh-normal"><del class="me-5px">$20.00</del>$15.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end text slider item -->
                            </div>
                            <!-- start slider navigation -->
                        </div>
                    </div>
                    <div>
                        <span class="alt-font fw-500 fs-19 text-dark-gray d-block mb-10px">Filter by tags</span>
                        <div class="shop-filter tag-cloud fs-16">
                            <a href="#">Coats</a>
                            <a href="#">Cotton</a>
                            <a href="#">Dresses</a>
                            <a href="#">Jackets</a>
                            <a href="#">Polyester</a>
                            <a href="#">Printed</a>
                            <a href="#">Shirts</a>
                            <a href="#">Shorts</a>
                            <a href="#">Tops</a>
                        </div>
                    </div>
                </div>



                <div class="col-xxl-10 col-lg-9 ps-5 md-ps-15px md-mb-60px">
                    <ul class="shop-modern shop-wrapper grid-loading grid grid-4col xl-grid-3col sm-grid-2col xs-grid-1col gutter-extra-large text-center"
                        data-anime='{ "el": "childs", "translateY": [-15, 0], "opacity": [0,1], "duration": 300, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <li class="grid-sizer"></li>
                        @foreach($products as $product)
                            <li class="grid-item {{ strtolower($product->category) }}">
                                <div class="shop-box mb-10px">
                                    <div class="shop-image mb-20px">
                                        <a href="demo-fashion-store-single-product.html">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('images/placeholder.jpg') }}" alt="{{ $product->name }}">
                                            @endif
                                            <span class="lable new">New</span>
                                            <div class="shop-overlay bg-gradient-gray-light-dark-transparent"></div>
                                        </a>
                                        <div class="shop-buttons-wrap">
                                            <a href="{{ route('productDetails', $product->id) }}"
                                                class="alt-font btn btn-small btn-box-shadow btn-white btn-round-edge left-icon add-to-cart">
                                                <i class="feather icon-feather-shopping-bag"></i><span
                                                    class="quick-view-text button-text">Add to cart</span>
                                            </a>
                                        </div>
                                        <div class="shop-hover d-flex justify-content-center">
                                            <ul>
                                                <li>
                                                    <a href="#"
                                                        class="w-40px h-40px bg-white text-dark-gray d-flex align-items-center justify-content-center rounded-circle ms-5px me-5px"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Add to wishlist"><i
                                                            class="feather icon-feather-heart fs-16"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="w-40px h-40px bg-white text-dark-gray d-flex align-items-center justify-content-center rounded-circle ms-5px me-5px"
                                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Quick shop"><i
                                                            class="feather icon-feather-eye fs-16"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="shop-footer text-center">
                                        <a href="demo-fashion-store-single-product.html"
                                            class="alt-font text-dark-gray fs-19 fw-500">{{ $product->name }}</a>
                                        <div class="price lh-22 fs-16"><del>{{ $product->price }}</del>$189.00</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <!-- aa foreach no code barabar chale chhe -->
                    </ul>



                    <div class="w-100 d-flex mt-4 justify-content-center md-mt-30px">
                        <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="feather icon-feather-arrow-left fs-18 d-xs-none"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">01</a></li>
                            <li class="page-item active"><a class="page-link" href="#">02</a></li>
                            <li class="page-item"><a class="page-link" href="#">03</a></li>
                            <li class="page-item"><a class="page-link" href="#">04</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="feather icon-feather-arrow-right fs-18 d-xs-none"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            // Initialize Isotope
            var $grid = $('.shop-wrapper').isotope({
                itemSelector: '.grid-item',
                layoutMode: 'masonry',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                }
            });

            // Filter items on click
            $('.category-filter').on('click', 'a', function (e) {
                e.preventDefault();
                var filterValue = $(this).attr('data-filter');

                // Remove active class from all filters
                $('.category-filter a').removeClass('active');
                // Add active class to clicked filter
                $(this).addClass('active');

                // Filter items
                $grid.isotope({
                    filter: filterValue,
                    transitionDuration: '0.4s',
                    hiddenStyle: {
                        opacity: 0,
                        transform: 'scale(0.8)'
                    },
                    visibleStyle: {
                        opacity: 1,
                        transform: 'scale(1)'
                    }
                });
            });

            // Update category counts
            function updateCategoryCounts() {
                $('.category-filter a').each(function () {
                    var filterValue = $(this).attr('data-filter');
                    var count = filterValue === '*' ?
                        $('.grid-item').length :
                        $('.grid-item' + filterValue).length;
                    $(this).find('.item-qty').text(count);
                });
            }

            // Call update counts on page load
            updateCategoryCounts();

            // Price range slider
            $('.price-range-slider input[type="range"]').on('input', function () {
                var minPrice = parseInt($('.price-min').val());
                var maxPrice = parseInt($('.price-max').val());

                // Update price outputs
                $('.price-output input').first().val(minPrice);
                $('.price-output input').last().val(maxPrice);

                // Filter products by price
                $grid.isotope({
                    filter: function () {
                        var price = parseInt($(this).find('.price').text().replace('$', ''));
                        return price >= minPrice && price <= maxPrice;
                    }
                });
            });

            // Price input change
            $('.price-output input').on('change', function () {
                var minPrice = parseInt($('.price-output input').first().val());
                var maxPrice = parseInt($('.price-output input').last().val());

                // Update range sliders
                $('.price-min').val(minPrice);
                $('.price-max').val(maxPrice);

                // Filter products
                $grid.isotope({
                    filter: function () {
                        var price = parseInt($(this).find('.price').text().replace('$', ''));
                        return price >= minPrice && price <= maxPrice;
                    }
                });
            });
        });
    </script>
@endpush