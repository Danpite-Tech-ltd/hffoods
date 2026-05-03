<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Campaign Offer</title>
    <link rel="stylesheet" href="<?php echo e(asset('public/webview/assets/css/landing.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .sale-discount-badge{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: absolute;
            right: 8px;
            top: 8px;
            background: red;
            padding: 2px 10px;
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    
    <section class="hero-section">
        <div class="container-fluid">
            <h2 class="landing-main-title">
                <?php echo e($campaign->name); ?>

            </h2>

            <p class="landing-sub-title"> <?php echo e($campaign->title); ?> </p>
            <div class="container">
                <div class="d-grid gap-2 p-3 text-center" style="background-color: #5a7a3a; grid-template-columns: repeat(3, 1fr);">

                    <div class="bg-white rounded-3 text-center py-3 px-1">
                        <div id="hours" class="fw-bold" style="font-size: clamp(1.5rem, 6vw, 3rem); color: #4a7c2f; line-height: 1;">00</div>
                        <div class="text-muted" style="font-size: clamp(10px, 2.5vw, 14px);">Hours</div>
                    </div>

                    <div class="bg-white rounded-3 text-center py-3 px-1">
                        <div id="minutes" class="fw-bold" style="font-size: clamp(1.5rem, 6vw, 3rem); color: #4a7c2f; line-height: 1;">00</div>
                        <div class="text-muted" style="font-size: clamp(10px, 2.5vw, 14px);">Minutes</div>
                    </div>

                    <div class="bg-white rounded-3 text-center py-3 px-1">
                        <div id="seconds" class="fw-bold" style="font-size: clamp(1.5rem, 6vw, 3rem); color: #4a7c2f; line-height: 1;">00</div>
                        <div class="text-muted" style="font-size: clamp(10px, 2.5vw, 14px);">Seconds</div>
                    </div>

                </div>
            </div>

            <p class="landing-sub-title"> <?php echo e($campaign->subtitle); ?> </p>

        </div>
    </section>
    
    
    <section class="py-4 landing-product-section">
        <div class="container">
            <iframe width="100%" class="video_height"
                src="https://www.youtube.com/embed/<?php echo e($campaign->price_title); ?>" 
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>

            <div class="mt-4 text-center">
                <a href="#order_form" class="landing-order-btn2">🛒 এখানে অর্ডার করুন </a>
            </div>
        </div>
    </section>
    
    
    <section class="product-details">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <img src="<?php echo e(asset($campaign->image)); ?>" class="w-100" style="border: 5px solid #fb862d;border-radius: 8px;">
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <?php echo $campaign->description; ?>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Middle -->
     <div style="background:#577735">
        <div class="container py-4">
            <h1 class="text-white text-center fw-bold">
                <?php echo e($campaign->oldprice_title); ?>

            </h1>

        </div>
     </div>
    <section class="product-details">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <img src="<?php echo e(asset($campaign->image2)); ?>" class="w-100" style="border: 5px solid #fb862d;border-radius: 8px;">
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <?php echo $campaign->why_choose; ?>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="mt-4 text-center">
        <a href="#order_form" class="landing-order-btn2">🛒 অর্ডার করতে চাই</a>
    </div>

    <div class="container my-4">
        <div class="py-3" style="background:#ee5c43; border-radius: 8px;">
            <h3 class="text-white text-center fw-bold m-0 review-title">
                আমাদের সম্মানিত কাস্টমারদের রিভিউ:
            </h3>
        </div>

        <?php
            $images = json_decode($campaign->review_images, true);
        ?>

        <div class="owl-carousel review-carousel mt-3">
            <?php if($images): ?>
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <img src="<?php echo e(asset($img)); ?>" alt="review image" style="width:100%; height:100%; object-fit:cover;border-radius: 8px;">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>


    </div>

    <div class="container mt-5">
        <div class="landing-emergency-contact">
            <h2>জরুরি প্রয়োজনে কল অথবা হোয়াটসঅ্যাপ করুন</h2>
            <div class="landing-emergency-info">
                <div class="mt-2 contact-row row g-3">

                    <!-- Phone -->
                    <div class="col-12 col-md-6">
                        <a href="tel:<?php echo e($basicinfo->phone_one); ?>" class="contact-box phone-box">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" width="20" height="20">
                                    <path
                                        d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.3 1.3.4 2.7.6 4.1.6.7 0 1.2.5 1.2 1.2V21c0 .7-.5 1.2-1.2 1.2C11.3 22.2 1.8 12.7 1.8 1.2 1.8.5 2.3 0 3 0h3.5c.7 0 1.2.5 1.2 1.2 0 1.4.2 2.8.6 4.1.1.4 0 .9-.3 1.2l-2.2 2.3z"
                                        fill="#fff" />
                                </svg>
                            </span>
                            <span class="text"><?php echo e($basicinfo->phone_one); ?></span>
                        </a>
                    </div>

                    <!-- WhatsApp -->
                    <div class="col-12 col-md-6">
                        <a href="https://wa.me/<?php echo e($basicinfo->wp_1); ?>" target="_blank" class="contact-box whatsapp-box">
                            <span class="icon">
                                <svg viewBox="0 0 32 32" width="20" height="20">
                                    <path fill="#fff"
                                        d="M16 .4C7.4.4.4 7.4.4 16c0 2.8.7 5.5 2.1 7.9L.2 31.8l8.1-2.1c2.3 1.3 4.9 2 7.7 2 8.6 0 15.6-7 15.6-15.6S24.6.4 16 .4zm0 28.5c-2.4 0-4.7-.6-6.7-1.8l-.5-.3-4.8 1.3 1.3-4.7-.3-.5C3.8 20.7 3.2 18.4 3.2 16 3.2 9.4 8.6 4 15.2 4S27.2 9.4 27.2 16 22.6 28.9 16 28.9zm6.3-9.3c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-1.7-.8-2.8-1.5-3.9-3.3-.3-.5.3-.5.8-1.6.1-.2.1-.4 0-.6-.1-.2-.7-1.6-1-2.2-.3-.6-.6-.5-.8-.5h-.7c-.2 0-.6.1-.9.4-.3.3-1.2 1.2-1.2 2.9s1.2 3.4 1.4 3.6c.2.2 2.4 3.7 5.9 5.2.8.3 1.4.5 1.9.6.8.3 1.6.2 2.2.1.7-.1 1.8-.7 2.1-1.3.3-.6.3-1.2.2-1.3-.1-.2-.3-.3-.6-.5z" />
                                </svg>
                            </span>
                            <span class="text">Whatsapp</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    
    <section id="order_form">
    <div class="container my-4">

        <form action="<?php echo e(route('campaign.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="product_id" id="form_product_id">
            <input type="hidden" name="product_name" id="form_product_name">
            <input type="hidden" name="color" id="form_color">
            <input type="hidden" name="size" id="form_size">
            <input type="hidden" name="qty" id="form_qty">
            <input type="hidden" name="price" id="form_price">
            <input type="hidden" name="shipping" id="form_shipping">
            <input type="hidden" name="total" id="form_total">

            <div class="landing-box">

                <h3 class="text-center fw-bold">অর্ডার করতে নিচের ফরমটি পূরণ করুন</h3>

                <!-- PRODUCT LIST -->
                <div class="mb-4 landing-product-list">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="landing-product-item">

                            <div class="landing-product-content">

                                <div class="landing-product-left">

                                    <input type="radio" name="product"
                                           value="<?php echo e($product->id); ?>"
                                           <?php echo e($key == 0 ? 'checked' : ''); ?>

                                           data-product='<?php echo json_encode($product, 15, 512) ?>'>

                                    <img src="<?php echo e(asset($product->ProductImage)); ?>">
                                    <span><?php echo e($product->ProductName); ?></span>

                                </div>

                                <div class="landing-qty">
                                    <button type="button" class="qty-minus">-</button>
                                    <span class="qty">1</span>
                                    <button type="button" class="qty-plus">+</button>
                                </div>
                                <div class="landing-price price-box">0৳</div>


                            </div>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="row">

                    <div class="col-lg-7">

                        <h5>Billing details</h5>

                        <input name="name" class="mb-2 form-control" placeholder="আপনার নাম *">
                        <input name="phone" class="mb-2 form-control" placeholder="আপনার ফোন নাম্বার *">
                        <textarea name="address" class="mb-3 form-control" placeholder="আপনার ঠিকানা *"></textarea>

                        <!-- COLOR -->
                        <div class="mb-3">
                            <label class="fw-bold d-block">কালার *</label>
                            <div id="color-list"></div>
                        </div>

                        <!-- SIZE -->
                        <div class="mb-3">
                            <label class="fw-bold d-block">সাইজ *</label>
                            <div id="size-list"></div>
                        </div>

                        <!-- SHIPPING -->
                        <div class="landing-shipping">

                            <label class="landing-ship-row">
                                <div>
                                    <input type="radio" name="ship"
                                           value="<?php echo e($basicinfo->inside_dhaka_charge); ?>"
                                           checked>
                                    <span>ঢাকার ভিতরে</span>
                                </div>
                                <span><?php echo e($basicinfo->inside_dhaka_charge); ?>৳</span>
                            </label>

                            <label class="landing-ship-row">
                                <div>
                                    <input type="radio" name="ship"
                                           value="<?php echo e($basicinfo->outside_dhaka_charge); ?>">
                                    <span>ঢাকার বাইরে</span>
                                </div>
                                <span><?php echo e($basicinfo->outside_dhaka_charge); ?>৳</span>
                            </label>

                        </div>

                    </div>

                    <!-- SUMMARY -->
                    <div class="col-lg-5">

                        <div class="landing-summary">

                            <h5>Your order</h5>

                            <div class="landing-summary-product d-flex justify-content-between align-items-center">

                                <div class="gap-2 d-flex align-items-center">
                                    <img id="summary-image" width="50" height="50" style="object-fit:cover;">
                                    <span id="summary-name"></span>
                                </div>

                                <span id="summary-price"></span>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span id="subtotal"></span>
                            </div>

                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span id="total"></span>
                            </div>

                            <div class="mt-3 landing-cash-box">
                                <strong>পণ্য হাতে পেয়ে পেমেন্ট করুন</strong><br>
                                কোনো Advance ছাড়াই অর্ডার করুন
                            </div>

                            <button class="landing-btn" id="order-btn" type="submit">
                                অর্ডার কনফার্ম করুন
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>
<!-- related products -->
 <section class="container">
     <h3>Related Products</h3>
    <div class="owl-carousel related-carousel mt-3">
        <?php $__currentLoopData = $mainproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $product_ids = json_decode($product->RelatedProductIds, true);

            $singleproduct = null;
            if (!empty($product_ids) && isset($product_ids[0])) {
                $singleproduct = App\Models\Product::find($product_ids[0]);
            }

            $size = App\Models\Size::where('product_id',$singleproduct->first()->id)->first();
        ?>
            <div class="item">
                <a href="<?php echo e(url('/view-product', $product->ProductSlug)); ?>" 
                style="text-decoration:none; color:inherit; display:block;">

                    <img class="product-img" src="<?php echo e(asset($product->ProductImage)); ?>" 
                        alt="related product image"
                        style="width:100%; height:100%; object-fit:cover; border-radius:8px;">

                    <p  style="margin-top:8px; margin-bottom: 0; font-size:16px; font-weight:500;">
                        <?php echo e($product->ProductName); ?>

                    </p>

                    <div style="margin-top:5px;">
                        <span style="color:#28a745; font-weight:bold;font-size:20px;">
                            <?php echo e($size->SalePrice ?? ''); ?>

                        </span>
                        <del style="color:#999; font-size:18px;">
                            <?php echo e($size->RegularPrice ?? ''); ?>

                        </del>
                    </div>

                </a>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<style>
    .product-img:hover {
        transform: scale(1.05);
        transition: 0.3s;
    }
</style>

<footer style="background:#0b0b0b; color:#ccc; padding:60px 0;">
    <div class="container">
        <div class="row">

            <!-- About -->
            <div class="col-md-5">
                <h4 style="color:#ffc107; font-weight:700;">আমাদের সম্পর্কে</h4>

                <p style="margin-top:15px; line-height:1.8;">
                    উত্তরবঙ্গের স্বাদ, সংস্কৃতি ও গ্রামীণ ঐতিহ্য সবার ঘরে পৌঁছে দিতে আমাদের উদ্যোগ – Aranno।
                    এখানে পাবেন উত্তরবঙ্গের বিভিন্ন অঞ্চলের প্রিমিয়াম পণ্য, মসলা ও কৃষিজাত দ্রব্য।
                </p>

                <!-- Social Icons -->
                <div style="margin-top:25px;">
                    <a href="<?php echo e($basicinfo->facebook); ?>" target="_blank" style="display:inline-block; width:45px; height:45px; line-height:45px; text-align:center; border-radius:50%; background:#1a1a1a; color:#fff; margin-right:10px;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?php echo e($basicinfo->linkedin); ?>" target="_blank" style="display:inline-block; width:45px; height:45px; line-height:45px; text-align:center; border-radius:50%; background:#1a1a1a; color:#fff; margin-right:10px;">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="<?php echo e($basicinfo->youtube); ?>" target="_blank" style="display:inline-block; width:45px; height:45px; line-height:45px; text-align:center; border-radius:50%; background:#1a1a1a; color:#fff;">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Contact -->
            <div class="col-md-4">
                <h4 style="color:#ffc107; font-weight:700;">যোগাযোগ করুন</h4>
                    <a href="tel:<?php echo e($basicinfo->phone_one); ?>" target="_blank" style="display:block; margin-top:15px; color:#ccc; text-decoration:none;">
                        <i class="fas fa-phone" style="margin-right:10px;"></i> ফোন: <?php echo e($basicinfo->phone_one); ?>

                    </a>

                    <a href="https://wa.me/88<?php echo e($basicinfo->wp_1); ?>" target="_blank" style="display:block; color:#ccc; text-decoration:none;">
                        <i class="fab fa-whatsapp" style="margin-right:10px;"></i> WhatsApp: <?php echo e($basicinfo->wp_1); ?>

                    </a>

                    <a href="mailto:<?php echo e($basicinfo->email); ?>" target="_blank" style="display:block; color:#ccc; text-decoration:none;">
                        <i class="fas fa-envelope" style="margin-right:10px;"></i> ইমেইল: <?php echo e($basicinfo->email); ?>

                    </a>
            </div>

            <!-- Right Side -->
            <div class="col-md-3 d-flex align-items-end justify-content-md-end mt-4 mt-md-0">
                <p style="font-size:14px; color:#aaa; text-align:right;">
                    © <?php echo e(env('APP_NAME')); ?> © 2025. All Rights Reserved.<br>
                    <span style="color:#ffc107;">Designed by <a href="https://danpitetech.com/" target="_blank">danpitetech.com</span>
                </p>
            </div>

        </div>
    </div>
</footer>



<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function(){
        $('.review-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive:{
                0:{ items:2 },
                600:{ items:2 },
                1000:{ items:3 }
            }
        });
    });
    $(document).ready(function(){
        $('.related-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive:{
                0:{ items:2 },
                600:{ items:2 },
                1000:{ items:4 }
            }
        });
    });
</script>
<!-- timer -->
<script>
    function pad(n) { return String(n).padStart(2, '0'); }
    function tick() {
    const now = new Date(), target = new Date();
    target.setHours(4, 0, 0, 0);
    if (now >= target) target.setDate(target.getDate() + 1);
    let diff = Math.floor((target - now) / 1000);
    const h = Math.floor(diff / 3600); diff %= 3600;
    const m = Math.floor(diff / 60), s = diff % 60;
    document.getElementById('hours').textContent = pad(h);
    document.getElementById('minutes').textContent = pad(m);
    document.getElementById('seconds').textContent = pad(s);
    }
    tick(); setInterval(tick, 1000);
</script>


<script>
    let selectedProduct = null;
    let selectedSize = null;
    let selectedColor = null;
    let qty = 1;

    function setInitialPrices() {
        document.querySelectorAll('.landing-product-item').forEach(item => {
            let radio = item.querySelector('input[name="product"]');
            let product = JSON.parse(radio.dataset.product);

            if (product.sizes.length > 0) {
                item.querySelector('.price-box').innerText =
                    product.sizes[0].SalePrice + '৳';
            }
        });
    }

    function setSummaryImage() {

        let img = "";

        if (selectedColor && selectedColor.Image) { img = selectedColor.Image; }
        else if (selectedProduct && selectedProduct.ProductImage)
        { img = selectedProduct.ProductImage; }

        if (!img) return;


        document.getElementById('summary-image').src = "<?php echo e(asset('')); ?>" + img;
    }

    function loadProduct(product) {

        selectedProduct = product;
        qty = 1;

        document.querySelectorAll('.landing-product-item').forEach(item => {
            let radio = item.querySelector('input[name="product"]');
            if (radio.checked) {
                item.querySelector('.qty').innerText = 1;
            }
        });

        let colorHtml = '';

        product.variants.forEach((v, i) => {
            colorHtml += `
                <label>
                    <input type="radio" name="color"
                        value="${v.color}"
                        ${i == 0 ? 'checked' : ''}
                        data-variant='${JSON.stringify(v)}'>
                    ${v.color}
                </label>
            `;
        });

        document.getElementById('color-list').innerHTML = colorHtml;
        selectedColor = product.variants[0];

        loadSizes(product);
    }

    function loadSizes(product) {

        let sizeHtml = '';

        product.sizes.forEach((s, i) => {
            sizeHtml += `
                <label>
                    <input type="radio" name="size"
                        value="${s.size}"
                        ${i == 0 ? 'checked' : ''}
                        data-size='${JSON.stringify(s)}'>
                    ${s.size}
                </label>
            `;
        });

        document.getElementById('size-list').innerHTML = sizeHtml;
        selectedSize = product.sizes[0];

        updateSummary();
    }

    /* UPDATE SUMMARY */
    function updateSummary() {

        let price = selectedSize.SalePrice;
        let shipping = document.querySelector('input[name="ship"]:checked').value;

        let subtotal = price * qty;
        let total = subtotal + parseInt(shipping);

        document.getElementById('summary-name').innerText =
            `${selectedProduct.ProductName} (${selectedColor.color}, ${selectedSize.size}) × ${qty}`;

        document.getElementById('summary-price').innerText = price + '৳';

        setSummaryImage();

        document.getElementById('subtotal').innerText = subtotal + '৳';
        document.getElementById('total').innerText = total + '৳';

        document.getElementById('order-btn').innerText =
            `অর্ডার কনফার্ম করুন ${total}৳`;

        document.getElementById('form_product_id').value = selectedProduct.id;
        document.getElementById('form_product_name').value = selectedProduct.ProductName;
        document.getElementById('form_color').value = selectedColor.color;
        document.getElementById('form_size').value = selectedSize.size;
        document.getElementById('form_qty').value = qty;
        document.getElementById('form_price').value = price;
        document.getElementById('form_shipping').value = shipping;
        document.getElementById('form_total').value = total;
    }

    document.addEventListener('DOMContentLoaded', function () {

        setInitialPrices();

        let firstProduct = document.querySelector('input[name="product"]:checked');
        if (firstProduct) {
            loadProduct(JSON.parse(firstProduct.dataset.product));
        }

    });

    document.querySelectorAll('input[name="product"]').forEach(el => {
        el.addEventListener('change', function () {
            loadProduct(JSON.parse(this.dataset.product));
        });
    });

    document.addEventListener('change', function (e) {
        if (e.target.name === 'size') {
            selectedSize = JSON.parse(e.target.dataset.size);

            document.getElementById('form_size').value = selectedSize.size;

            updateSummary();
        }
    });

    document.addEventListener('change', function (e) {
        if (e.target.name === 'color') {
            selectedColor = JSON.parse(e.target.dataset.variant);

            document.getElementById('form_color').value = selectedColor.color;

            updateSummary();
        }
    });

    document.querySelectorAll('input[name="ship"]').forEach(el => {
        el.addEventListener('change', updateSummary);
    });

    document.addEventListener('click', function (e) {

        if (e.target.classList.contains('qty-plus')) {
            let item = e.target.closest('.landing-product-item');
            let radio = item.querySelector('input[name="product"]');

            if (radio.checked) {
                qty++;
                item.querySelector('.qty').innerText = qty;
                updateSummary();
            }
        }

        if (e.target.classList.contains('qty-minus')) {
            let item = e.target.closest('.landing-product-item');
            let radio = item.querySelector('input[name="product"]');

            if (radio.checked && qty > 1) {
                qty--;
                item.querySelector('.qty').innerText = qty;
                updateSummary();
            }
        }

    });
</script>

</body>

</html>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/campaign/campaign.blade.php ENDPATH**/ ?>