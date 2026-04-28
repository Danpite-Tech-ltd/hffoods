<style>
    .line {
        height: 5px;
        width: 30px;
        background-color: white;
        margin-bottom: 15px;

    }

    .info_text {
        color: white;
        font-size: 16px;
    }

    @media(min-width:770px){
        .col-md-25{
            flex: 0 0 auto;
            width: 20%;
        }
    }
    .lineb{
        margin: 10px 0;
    }
</style>
<style>
.subscribe-box {
    color: white;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    font-family: Arial, sans-serif;
}

.subscribe-box h3 {
    margin: 0 0 10px 0;
    font-size: 24px;
    color: white;
}

.subscribe-box p {
    margin: 0 0 15px 0;
    font-size: 14px;
    color: white;
}

.input-group {
    display: flex;
}

.input-group input {
    flex: 1;
    padding: 10px;
    border: 1px solid #fff;
    border-radius: 5px 0 0 5px;
    background-color: transparent;
    color: white;
    outline: none;
}

.input-group input::placeholder {
    color: #ccc;
}

.input-group button {
    padding: 7px 15px;
    border: 1px solid #fff;
    border-left: none;
    border-radius: 0 5px 5px 0;
    background-color: transparent;
    color: white;
    cursor: pointer;
}
input[type="email"]:focus{
    background:transparent;
}
</style>



<footer id="footer" class="p-0 footer color-bg">


    <div class="pt-4 footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3" id="left">
                    <div class="row">
                        <a target="_blank" href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset($basicinfo->page_image)); ?>" style="width:100%;border-radius:4px;">
                        </a>
                       <!--<div class="subscribe-box">-->
                       <!--     <h3>Subscribe</h3>-->
                       <!--     <p>Get 10% off your first order</p>-->
                       <!--     <div class="input-group">-->
                       <!--         <input type="email" placeholder="Enter your email">-->
                       <!--         <button type="submit">&#10148;</button>-->
                       <!--     </div>-->
                       <!-- </div>-->
                        <p class="text-white">Fresh, delicious food delivered to your doorstep.</p>
                        <div class="gap-3 d-flex ">
                            <a href="<?php echo e($basicinfo->facebook); ?>" target="_blank" class="text-white fs-6"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <!--<a href="<?php echo e($basicinfo->twitter); ?>" class="text-white-50 fs-5"><i class="fa-brands fa-twitter"></i></a>-->
                        <a href="<?php echo e($basicinfo->linkedin); ?>" target="_blank" class="text-white fs-6"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="tel:<?php echo e($basicinfo->phone_one); ?>" target="_blank" class="text-white fs-6"><i
                                class="fa-solid fa-phone"></i></a>
                        <a href="<?php echo e($basicinfo->youtube); ?>" target="_blank" class="text-white fs-6"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="mailto:<?php echo e($basicinfo->email); ?>" target="_blank" class="text-white fs-6"><i
                                class="fa-solid fa-envelope"></i></a>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $basicinfo->wp_1)); ?>" target="_blank"
                            class="text-white fs-6"><i class="fa-brands fa-whatsapp" style="font-size:16px"></i></a>
                        </div>
                    </div>

                </div>

                <div class="col-6 col-md-3" id="left">
                    <div class="module-heading">
                        <h4 class="module-title" style="border-bottom: 2px solid white;">Support</h4>
                        <!--<div class="line"></div>-->
                    </div>

                    <div class="module-body">
                        <ul class='list-unstyled' style="font-size: 14px;">
                            <li class="first"><a class="info_text" title="Your Account"
                                    ><?php echo e($basicinfo->address); ?></a></li>
                            <div class="lineb"></div>
                            <li class="first"><a class="info_text" title="Your Account"
                                    ><?php echo e($basicinfo->email); ?></a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text"
                                    ><?php echo e($basicinfo->phone_one); ?></a></li>
                            <div class="lineb"></div>

                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>

                <!-- /.col -->
                <div class="col-6 col-md-3" id="left">
                    <div class="module-heading">
                        <h4 class="module-title" style="border-bottom: 2px solid white;">Account</h4>
                        <!--<div class="line"></div>-->
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled' style="font-size: 14px;">
                            <li><a class="info_text" href="<?php echo e(url('/register')); ?>"
                                    title="Terms & Conditions">My Account</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('/login')); ?>"
                                    title="Terms & Conditions">Login / Register</a></li>
                            <div class="lineb"></div>
                            <!-- <li><a class="info_text" href="<?php echo e(url('/cart')); ?>"
                                    title="shipping policy">Cart</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('/wishlist')); ?>"
                                    title="shipping policy">Wishlist</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('/shop')); ?>"
                                    title="Terms & Conditions">shop</a></li>
                            <div class="lineb"></div> -->
                            <li><a class="info_text" href="<?php echo e(url('/track-order')); ?>"
                                    title="Terms & Conditions">Track Order</a></li>
                            <div class="lineb"></div>

                        </ul>
                    </div>


                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-6 col-md-3" id="left">
                    <div class="module-heading">
                        <h4 class="module-title" style="border-bottom: 2px solid white;">Quick Link</h4>
                        <!--<div class="line"></div>-->
                    </div>

                    <div class="module-body">
                        <ul class='list-unstyled' style="font-size: 14px;">
                            <li><a class="info_text" href="<?php echo e(url('venture/privacy_policy')); ?>"
                                    title="Terms & Conditions">Privacy Policy</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/refund_return_policy')); ?>"
                                    title="Terms & Conditions">Refund Return Policy</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/shipping_policy')); ?>"
                                    title="shipping policy">Shipping Policy</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/payment_policy')); ?>"
                                    title="shipping policy">Payment Policy</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/terms_codition')); ?>"
                                    title="Terms & Conditions">Terms of Use</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/contact_us')); ?>"
                                    title="Terms & Conditions">Contact</a></li>
                            <div class="lineb"></div>
                            <li><a class="info_text" href="<?php echo e(url('venture/faq')); ?>"
                                    title="Terms & Conditions">FAQ</a></li>
                            <div class="lineb"></div>

                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <div class="col-12 col-md-25 d-none" id="left">
                    <div class="module-heading">
                        <h4 class="text-white module-title fw-bold">Download App</h4>
                    </div>
                    <p class="text-white-50 small">Save $3 with App New User Only</p>

                    <div class="row g-2 align-items-start">
                        <!-- QR Code -->
                        <div class="col-auto">
                        <div class="p-2 bg-white rounded">
                            <img src="<?php echo e(asset('public/qr.png')); ?>" alt="QR Code" width="100" height="100">
                        </div>
                        </div>

                        <!-- Store Buttons -->
                        <div class="col">
                        <!-- Google Play -->
                        <a href="#" class="gap-2 p-2 mb-2 text-white border rounded d-flex align-items-center text-decoration-none border-secondary" style="background:#222;">
                            <img src="<?php echo e(asset('public/play_store.png')); ?>" alt="Google Play" width="26">
                            <div>
                            <div class="text-white-50" style="font-size:10px;">GET IT ON</div>
                            <div class="fw-semibold" style="font-size:14px;">Google Play</div>
                            </div>
                        </a>
                        <!-- App Store -->
                        <a href="#" class="gap-2 p-2 text-white border rounded d-flex align-items-center text-decoration-none border-secondary" style="background:#222;">
                            <img src="<?php echo e(asset('public/apple_store.png')); ?>" alt="App Store" width="26">
                            <div>
                            <div class="text-white-50" style="font-size:10px;">Download on the</div>
                            <div class="fw-semibold" style="font-size:14px;">App Store</div>
                            </div>
                        </a>
                        </div>
                    </div>

                    <!-- Social Icons -->
                    <div class="gap-3 pt-3 mt-3 d-flex ">
                        <a href="<?php echo e($basicinfo->facebook); ?>" target="_blank" class="text-white-50 fs-5"><i class="fa-brands fa-facebook-f"></i></a>
                        <!--<a href="<?php echo e($basicinfo->twitter); ?>" class="text-white-50 fs-5"><i class="fa-brands fa-twitter"></i></a>-->
                        <a href="<?php echo e($basicinfo->linkedin); ?>" target="_blank" class="text-white-50 fs-5"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?php echo e($basicinfo->email); ?>" target="_blank" class="text-white-50 fs-5"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>








            </div>
            <!-- <div class="container align-items-center">
                <img src="<?php echo e(asset('public/payment.webp')); ?>"/>
            </div> -->
            <div class="pt-3 pb-2 row">

                <div class="col-12">
                    <hr style="border:1px solid #212129;">
                    <div class="module-heading">
                        <p class="text-center" style="font-size: 12px;color:white">Copyright © 2025 -
                            <?php echo e(env('APP_NAME')); ?> | Developed by <a target="_blank" href="https://danpitetech.com/">Danpite Tech</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>


</footer>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/partials/footer.blade.php ENDPATH**/ ?>