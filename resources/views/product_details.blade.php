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
    <section class="pt-60px pb-0 md-pt-30px" >
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pe-50px md-pe-15px md-mb-40px">
                    <div class="row overflow-hidden position-relative">
                        <div class="col-12 col-lg-10 position-relative order-lg-2 product-image ps-30px md-ps-15px">
                            <div class="swiper product-image-slider" data-slider-options='{ "spaceBetween": 10, "loop": true, "autoplay": { "delay": 2000, "disableOnInteraction": false }, "watchOverflow": true, "navigation": { "nextEl": ".slider-product-next", "prevEl": ".slider-product-prev" }, "thumbs": { "swiper": { "el": ".product-image-thumb", "slidesPerView": "auto", "spaceBetween": 15, "direction": "vertical", "navigation": { "nextEl": ".swiper-thumb-next", "prevEl": ".swiper-thumb-prev" } } } }' data-thumb-slider-md-direction="horizontal">
                                <div class="swiper-wrapper">
                                    <!-- start slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                    <!-- end slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                    <!-- end slider item -->
                                    <div class="swiper-slide gallery-box">
                                        <a href="https://via.placeholder.com/600x765" data-group="lightbox-gallery" title="Relaxed corduroy shirt">
                                            <img class="w-100" src="https://via.placeholder.com/600x765" alt="">
                                        </a>
                                    </div>
                                    <!-- end slider item -->
                                </div>
                            </div> 
                        </div>
                        <div class="col-12 col-lg-2 order-lg-1 position-relative single-product-thumb">
                            <div class="swiper-container product-image-thumb slider-vertical">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                    <div class="swiper-slide"><img class="w-100" src="https://via.placeholder.com/600x765" alt=""></div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 product-info">
                    <span class="fw-500 text-dark-gray d-block">Zalando</span>
                    <h4 class="alt-font text-dark-gray fw-500 mb-5px">Relaxed corduroy shirt</h5>
                        <div class="d-block d-sm-flex align-items-center mb-15px">
                            <div class="me-10px xs-me-0">
                                <a href="#tab" class="section-link ls-minus-1px icon-small">
                                    <i class="bi bi-star-fill text-golden-yellow"></i>
                                    <i class="bi bi-star-fill text-golden-yellow"></i>
                                    <i class="bi bi-star-fill text-golden-yellow"></i>
                                    <i class="bi bi-star-fill text-golden-yellow"></i>
                                    <i class="bi bi-star-fill text-golden-yellow"></i>
                                </a>
                            </div>
                            <a href="#tab" class="me-25px text-dark-gray fw-500 section-link xs-me-0">165 Reviews</a>
                            <div><span class="text-dark-gray fw-500">SKU: </span>M492300</div>
                        </div>
                        <div class="product-price mb-10px">
                            <span class="text-dark-gray fs-28 xs-fs-24 fw-700 ls-minus-1px"><del class="text-medium-gray me-10px fw-400">$85.00</del>$65.00</span>
                        </div>
                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry lorem ipsum standard.</p>
                        <div class="d-flex align-items-center mb-20px">
                            <label class="text-dark-gray alt-font me-15px fw-500">Color</label>
                            <ul class="shop-color mb-0">
                                <li>
                                    <input class="d-none" type="radio" id="color-1" name="color" checked="">
                                    <label for="color-1"><span style="background-color: #D4AF37"></span></label>
                                </li>
                                <li>
                                    <input class="d-none" type="radio" id="color-2" name="color" checked="">
                                    <label for="color-2"><span style="background-color: #5881bf"></span></label>
                                </li>
                                <li>
                                    <input class="d-none" type="radio" id="color-3" name="color" checked="">
                                    <label for="color-3"><span style="background-color: #87a968"></span></label>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center mb-35px">
                            <label class="text-dark-gray me-15px fw-500">Size</label>
                            <ul class="shop-size mb-0">
                                <li>
                                    <input class="d-none" type="radio" id="size-1" name="size" checked="">
                                    <label for="size-1"><span>S</span></label>
                                </li>
                                <li>
                                    <input class="d-none" type="radio" id="size-2" name="size" checked="">
                                    <label for="size-2"><span>M</span></label>
                                </li>
                                <li>
                                    <input class="d-none" type="radio" id="size-3" name="size" checked="">
                                    <label for="size-3"><span>L</span></label>
                                </li>
                                <li>
                                    <input class="d-none" type="radio" id="size-4" name="size" checked="">
                                    <label for="size-4"><span>XL</span></label>
                                </li> 
                            </ul>
                        </div>
                        <div class="d-flex align-items-center flex-column flex-sm-row mb-20px position-relative">
                            <div class="quantity me-15px xs-mb-15px order-1">
                                <button type="button" class="qty-minus">-</button>
                                <input class="qty-text" type="text" id="1" value="1" aria-label="submit" />
                                <button type="button" class="qty-plus">+</button>
                            </div>
                            <a href="demo-fashion-store-cart.html" class="btn btn-cart btn-extra-large btn-switch-text btn-box-shadow btn-none-transform btn-dark-gray left-icon btn-round-edge border-0 me-15px xs-me-0 order-3 order-sm-2">
                                <span>
                                    <span><i class="feather icon-feather-shopping-bag"></i></span>
                                    <span class="btn-double-text ls-0px" data-text="Add to cart">Add to cart</span> 
                                </span>
                            </a>
                            <a href="#" class="wishlist d-flex align-items-center justify-content-center border border-radius-5px border-color-extra-medium-gray order-2 order-sm-3">
                                <i class="feather icon-feather-heart icon-small text-dark-gray"></i>
                            </a>
                        </div>
                        <div class="row mb-20px">
                            <div class="col-auto icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                                    <div class="feature-box-icon me-10px">  
                                        <i class="feather icon-feather-repeat align-middle text-dark-gray"></i>
                                    </div>
                                    <div class="feature-box-content">
                                        <a href="#" class="alt-font fw-500 text-dark-gray d-block">Compare</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                                    <div class="feature-box-icon me-10px">  
                                        <i class="feather icon-feather-mail align-middle text-dark-gray"></i>
                                    </div>
                                    <div class="feature-box-content">
                                        <a href="#" class="alt-font fw-500 text-dark-gray d-block">Ask a question</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                                    <div class="feature-box-icon me-10px">  
                                        <i class="feather icon-feather-share-2 align-middle text-dark-gray"></i>
                                    </div>
                                    <div class="feature-box-content">
                                        <a href="#" class="alt-font fw-500 text-dark-gray d-block">Share</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-20px h-1px w-100 bg-extra-medium-gray d-block"></div>
                        <div class="row mb-15px">
                            <div class="col-12 icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon d-inline-flex align-middle">
                                    <div class="feature-box-icon me-10px">  
                                        <i class="feather icon-feather-truck top-8px position-relative align-middle text-dark-gray"></i>
                                    </div>
                                    <div class="feature-box-content">
                                        <span><span class="alt-font text-dark-gray fw-500">Estimated delivery:</span> March 03 - March 07</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 icon-with-text-style-08 mb-10px">
                                <div class="feature-box feature-box-left-icon d-inline-flex align-middle">
                                    <div class="feature-box-icon me-10px">  
                                        <i class="feather icon-feather-archive top-8px position-relative align-middle text-dark-gray"></i>
                                    </div>
                                    <div class="feature-box-content">
                                        <span><span class="alt-font text-dark-gray fw-500">Free shipping & returns:</span> On all orders over $50</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-very-light-gray ps-30px pe-30px pt-25px pb-25px mb-20px xs-p-25px border-radius-4px">
                            <span class="alt-font fs-17 fw-500 text-dark-gray mb-15px d-block lh-initial">Guarantee safe and secure checkout</span>
                            <div>
                                <a href="#"><img src="images/visa.svg" class="h-30px me-5px mb-5px" alt=""></a>
                                <a href="#"><img src="images/mastercard.svg" class="h-30px me-5px mb-5px" alt=""></a>
                                <a href="#"><img src="images/american-express.svg" class="h-30px me-5px mb-5px" alt=""></a>
                                <a href="#"><img src="images/discover.svg" class="h-30px me-5px mb-5px" alt=""></a>
                                <a href="#"><img src="images/diners-club.svg" class="h-30px me-5px mb-5px" alt=""></a>
                                <a href="#"><img src="images/union-pay.svg" class="h-30px" alt=""></a>  
                            </div>
                        </div>
                        <div>
                            <div class="w-100 d-block"><span class="text-dark-gray alt-font fw-500">Category:</span> <a href="#">Fashion,</a> <a href="#">Woman</a></div>
                            <div><span class="text-dark-gray alt-font fw-500">Tags: </span><a href="#">Shirts,</a> <a href="#">Cotton,</a> <a href="#">Printed</a></div>
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