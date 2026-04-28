<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>-Checkout
    <?php $__env->stopSection(); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #remqty {
            background: red;
            border-radius: 0;
            color: white;
            padding: 5px;
            line-height: 0px;
        }

        #addqty {
            background: green;
            border-radius: 0;
            color: white;
            padding: 5px;
            line-height: 0px;
        }

        #couponoption {
            display: none;
        }

        #coupontext {
            display: none;
        }

        #coupontext1 {
            display: none;
        }

        #cointext {
            display: none;
        }

        #cointext2 {
            display: none;
        }
    </style>

    <?php
        $availablecoup = App\Models\Coupon::where('status', 'Active')->where('validity', '>=', date('Y-m-d'))->first();
        $vat = App\Models\Basicinfo::first();
        $cities = App\Models\City::where('status', 'Active')->get();
    ?>

    
    <?php if(!Session::has('cart')): ?>
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="py-3 card mt-sm-3" style="min-height: 309px;">
                    <div class="text-center card-body">
                        <h2 class="pb-3 h4">কোন প্রোডাক্ট নেই</h2>
                        <a class="mt-3 btn btn-primary" href="<?php echo e(url('/')); ?>">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif(Cart::count() == 0): ?>
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="py-3 card mt-sm-3" style="min-height: 309px;">
                    <div class="text-center card-body">
                        <h2 class="pb-3 h4">কোন প্রোডাক্ট নেই</h2>
                        <a class="mt-3 btn btn-primary" href="<?php echo e(url('/')); ?>">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <br>
        <section class="section-content padding-y bg slidetop">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-6">
                        <aside class="mb-4 card">
                            <article class="card-body">
                                <h3 class="m-0 my-3 fw-semibold">Billing Details</h3>
                                <?php
                                    $coupon = Session::get('availablecoupon');
                                    $couponcode = Session::get('couponcode');
                                ?>
                                <form action="<?php echo e(url('press/order')); ?>" method="POST" class="from-prevent-multiple-submits">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Name * </label>
                                            <input type="text" id="customerName" name="customerName" <?php if(Auth::id()): ?>
                                            value="<?php echo e(Auth::guard('web')->user()->name); ?>" <?php else: ?> <?php endif; ?>
                                                placeholder="Enter your Name" required class="form-control"
                                                style="background:#f5f5f5;height:45px;box-shadow:none;border:none;margin-top:10px">
                                        </div>
                                        <?php if(Auth::id()): ?>
                                            <input type="text" id="user_id" name="user_id" <?php if(Auth::id()): ?>
                                            value="<?php echo e(Auth::guard('web')->user()->id); ?>" <?php else: ?> <?php endif; ?> hidden>
                                        <?php else: ?>
                                        <?php endif; ?>
                                        <input type="hidden" name="paymentType" value="" id="paymentType">
                                        <div class="form-group col-12">
                                            <label>Address * </label>
                                            <input type="text" id="customerAddress" name="customerAddress"
                                                placeholder="Enter your Address" required class="form-control" <?php if(Auth::id()): ?>
                                            value="<?php echo e(Auth::guard('web')->user()->address); ?>" <?php else: ?> <?php endif; ?>
                                                style="background:#f5f5f5;height:45px;box-shadow:none;border:none;margin-top:10px">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Phone Number *</label>
                                            <input type="text" minlength="11" maxlength="11" onchange="incorder()"
                                                pattern="[0-1]{2}[0-9]{6}[0-9]{3}" id="customerPhone" <?php if(Auth::id()): ?>
                                                value="<?php echo e(Auth::guard('web')->user()->phone); ?>" <?php else: ?> <?php endif; ?>
                                                name="customerPhone" required class="form-control"
                                                placeholder="Enter your Phone Number"
                                                style="background:#f5f5f5;height:45px;box-shadow:none;border:none;margin-top:10px">
                                        </div>
                                        <input type="hidden" name="coupon_code" <?php if(isset($couponcode)): ?>
                                        value="<?php echo e($couponcode); ?>" <?php else: ?> <?php endif; ?> id="coupon_code">
                                        <textarea id="ordersubtotalprice" name="subTotal" cols="10" rows="5"
                                            hidden><?php echo e(Cart::subtotalFloat()); ?></textarea>
                                        <div class="form-group col-12">
                                            <label class="my-3">Select your Delivery Area</label>
                                            <div class="d-flex flex-column">
                                                <?php if(isset($product->inside_dhaka) && isset($product->outside_dhaka)): ?>
                                                    <div class="mb-2 form-check d-flex align-items-center">
                                                        <input type="radio" class="form-check-input me-2" name="deliveryCharge"
                                                            id="insideDhaka" value="<?php echo e($product->inside_dhaka); ?>"
                                                            onchange="setdeliverychargr()" checked>
                                                        <label class="mb-0 form-check-label" for="insideDhaka"
                                                            style="margin-top: -14px;">
                                                            Inside Dhaka (<?php echo e($product->inside_dhaka); ?> TK)
                                                        </label>
                                                    </div>

                                                    <div class="mb-2 form-check d-flex align-items-center">
                                                        <input type="radio" class="form-check-input me-2" name="deliveryCharge"
                                                            id="outsideDhaka" value="<?php echo e($product->outside_dhaka); ?>"
                                                            onchange="setdeliverychargr()">
                                                        <label class="mb-0 form-check-label" for="outsideDhaka"
                                                            style="margin-top: -14px;">
                                                            Outside Dhaka (<?php echo e($product->outside_dhaka); ?> TK)
                                                        </label>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="mb-2 form-check d-flex align-items-center">
                                                        <input type="radio" class="form-check-input me-2" name="deliveryCharge"
                                                            id="insideDhaka"
                                                            value="<?php echo e(App\Models\Basicinfo::first()->inside_dhaka_charge); ?>"
                                                            onchange="setdeliverychargr()" checked>
                                                        <label class="mb-0 form-check-label" for="insideDhaka"
                                                            style="margin-top: -14px;">
                                                            Inside Dhaka (<?php echo e(App\Models\Basicinfo::first()->inside_dhaka_charge); ?>

                                                            TK)
                                                        </label>
                                                    </div>

                                                    <div class="mb-2 form-check d-flex align-items-center">
                                                        <input type="radio" class="form-check-input me-2" name="deliveryCharge"
                                                            id="subDhaka"
                                                            value="<?php echo e(App\Models\Basicinfo::first()->sub_dhaka_charge); ?>"
                                                            onchange="setdeliverychargr()">
                                                        <label class="mb-0 form-check-label" for="subDhaka"
                                                            style="margin-top: -14px;">
                                                            Dhaka Sub Area (<?php echo e(App\Models\Basicinfo::first()->sub_dhaka_charge); ?>

                                                            TK)
                                                        </label>
                                                    </div>

                                                    <div class="mb-2 form-check d-flex align-items-center">
                                                        <input type="radio" class="form-check-input me-2" name="deliveryCharge"
                                                            id="outsideDhaka"
                                                            value="<?php echo e(App\Models\Basicinfo::first()->outside_dhaka_charge); ?>"
                                                            onchange="setdeliverychargr()">
                                                        <label class="mb-0 form-check-label" for="outsideDhaka"
                                                            style="margin-top: -14px;">
                                                            Outside Dhaka (<?php echo e(App\Models\Basicinfo::first()->outside_dhaka_charge); ?>

                                                            TK)
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="my-2">Note:</label>
                                            <textarea class="form-control" id="customerNote" name="customerNote"
                                                rows="2"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" id="orderConfirm"
                                                class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                                style="background:#db4444;color:white;font-size:22px !important;width:100%;border-radius:4px;">
                                                <i class="spinner fa fa-spinner fa-spin"></i> Confirm Order
                                            </button>
                                        </div>

                                        <div class="pb-4 text-center section-tab check-mark-tab d-none" id="paysection">
                                            <ul class="m-0 nav nav-tabs justify-content-between" id="myTab" role="tablist">
                                                <li class="nav-item d-none">
                                                    <a class="nav-link" id="coin-tab" data-bs-toggle="tab" href="#coin"
                                                        onclick="showbtn('orderConfirmCoin')" role="tab" aria-controls="coin"
                                                        style="    padding: 8px;" aria-selected="true">
                                                        <img src="<?php echo e(asset('public/coin.png')); ?>" style="width: 65px;" alt="">
                                                        <span class="pt-2 d-block">Useing Coin</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" onclick="showbtn('orderConfirm')"
                                                        id="credit-card-tab" style="padding: 8px;" data-bs-toggle="tab"
                                                        href="#credit-card" role="tab" aria-controls="credit-card"
                                                        aria-selected="false">
                                                        <img src="<?php echo e(asset('public/cod.png')); ?>" style="width: 65px;" alt="">
                                                        <span class="pt-2 d-block">Cash on Delivery</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" onclick="showbtn('sslczPayBtn')" id="paypal-tab"
                                                        data-bs-toggle="tab" href="#paypal" role="tab" aria-controls="paypal"
                                                        style="    padding: 8px;" aria-selected="true">
                                                        <img src="<?php echo e(asset('public/sslcommerz.png')); ?>" style="width: 65px;"
                                                            alt="">
                                                        <span class="pt-2 d-block">Online Pay</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- end section-tab -->
                                    </div>

                                    <div class="row d-none">
                                        <div class="text-center col-12">
                                            <div class="tab-pane fade" id="coin" role="tabpanel" aria-labelledby="coin-tab">
                                                <?php if(Auth::id()): ?>
                                                    <?php if(Auth::user()->available_coin > 0): ?>
                                                        <div class="mb-3 d-flex">
                                                            <i class="fas fa-check-circle"
                                                                style="font-size: 22px;margin-top: 3px; margin-right: 8px; color: green;"></i>
                                                            <label style="font-size: 20px;"> You have <span
                                                                    style="color: green;font-weight:bold"
                                                                    id="totalcoin"><?php echo e(Auth::user()->available_coin); ?></span>
                                                                coin for purchese product.</label>
                                                        </div>
                                                        <button type="submit" id="orderConfirmCoin"
                                                            class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                                            style="background:green;color:white;font-size:22px !important;width:100%;border-radius:4px;">
                                                            <i class="spinner fa fa-spinner fa-spin"></i> Confirm Order
                                                        </button>
                                                    <?php else: ?>
                                                        <div class="mb-3 d-flex">
                                                            <i class="fas fa-check-circle"
                                                                style="font-size: 22px;margin-top: 3px; margin-right: 8px; color: gray;"></i>
                                                            <label style="font-size: 20px;color:gray"> You have <span
                                                                    style="color: gray;font-weight:bold"
                                                                    id="totalcoin"><?php echo e(Auth::user()->available_coin); ?></span>
                                                                coin for purchese product.</label>
                                                        </div>
                                                        <button type="submit" id="orderConfirmCoin" disabled
                                                            class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                                            style="background:green;color:white;font-size:22px !important;width:100%;border-radius:4px;">
                                                            <i class="spinner fa fa-spinner fa-spin"></i> Confirm Order
                                                        </button>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                <?php endif; ?>

                                            </div><!-- end tab-pane-->
                                            <div class="tab-pane fade show active" id="credit-card" role="tabpanel"
                                                aria-labelledby="credit-card-tab">
                                                <button type="submit" id="orderConfirm"
                                                    class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                                    style="background:green;color:white;font-size:22px !important;width:100%;border-radius:4px;">
                                                    <i class="spinner fa fa-spinner fa-spin"></i> Confirm Order
                                                </button>
                                            </div><!-- end tab-pane-->

                                            <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                                                <div class="contact-form-action">
                                                    <div class="row">

                                                        <div class="col-lg-12">
                                                            <div class="text-center btn-box">
                                                                <button id="sslczPayBtn"
                                                                    style="background: green; color: white; width: 100%; font-size: 22px !important; display: inline;"
                                                                    token="if you have any token validation"
                                                                    postdata="your javascript arrays or objects which requires in backend"
                                                                    order="If you already have the transaction generated for current order"
                                                                    endpoint="<?php echo e(url('/pay-via-ajax')); ?>"> Pay & Confirm
                                                                    Order
                                                                </button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div>
                                                </div><!-- end contact-form-action -->
                                            </div><!-- end tab-pane-->
                                        </div>
                                    </div>
                                </form>
                            </article> <!-- card-body.// -->
                        </aside>
                    </div>
                    <div class="col-md-6 orderDetails">
                        <aside class="card">
                            <article class="card-body">
                                <header class="mb-2">
                                    <h4 class="card-title" style="font-size: 16px;margin: 0;font-weight: bold;">Order
                                        Summary </h4>
                                </header>
                                <div class="row">
                                    <table class="table border-bottom" style="border: none;">
                                        <?php $__empty_1 = true; $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="cart-item" id="productcart<?php echo e($cartProduct->rowId); ?>">
                                                <td class="product-image" id="proImgDiv">
                                                    <a href="#" class="mr-3">
                                                        <img class=" ls-is-cached lazyloaded" src="<?php echo e(asset($cartProduct->image)); ?>"
                                                            id="proImg">
                                                    </a>
                                                </td>

                                                <td class="product-total" style="width: 80px;" hidden>
                                                    <span>৳ <span id="pricetotal<?php echo e($cartProduct->rowId); ?>"
                                                            class="price"><?php echo e($cartProduct->qty * $cartProduct->price); ?></span></span>
                                                </td>

                                                <td class="product-name">
                                                    <span class="pr-4 d-block w-100" id="proName"><?php echo e($cartProduct->name); ?></span>
                                                    <div class="ext w-100">
                                                        <div class="price">

                                                            <span class="pt-0 pr-3 my-2 d-block" id="proPrice"> <small
                                                                    style="color: #000000;font-size: 14px;">
                                                                    <?php if(isset($cartProduct->options['size'])): ?>
                                                                        Size : <?php echo e($cartProduct->options['size']); ?>,&nbsp;
                                                                    <?php endif; ?>
                                                                    <?php if(isset($cartProduct->options['size'])): ?>
                                                                        Color : <?php echo e($cartProduct->options['color']); ?>,&nbsp;
                                                                    <?php endif; ?>
                                                                    <?php if(isset($cartProduct->options['sigment'])): ?>
                                                                        Sigment : <?php echo e($cartProduct->options['sigment']); ?>

                                                                    <?php endif; ?>
                                                                </small></span>
                                                        </div>
                                                        <div class="qtyinfo">
                                                            <div class="pr-4 input-group input-group--style-2 quantity_width_checkout">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number"
                                                                        onclick="remnum('<?php echo e($cartProduct->rowId); ?>')" id="remqty"
                                                                        type="button">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="text" name="quantity[<?php echo e($cartProduct->id); ?>]"
                                                                    id="QuantityPeo<?php echo e($cartProduct->rowId); ?>"
                                                                    class="form-control input-number" placeholder="1"
                                                                    value="<?php echo e($cartProduct->qty); ?>" min="1" max="10"
                                                                    style="margin: 0;height: 27px;color:#000"
                                                                    onchange="updateQuantity('<?php echo e($cartProduct->rowId); ?>', this)">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number"
                                                                        onclick="updatenum('<?php echo e($cartProduct->rowId); ?>')" id="addqty"
                                                                        type="button">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            <a type="button" id="proDelCart"
                                                                style="width: 30px;font-size: 18px;color:black;margin-top: 2px;"
                                                                onclick="removeFromCart('<?php echo e($cartProduct->rowId); ?>')"
                                                                class="pl-4 text-right">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="text-right d-block" id="proPrice">৳
                                                        <?php echo e($cartProduct->price); ?></span></td>
                                                <input type="text" name="productP" id="priceOf<?php echo e($cartProduct->rowId); ?>"
                                                    value="<?php echo e($cartProduct->price); ?>" hidden>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </table>

                                    <?php if(Auth::id() && isset($availablecoup)): ?>
                                        <div class="d-flex">
                                            <input style="margin: 0;width: 20px;" <?php if(isset($coupon)): ?> checked value="No" <?php else: ?>
                                            value="Yes" <?php endif; ?> type="checkbox" id="havecoupon" name="havecoupon"
                                                onclick="havecoupon();">
                                            <label for="havecoupon" style="font-size: 20px;"> Have
                                                coupon ?</label>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </article>

                            <input type="text" name="size" value="<?php echo e($cartProduct->options->size); ?>" hidden>
                            <input type="text" name="color" value="<?php echo e($cartProduct->options->color); ?>" hidden>

                            <article class="card-body" style="margin-top: -35px">
                                <dl class="row">
                                    <dt class="col-8">Subtotal: </dt>
                                    <dd class="text-right col-4"><strong>৳ <span
                                                id="subtotalprice"><?php echo e(Cart::subtotalFloat()); ?></span> </strong></dd>

                                    <dt class="col-8">Delivery charge: </dt>

                                    <dd class="text-right col-4 text-danger"><strong>৳
                                            <?php if(isset($product->inside_dhaka)): ?>
                                                <span id="dinamicdalivery"><?php echo e($product->inside_dhaka); ?></span>
                                            <?php else: ?>
                                                <span
                                                    id="dinamicdalivery"><?php echo e(App\Models\Basicinfo::first()->inside_dhaka_charge); ?></span>
                                            <?php endif; ?>
                                        </strong></dd>
                                    <?php if(isset($coupon)): ?>
                                        <dt class="col-8" style="color: green">Coupon Discount: </dt>
                                        <?php if($coupon->type == 'Amount'): ?>
                                            <dd class="text-right col-4" style="color: green"><strong>৳
                                                    <span id="coupondiscount" style="color: green"><?php echo e($coupon->amount); ?></span>
                                                </strong></dd>
                                        <?php else: ?>
                                            <dd class="text-right col-4" style="color: green"><strong>
                                                    <span id="coupondiscount" style="color: green">৳
                                                    </span>
                                                </strong><?php echo e(intval(Cart::subtotalFloat() * ($coupon->amount / 100))); ?></dd>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <dt class="col-8" style="color: green" id="coupontext1">Coupon Discount: </dt>
                                        <dd class="text-right col-4" id="coupontext" style="color: green"><strong>৳
                                                <span id="coupondiscount" style="color: green">0
                                                </span>
                                            </strong></dd>
                                    <?php endif; ?>

                                    <dt class="col-8" id="cointext">Coin Use: </dt>
                                    <dd class="text-right col-4" id="cointext2"><strong>৳ <span id="coinuse">0</span>
                                        </strong></dd>

                                    <?php if($vat->vat_status == 'On'): ?>
                                        <dt class="col-8">Vat:</dt>
                                        <dd class="text-right col-4"><strong class="h5 text-dark">৳
                                                <span><?php echo e(intval(Cart::subtotalFloat() * ($vat->vat / 100))); ?></span></strong>
                                        </dd>
                                        <input type="hidden" id="vatamount"
                                            value="<?php echo e(intval(Cart::subtotalFloat() * ($vat->vat / 100))); ?>">
                                    <?php else: ?>
                                        <dt class="col-8" style="display:none">Vat:</dt>
                                        <dd class="text-right col-4" style="display:none"><strong class="h5 text-dark">৳
                                                <span>0</span></strong></dd>
                                        <input type="hidden" id="vatamount" value="0">
                                    <?php endif; ?>
                                    <dt class="col-8">Total:</dt>
                                    <dd class="text-right col-4"><strong class="h5 text-dark">৳ <span
                                                id="totalamount"></span></strong></dd>
                                </dl>

                            </article>
                            <div class="border-top"></div>
                            <div id="couponoption" style="display:inline-block !important;margin-top:15px" class="container">
                                <div class="d-flex">
                                    <input type="text" name="couponcode" <?php if(isset($coupon)): ?> value="<?php echo e($coupon->code); ?>" <?php endif; ?>
                                        id="couponcode" class="form-control" placeholder="Coupon Code"
                                        style="border-radius: 6px; width: 60%; margin-right: 5px;height:48px;border:1px solid #000">
                                    <button class="btn btn-sm"
                                        style="background:#db4444;font-size: 18px; color: white; width: 40%;padding:10px 0"
                                        onclick="applycoupon()">Apply Coupon</button>
                                </div>
                            </div>


                        </aside>
                    </div>

                </div>
            </div>
        </section>
        <br>
    <?php endif; ?>



    <script type="text/javascript">
        // Clear the previous ecommerce object.
        dataLayer.push({
            ecommerce: null
        });

        // Push the begin_checkout event to dataLayer.
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "BDT",
                value: Number("<?php echo Cart::subtotalFloat(); ?>"),
                items: [
                    <?php $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                        item_name: "<?php echo e($cartInfo->name); ?>",
                        item_id: "<?php    echo $cartInfo->id; ?>",
                        price: Number("<?php    echo $cartInfo->price; ?>"),
                        item_size: "<?php echo e($cartInfo->options->size); ?>",
                        item_color: "<?php echo e($cartInfo->options->color); ?>",
                        currency: "BDT",
                        quantity: <?php echo e($cartInfo->qty ?? 0); ?>

                            },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        #myTab.nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            padding: 8px;
            border: 3px solid #0f6b8b;
            border-radius: 4px;

        }

        #myTab.nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link {
            color: black;

        }

        #myTab {
            border: none;
        }

        .icon-element {
            display: block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            background-color: #287dfa;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            position: relative;
            font-size: 25px;
            color: #fff;
        }



        .spinner {
            display: none;
        }

        @media  only screen and (min-width: 768px) {
            #proName {
                font-size: 18px;
            }

            #proPrice {
                font-size: 18px;
                padding: 6px;
                padding-left: 0;
            }

            .input-number {
                height: 39px;
            }

            #proDelCart {
                width: 30px;
                padding-top: 2px;
                font-size: 20px;
            }

            #proImgDiv {
                max-width: 110px;
            }

            #proImg {
                max-width: 100px;
            }

        }
        .quantity_width_checkout{
            width: 81px;
            float: left;
        }

        @media  only screen and (max-width: 767px) {
            .quantity_width_checkout{
                width:65px;
            }
            .input-group--style-2 .input-group-btn>.btn {
                background: 0 0;
                border-color: #e6e6e6;
                color: #818a91;
                font-size: 8px;
                padding-top: 6px;
                padding-bottom: 6px;
                cursor: pointer;
            }

            .input-number {
                height: 26px;
            }

            #proDelCart {
                width: 30px;
                font-size: 18px;
            }

            #proImg {
                max-width: 50px;
            }
        }
    </style>

    <script>
        function incorder() {
            $.ajax({
                type: 'GET',
                url: 'incomplete-order',
                data: {
                    customerName: $('#customerName').val(),
                    customerAddress: $('#customerAddress').val(),
                    customerPhone: $('#customerPhone').val(),
                    ordersubtotalprice: $('#ordersubtotalprice').val(),
                    deliveryCharge: $('#deliveryCharge').val(),
                    customerNote: $('#customerNote').val(),
                },

                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function showbtn(idname) {
            if (idname == 'sslczPayBtn') {
                $('#orderConfirmCoin').css('display', 'none');
                $('#orderConfirm').css('display', 'none');
                $('#' + idname).css('display', 'inline');
                $('#paymentType').val(3);
                $('#cointext').css('display', 'none');
                $('#cointext2').css('display', 'none');
                $('#coinuse').html('0');
                calculation();
            } else if (idname == 'orderConfirmCoin') {
                $('#sslczPayBtn').css('display', 'none');
                $('#orderConfirm').css('display', 'none');
                $('#' + idname).css('display', 'inline');
                $('#paymentType').val(1);
                var coin = $('#totalcoin').html();
                $('#cointext').css('display', 'inline');
                $('#cointext2').css('display', 'inline');
                $('#coinuse').html(coin);
                calculation();
            } else {
                $('#sslczPayBtn').css('display', 'none');
                $('#orderConfirmCoin').css('display', 'none');
                $('#' + idname).css('display', 'inline');
                $('#paymentType').val(2);
                $('#cointext').css('display', 'none');
                $('#cointext2').css('display', 'none');
                $('#coinuse').html('0');
                calculation();
            }
        }
        $(document).ready(function () {

            $("#city_id").select2({
                placeholder: "Select a City",
                dropdownParent: $('#citydatatbl'),
                allowClear: true,
                ajax: {
                    data: function (params) {
                        var query = {
                            q: params.term,
                        };
                        return query;
                    },
                    type: 'GET',
                    url: '<?php echo e(url('delivery/cities')); ?>',
                    processResults: function (data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });


            $("#zone_id").select2({
                placeholder: "Select a Zone",
                dropdownParent: $('#xonedatatbl'),
                allowClear: true,
                ajax: {
                    data: function (params) {
                        var query = {
                            q: params.term,
                            cityID: $("#city_id").val()
                        };
                        return query;
                    },
                    type: 'GET',
                    url: '<?php echo e(url('delivery/zones')); ?>',
                    processResults: function (data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });


            $('#sslczPayBtn').css('display', 'none');
            $('#orderConfirmCoin').css('display', 'none');

            $('#paypal-tab').on('click', function () {
                $('#paymentMethod').val('Online Payment');
            });
            $('#credit-card-tab').on('click', function () {
                $('#paymentMethod').val('Manual Payment');
            });
            $('#sslczPayBtn').on('click', function () {
                var obj = {};
                obj.cus_name = $('#customerName').val();
                obj.cus_address = $('#customerAddress').val();
                obj.cus_phone = $('#customerPhone').val();
                obj.type = 'Hotel Booking';
                obj.subTotal = $('#subTotal').val();
                obj.email = $('#email').val();
                obj.address = $('#address').val();
                obj.city = $('#city').val();
                obj.state = $('#state').val();
                obj.zip = $('#zip').val();
                obj.country = $('#country').val();
                $('#sslczPayBtn').prop('postdata', obj);
            });
        });

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>
    <?php
        $zones = App\Models\Zone::all();
    ?>

    <script>
        var zones = <?php echo json_encode($zones, 15, 512) ?>;

        function applycoupon() {
            var code = $('#couponcode').val();
            if (code == '') {
                window.alert('Please Input a valid Coupon.');
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'check-coupon',
                    data: {
                        coupon_code: code,
                    },

                    success: function (data) {
                        if (data.status == 'invalid') {
                            $('#coupontext').css('display', 'none');
                            $('#coupontext1').css('display', 'none');
                            $('#coupondiscount').text(data.discount);
                            $('#coupon_code').val('');
                            calculation();
                            toastr.error('Please Input a valid Coupon.');
                        } else if (data.status == 'false') {
                            $('#coupontext').css('display', 'none');
                            $('#coupontext1').css('display', 'none');
                            $('#coupondiscount').text(data.discount);
                            $('#coupon_code').val('');
                            calculation();
                            toastr.error('You have already use this coupon.');
                        } else {
                            $('#coupontext').css('display', 'inline');
                            $('#coupontext1').css('display', 'inline');
                            $('#coupondiscount').text(data.discount);
                            $('#coupon_code').val(code);
                            calculation();
                            toastr.success('coupon applied successfully !');
                        }
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            }
        }

        function havecoupon() {
            var v = $('#havecoupon').val();
            if (v == 'Yes') {
                $('#couponoption').css('display', 'inline-block');
                $('#havecoupon').val('No');
                $('#couponcode').val('');
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'reset-coupon',

                    success: function (data) {
                        if (data == 'valid') {
                            $('#couponoption').css('display', 'none');
                            $('#havecoupon').val('Yes');
                            $('#couponcode').val('');
                            location.reload();
                        } else {
                            $('#couponoption').css('display', 'none');
                            $('#havecoupon').val('Yes');
                            $('#couponcode').val('');
                            window.alert('Please Input a valid Coupon.');
                        }
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });

            }
        }

        function updatenum(id) {
            var num = $('#QuantityPeo' + id).val();
            var fv = Number(num) + 1;
            if (fv > 9) {

            } else {
                $('#QuantityPeo' + id).val(fv);
                $.ajax({
                    type: 'POST',
                    url: 'update-cart',

                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        rowId: id,
                        qty: fv,
                    },

                    success: function (data) {
                        $('#QuantityPeo' + id).val(data.qty);
                        updateQuantity(id);

                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            }
        }

        function remnum(id) {
            var num = $('#QuantityPeo' + id).val();
            var fv = Number(num) - 1;
            if (fv < 1) {

            } else {
                $('#QuantityPeo' + id).val(fv);
                $.ajax({
                    type: 'POST',
                    url: 'update-cart',

                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        rowId: id,
                        qty: fv,
                    },

                    success: function (data) {
                        $('#QuantityPeo' + id).val(data.qty);
                        updateQuantity(id);

                    },
                    error: function (error) {
                        console.log('error');
                    }
                });

            }

        }

        function setdeliverychargr() {
            var deliverycharge = document.querySelector('input[name="deliveryCharge"]:checked').value;
            $('#dinamicdalivery').html(deliverycharge);
            var subprice = Number($('#subtotalprice').html());
            var coupon = Number($('#coupondiscount').html());
            var vat = Number($('#vatamount').val());
            var totalprice = subprice + vat - (-deliverycharge) - coupon;
            $('#totalamount').html(totalprice)
        }

        function updateQuantity(rowId) {
            var quantity = $('#QuantityPeo' + rowId).val();
            var price = $('#priceOf' + rowId).val();
            var producttotal = quantity * price;

            var prevPrice = $('#pricetotal' + rowId).html();
            if (producttotal > prevPrice) {
                var subPrice = Number($('#subtotalprice').html());
                var updatesubprice = subPrice - (-price);
                $('#subtotalprice').html(updatesubprice);
                //ordersubtotal
                $('#ordersubtotalprice').html(updatesubprice);
                //cart number
                var prevcart = $('#cartNumber').html();
                var cartUpdate = prevcart - (-1);
                $('#cartNumber').html(cartUpdate);

            } else {
                //cart number
                var prevcart = $('#cartNumber').html();
                var cartUpdate = prevcart - 1;
                $('#cartNumber').html(cartUpdate);

                var subPrice = Number($('#subtotalprice').html());
                var updatesubprice = subPrice - price;
                $('#subtotalprice').html(updatesubprice);
                $('#ordersubtotalprice').html(updatesubprice);

            }
            //mincart
            $('#minQty' + rowId).html(quantity);
            $('#minsubtotalprice').html(updatesubprice);
            //total price part
            var deliverycharge = document.querySelector('input[name="deliveryCharge"]:checked').value;
            var coupon = Number($('#coupondiscount').html());
            var vat = Number($('#vatamount').val());
            var totalprice = updatesubprice + vat - (-deliverycharge) - coupon;
            $('#totalamount').html(totalprice);

            $('#pricetotal' + rowId).html(producttotal);

            $.ajax({
                type: 'POST',
                url: 'update-cart',

                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    rowId: rowId,
                    qty: quantity,
                },

                success: function (data) {
                    $('#QuantityPeo' + rowId).val(data.qty);

                },
                error: function (error) {
                    console.log('error');
                }
            });

        }

        function removeFromCart(rowId) {
            var thisprice = $('#pricetotal' + rowId).html();
            var subPrice = Number($('#subtotalprice').html());
            var updatesubprice = subPrice - thisprice;
            $('#subtotalprice').html(updatesubprice);

            //order subtotal
            $('#ordersubtotalprice').html(updatesubprice);

            var deliverycharge = document.querySelector('input[name="deliveryCharge"]:checked').value;
            var coupon = Number($('#coupondiscount').html());
            var vat = Number($('#vatamount').val());
            var totalprice = updatesubprice + vat - (-deliverycharge) - coupon;
            $('#totalamount').html(totalprice);
            //cart number
            var quantity = $('#QuantityPeo' + rowId).val();
            var prevcart = $('#cartNumber').html();
            var cartUpdate = prevcart - quantity;
            $('#cartNumber').html(cartUpdate);

            $.ajax({
                type: 'POST',
                url: 'remove-cart',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    rowId: rowId,
                },

                success: function (data) {
                    $('#productcart' + rowId).css('display', 'none');
                    if (data == 'empty') {
                        location.reload();
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        window.onload = (event) => {
            var subPrice = Number($('#subtotalprice').html());
            //total price part
            var deliverycharge = document.querySelector('input[name="deliveryCharge"]:checked').value;
            var coupon = Number($('#coupondiscount').html());
            var vat = Number($('#vatamount').val());
            var totalprice = subPrice + vat - (-deliverycharge) - coupon;
            $('#totalamount').html(totalprice)

        };

        function calculation() {
            var subPrice = Number($('#subtotalprice').html());
            var coinuse = $('#coinuse').html();
            var deliverycharge = document.querySelector('input[name="deliveryCharge"]:checked').value;
            var coupon = Number($('#coupondiscount').html());
            var vat = Number($('#vatamount').val());
            var totalprice = subPrice + vat - (-deliverycharge) - coupon - coinuse;
            $('#totalamount').html(totalprice)
        }
    </script>

    <script type="text/javascript">
        (function () {
            $('.from-prevent-multiple-submits').on('submit', function () {
                $('.from-prevent-multiple-submits').attr('disabled', 'true');
                $('.spinner').css('display', 'inline');
            })
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/cart/checkout.blade.php ENDPATH**/ ?>