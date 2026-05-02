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
        <div class="container">
            <h2 class="landing-main-title">
                <?php echo e($campaign->title); ?>

            </h2>

            <p class="landing-sub-title">২ বছর থেকে ৯ বছরের বাচ্চাদের জন্য (ছেলে এবং মেয়ে উভয়ই)</p>

            <a href="#order_form" class="landing-order-btn">🛒 অর্ডার করতে চাই</a>

            <div class="mt-4 row">
                <div class="mb-3 col-md-12">
                    <img src="<?php echo e(asset($campaign->image)); ?>" class="rounded img-fluid campaign-banner-img">
                </div>
            </div>

            <div class="price-section">
                <p class="campaign-old-price">পূর্বের মূল্য – <?php echo e($campaign->oldprice_title); ?></p>
                <p class="campaign-new-price">আজকের অফার মূল্য —
                    <span class="text-dark"><?php echo e($campaign->price_title); ?></span>
                </p>
            </div>
        </div>
    </section>
    
    
    <section class="py-4 landing-product-section">
        <div class="container">
            <div class="row g-3">
                
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-lg-4">
                        <div class="landing-product-card position-relative">
                            <div class="sale-discount-badge">
                                    <?php echo e(round((($value->sizes[0]->RegularPrice - $value->sizes[0]->SalePrice) / $value->sizes[0]->RegularPrice) * 100)); ?>% ছাড়
                                </div>
                            <img src="<?php echo e(asset($value->ProductImage)); ?>" class="rounded img-fluid" alt="">
                            <div>
                                <p style="font-size:20px;margin-bottom: 4px;text-align: left;color: #000;font-weight: bold;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo e($value->ProductName); ?></p>
                                <div style="font-size: 24px;color: #000;text-align: left;font-weight: bold;">
                                   ৳ <?php echo e(round($value->sizes[0]->SalePrice)); ?>

                                        <del style="font-size: 18px;color: #888;margin-left: 5px;">৳<?php echo e(round($value->sizes[0]->RegularPrice)); ?></del>
                                </div>
                            </div>
                            <div class="landing-productorder-btn">
                                <a class="btn w-100" href="#order_form">
                                    🛒 অর্ডার করতে চাই
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-4 text-center">
                <a href="#order_form" class="landing-order-btn2">🛒 অর্ডার করতে চাই</a>
            </div>
        </div>
    </section>
    
    
    <section class="product-details">
        <div class="container">
            <h2 class="landing-productdetails-title">আমাদের পণ্যের ডিটেইলস</h2>
            <span class="details-line"></span>
            <div class="mt-4">
                <div class="landing-product-description">
                    <?php echo $campaign->description; ?>

                </div>
            </div>
        </div>
    </section>
    <div class="mt-4 text-center">
        <a href="#order_form" class="landing-order-btn2">🛒 অর্ডার করতে চাই</a>
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