<link rel="stylesheet" href="<?php echo e(asset('public/webview/assets/css/zoomsl.css')); ?>">
<div class='row single-product'>
    <div class='p-0 col-md-12'>
        <div class="detail-block">
            <div class="row wow fadeInUp">

                <div class="col-xs-12 col-sm-12 col-md-6 gallery-holder">
                    <div class="product-item-holder size-big single-product-gallery small-gallery">

                        <?php if(json_decode($productdetails->PostImage)): ?>
                            <div id="sync1" class="owl-carousel owl-theme">
                                <?php if($productdetails->youtube_embade): ?>
                                    <div class="items">
                                        
                                        <iframe style="width:100%;height: 100% !important;aspect-ratio:1/1;border-radius: 4px;"
                                            src="https://www.youtube.com/embed/<?php echo e($productdetails->youtube_embade); ?>">
                                        </iframe>
                                    </div>
                                <?php endif; ?>
                                <?php $__empty_1 = true; $__currentLoopData = json_decode($productdetails->PostImage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="items">
                                        <img class="w-100 h-100 block__pic"
                                            src="<?php echo e(asset('public/images/product/slider')); ?>/<?php echo e($image); ?>" alt=""
                                            style="border-radius: 4px;">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </div>
                            <div id="sync2" class="owl-carousel owl-theme" style="padding-top: 10px;">
                                <div class="items">
                                    <img class="w-100 h-100" style="padding:6px;border:1px solid;border-radius: 4px;"
                                        src="<?php echo e(asset($productdetails->ProductImage)); ?>" alt="">
                                </div>
                                <?php $__empty_1 = true; $__currentLoopData = json_decode($productdetails->PostImage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="items">
                                        <img class="w-100 h-100" style="padding:6px;border:1px solid;border-radius: 4px;"
                                            src="<?php echo e(asset('public/images/product/slider')); ?>/<?php echo e($image); ?>" alt="">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="items">
                                <img class="w-100 h-100" src="<?php echo e(asset($productdetails->ProductImage)); ?>" alt=""
                                    style="border-radius: 4px;">
                            </div>
                        <?php endif; ?>

                    </div>
                    <!-- /.single-product-gallery -->
                </div>
                <!-- /.gallery-holder -->
                <div class="col-sm-12 col-md-6 product-info-block" id="paddingnone">
                    <div class="product-info" id="productinfo">
                        <div class="d-flex align-items-center" style="gap: 10px;font-size: 14px;">
                            <a class="text-muted" href="<?php echo e(url('/')); ?>">Home /</a>
                            <a class="text-muted"
                                href="<?php echo e(url('products/category/' . $productdetails?->categories->slug)); ?>"><?php echo e($productdetails?->categories->category_name); ?></a>
                        </div>
                        <h1 class="name"
                            style="margin-top:16px !important;padding-bottom: 6px;font-size: 20px !important; line-height: 25px;">
                            <?php echo e($productdetails->ProductName); ?>

                        </h1>

                        <div class="stock-container info-container m-t-10" style="margin-top:5px;">
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-12">
                                    <?php if(App\Models\Size::where('product_id', $productdetails->id)->first()): ?>
                                        <div class="product-price strong-700"
                                            style="color:black;font-weight:bold;padding-top: 6px;" id="productPriceAmount">
                                            <span
                                                id="salePrice"><?php echo e(App\Models\Size::where('product_id', $productdetails->id)->first()->SalePrice); ?></span>
                                            TK
                                            <?php if(App\Models\Size::where('product_id', $productdetails->id)->first()->Discount > 0): ?>
                                                &nbsp;<del class="old-product-price strong-400"
                                            style="color: #fe0909;font-size: 20px;"><?php echo e(round(App\Models\Size::where('product_id', $productdetails->id)->first()->RegularPrice)); ?>TK</del><?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="product-price strong-700"
                                            style="color:black;font-weight:bold;padding-top: 6px;" id="productPriceAmount">
                                            <span id="salePrice"
                                                style="color:black;font-weight:bold;"><?php echo e(App\Models\Weight::where('product_id', $productdetails->id)->first()->SalePrice); ?></span>
                                            TK
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="mt-2 mb-2 row">

                            <!-- <div class="mt-2 col-12 col-md-12 colorpart">
                                <div id="breaftext">
                                    <?php echo $productdetails->ProductBreaf; ?>

                                </div>
                            </div> -->

                            <?php if(empty(json_decode($singlemain->RelatedProductIds))): ?>
                            <?php else: ?>
                                <div class="mb-2 col-12 col-md-12 colorpart">
                                    <h4 id="productselect" class="m-0"><b style="font-size:14px">Select Product Colours:
                                        </b></h4>
                                    <div class="d-flex">
                                        <div class="colorinfo">
                                            <?php $__empty_1 = true; $__currentLoopData = json_decode($singlemain->RelatedProductIds); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ids): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php
                                                    $prodinfo = App\Models\Product::where('id', $ids->productID)->first();
                                                ?>
                                                <input type="radio" class="m-0" id="relproduct<?php echo e($prodinfo->id); ?>" hidden
                                                    name="relproduct"
                                                    onclick="getrelproduct('<?php echo e($prodinfo->id); ?>','<?php echo e($singlemain->id); ?>')">
                                                <label class="relproduct ms-0" id="relproducttext<?php echo e($prodinfo->id); ?>"
                                                    for="relproduct<?php echo e($prodinfo->id); ?>"
                                                    style="border: 1px solid #000;padding: 0px;"
                                                    onclick="getrelproduct('<?php echo e($prodinfo->id); ?>','<?php echo e($singlemain->id); ?>')">
                                                    <img src="<?php echo e(asset($prodinfo->ProductImage)); ?>" alt="" style="width:60px;">
                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(count($sizes) < 1): ?>
                            <?php else: ?>
                                <div class="col-12 col-md-12 colorpart">
                                    <h4 id="resellerprice" class="m-0"><b style="font-size:14px">Select Product Sizes: </b>
                                    </h4>
                                    <div class="sizeinfo">
                                        <?php $__empty_1 = true; $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sizesold): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($sizesold->available_stock > 0): ?>
                                                <input type="hidden" name="regularpriceofsize"
                                                    id="regularpriceofsize<?php echo e($sizesold->id); ?>"
                                                    value="<?php echo e($sizesold->RegularPrice); ?>">
                                                <input type="hidden" name="salepriceofsize" id="salepriceofsize<?php echo e($sizesold->id); ?>"
                                                    value="<?php echo e($sizesold->SalePrice); ?>">
                                                <input type="radio" class="m-0" hidden id="size<?php echo e($sizesold->id); ?>" name="size"
                                                    onclick="getsize('<?php echo e($sizesold->id); ?>')">
                                                <label class="sizetext ms-0" id="sizetext<?php echo e($sizesold->id); ?>"
                                                    for="size<?php echo e($sizesold->id); ?>"
                                                    style="border: 1px solid #e4e4e4;font-size:18px;font-weight:bold;padding: 0px 8px;border-radius: 2px;margin-right:4px;margin-bottom:4px;"
                                                    onclick="getsize('<?php echo e($sizesold->id); ?>')"><?php echo e($sizesold->size); ?></label>
                                            <?php else: ?>
                                                <input type="hidden" name="regularpriceofsize"
                                                    id="regularpriceofsize<?php echo e($sizesold->id); ?>"
                                                    value="<?php echo e($sizesold->RegularPrice); ?>">
                                                <input type="hidden" name="salepriceofsize" id="salepriceofsize<?php echo e($sizesold->id); ?>"
                                                    value="<?php echo e($sizesold->SalePrice); ?>">
                                                <input type="radio" class="m-0" hidden id="size<?php echo e($sizesold->id); ?>" name="size">
                                                <label class="sizetext ms-0" id="sizetext<?php echo e($sizesold->id); ?>"
                                                    for="size<?php echo e($sizesold->id); ?>"
                                                    style="border: 1px solid #e4e4e4;    color: rgb(151 150 150) !important;font-size:18px;font-weight:bold;padding: 0px 8px;border-radius: 2px;margin-right:4px;margin-bottom:4px;"><del><?php echo e($sizesold->size); ?>

                                                    </del> </label>
                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(count($weights) < 1): ?>
                            <?php else: ?>
                                <div class="col-12 col-md-12 colorpart">
                                    <h4 id="resellerprice" class="m-0"><b style="font-size:14px">সিলেক্ট করে কনফার্ম
                                            করুনঃ</b></h4>
                                    <div class="sizeinfo">
                                        <?php $__empty_1 = true; $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <input type="hidden" name="regularpriceofsize"
                                                id="regularpriceofsize<?php echo e($weight->id); ?>" value="<?php echo e($weight->RegularPrice); ?>">
                                            <input type="hidden" name="salepriceofsize" id="salepriceofsize<?php echo e($weight->id); ?>"
                                                value="<?php echo e($weight->SalePrice); ?>">
                                            <input type="hidden" name="weightsigmrnt" id="weightsigmrnt<?php echo e($weight->id); ?>"
                                                value="<?php echo e($weight->weight); ?>">
                                            <input type="radio" class="m-0" hidden id="size<?php echo e($weight->id); ?>" name="size"
                                                onclick="getweight('<?php echo e($weight->id); ?>')">
                                            <label class="weighttext ms-0" id="weighttext<?php echo e($weight->id); ?>"
                                                for="size<?php echo e($weight->id); ?>"
                                                style="border: 1px solid #e4e4e4;font-size:16px;font-weight:bold;padding: 0px 6px;border-radius: 2px;margin-right:4px;margin-bottom:4px;"
                                                onclick="getweight('<?php echo e($weight->id); ?>')"><?php echo e($weight->weight); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p for="" style=" margin: 0; padding-top: 1px;text-align:left">Product Code :
                            <?php echo e($productdetails->ProductSku); ?>

                        </p>



                        <!-- /.stock-container -->
                        <div class="text-center quantity-container info-container" style="width: 100%; float: left;">


                            <div class="row align-items-center">
                                <!-- Quantity (mobile: col-6, desktop: col-lg-4) -->
                                <div class="order-1 my-2 col-6 col-lg-4">
                                    <div class="pr-2 d-flex align-items-center"
                                        style="justify-content: start;padding-right: 4px;border:1px solid #000;">
                                        <button type="button" class="btn btn-sm" id="buttonminus" onclick="minus()"><i
                                                class="fa-solid fa-minus"></i></button>

                                        <div class="mx-2 cart-quantity" style="height: 34px; min-width:70px;">
                                            <div class="quant-input">
                                                <input type="text" class="form-control" id="qtyval"
                                                    style="font-size: 18px;height: 34px;padding:0px;text-align: center;border-left:1px solid #000; border-right:1px solid #000;border-radius:0; width:70px;"
                                                    value="1" readonly>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-sm" id="buttonplus" onclick="plus()"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>

                                <!-- Buy Now (mobile: full width below, desktop: middle col) -->
                                <div class="order-3 my-2 col-12 col-lg-7 order-lg-2">
                                    <form name="form" action="<?php echo e(url('add-to-buy')); ?>" id="submitaddtocart"
                                        method="POST" enctype="multipart/form-data" style="text-align: center;">
                                        <?php echo method_field('POST'); ?>
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="color" id="product_colororder"
                                            value="<?php echo e($varients[0]->color); ?>">
                                        <input type="hidden" name="size" id="product_sizeorder" value="">
                                        <input type="hidden" name="sigment" id="product_sigmentorder" value="">
                                        <input type="hidden" name="price" id="product_priceorder" value="">
                                        <input type="hidden" name="product_id" value="<?php echo e($productdetails->id); ?>" hidden>
                                        <input type="hidden" name="qty" value="1" id="qtyoror">

                                        <button type="submit"
                                            class="mb-0 ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now w-100"
                                            style="background:#1ebc50 !important;color:white;font-size: 15px;border-radius:20px;">
                                            ক্যাশ অন ডেলিভারিতে অর্ডার করুন
                                        </button>
                                    </form>
                                </div>
                                <!-- Add to cart (mobile: full width below, desktop: middle col) -->
                                <div class="order-3 my-2 col-6 col-lg-5 order-lg-2">
                                    <form name="form" action="<?php echo e(url('add-to-cart')); ?>" id="submitaddtocart"
                                        method="POST" enctype="multipart/form-data" style="text-align: center;">
                                        <?php echo method_field('POST'); ?>
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="color" id="product_colororder"
                                            value="<?php echo e($varients[0]->color); ?>">
                                        <input type="hidden" name="size" id="product_sizeordernew" value="">
                                        <input type="hidden" name="sigment" id="product_sigmentorder" value="">
                                        <input type="hidden" name="price" id="product_priceneworder" value="">
                                        <input type="hidden" name="product_id" value="<?php echo e($productdetails->id); ?>" hidden>
                                        <input type="hidden" name="qty" value="1" id="qtyoror">

                                        <button type="submit"
                                            class="mb-0 ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now w-100"
                                            style="background:#000 !important;color:white;font-size: 15px;border-radius:20px;">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>

                                <!-- Wishlist (mobile: col-6, desktop: col-lg-2) -->
                                <div class="order-2 my-2 col-6 col-lg-2 order-lg-3 d-none">
                                    <div class="d-flex justify-content-end">
                                        <div class="product-wishlist">
                                            <form action="<?php echo e(route('wishlist.add')); ?>" method="POST" class="p-0 m-0">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_id" value="<?php echo e($singlemain->id); ?>">

                                                <button type="submit" class="p-0 m-0 bg-transparent border-0">
                                                    <?php
                                                        $wishlist = session()->get('wishlist', []);
                                                        $inWishlist = in_array($singlemain->id, $wishlist);
                                                    ?>

                                                    <?php if($inWishlist): ?>
                                                        <i class="fa-solid fa-heart fs-5" style="color: #120D3F"></i>
                                                    <?php else: ?>
                                                        <i class="fa-regular fa-heart fs-5" style="color: #120D3F"></i>
                                                    <?php endif; ?>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="d-none">
                                <div class="mt-3">
                                    <div class="delivery-box">
                                        <div class="delivery-item">
                                            <div class="row align-items-center">

                                                <div class="text-center col-2">
                                                    <i class="fa-solid fa-truck delivery-icon"></i>
                                                </div>

                                                <div class="col-10">
                                                    <div class="delivery-title">Free Delivery</div>
                                                    <a href="#" class="mt-2 delivery-link">Enter your postal code for
                                                        Delivery Availability</a>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="delivery-item">
                                            <div class="row align-items-center">
                                                <div class="text-center col-2">
                                                    <i class="fa-solid fa-rotate delivery-icon"></i>
                                                </div>

                                                <div class="col-10">
                                                    <div class="delivery-title">Return Delivery</div>
                                                    <span class="mt-2 d-flex">Free 30 Days Delivery Returns. <a href="#"
                                                            class="delivery-link">Details</a></span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </section>
                        </div>

                        <p>
                            Categories :
                            <a class="details-category" href="<?php echo e(url('products/category/' . $productdetails?->categories->slug)); ?>"
                                ><?php echo e($productdetails?->categories->category_name); ?></a>
                        </p>
                        
                        <div class="gap-3  d-flex ">
                            <a href="<?php echo e($basicinfo->facebook); ?>" target="_blank" title="Facebook" class="details-social fs-5"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="<?php echo e($basicinfo->linkedin); ?>" target="_blank" title="Instagram" class="details-social fs-5"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="<?php echo e($basicinfo->email); ?>" target="_blank" title="Tiktok" class="details-social fs-5"><i
                                    class="fa-brands fa-tiktok"></i></a>
                            <a href="<?php echo e($basicinfo->email); ?>" target="_blank" title="Email" class="details-social fs-5">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.product-info -->
                </div>
                <!-- /.col-sm-7 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.col -->
    <div class="clearfix"></div>
</div>
<div class="row single-product">
    <div class="p-0 col-md-12">
        <div class="product-tabs inner-bottom-xs wow fadeInUp">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#short_desc">Short
                                Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#full_desc">Description</a>
                        </li>
                    </ul>

                    <!-- /.nav-tabs #product-tabs -->
                </div>
                <div class="col-sm-12">

                    <div class="tab-content">

                        <div id="short_desc" class="tab-pane fade show active">
                            <p><?php echo $productdetails->ProductBreaf; ?></p>
                        </div>

                        <div id="full_desc" class="tab-pane fade">
                            <p><?php echo $productdetails->ProductDetails; ?></p>
                        </div>

                    </div>

                    <!-- /.tab-content -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>


    </div>
</div>



<?php if(App\Models\Size::where('product_id', $productdetails->id)->first()): ?>
    <input type="hidden" id="gtmprice"
        value="<?php echo e(App\Models\Size::where('product_id', $productdetails->id)->first()->SalePrice); ?>">
    <input type="hidden" id="gtmdiscount"
        value="<?php echo e(App\Models\Size::where('product_id', $productdetails->id)->first()->RegularPrice - App\Models\Size::where('product_id', $productdetails->id)->first()->SalePrice); ?>">
<?php else: ?>
    <input type="hidden" id="gtmprice"
        value="<?php echo e(App\Models\Weight::where('product_id', $productdetails->id)->first()->SalePrice); ?>">
    <input type="hidden" id="gtmdiscount"
        value="<?php echo e(App\Models\Weight::where('product_id', $productdetails->id)->first()->RegularPrice - App\Models\Weight::where('product_id', $productdetails->id)->first()->SalePrice); ?>">
<?php endif; ?>

<input type="hidden" id="gtmproductname" value="<?php echo e($productdetails->ProductName); ?>">
<input type="hidden" id="gtmcategory"
    value="<?php echo e(App\Models\Category::where('id', $productdetails->category_id)->first()->category_name); ?>">
<input type="hidden" id="gtmproductid" value="<?php echo e($productdetails->id); ?>">
<input type="hidden" id="gtmproductsku" value="<?php echo e($productdetails->ProductSku); ?>">


<script>
    $(document).ready(function () {

        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
            ],
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                margin: 6,
                items: slidesPerPage,
                dots: false,
                nav: true,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });


        $('#AddToCartForm').submit(function (e) {
            e.preventDefault();
            $('#processing').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            })
            $('#processing').modal('show');
            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('add-to-cart')); ?>',
                processData: false,
                contentType: false,
                data: new FormData(this),

                success: function (data) {
                    updatecart();
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo e(url('get-cart-content')); ?>',

                        success: function (response) {
                            $('#cartViewModal .modal-body').empty().append(
                                response);
                        },
                        error: function (error) {
                            console.log('error');
                        }
                    });
                    $('#processing').modal('hide');
                    $('#cartViewModal').modal('show');
                },
                error: function (error) {
                    console.log('error');
                }
            });
        });

        // document.getElementById("istteb").click();
        $('#owl-single-product').owlCarousel({
            items: 1,
            itemsTablet: [768, 1],
            itemsDesktop: [1199, 1],
            autoplay: true,
            loop: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,

        });
    });

    var gtmprice = $('#gtmprice').val();
    var gtmqty = $('#proQuantity').val();
    var gtmid = $('#gtmproductid').val();
    var gtmsku = $('#gtmproductsku').val();
    var gtmproductname = $('#gtmproductname').val();
    var gtmcategory = $('#gtmcategory').val();
    var gtmdiscount = $('#gtmdiscount').val();

    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        ecommerce: null
    });
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            currency: "BDT",
            value: gtmprice,
            items: [{
                item_id: gtmsku,
                item_name: gtmproductname,
                index: 0,
                price: gtmprice,
                discount: gtmdiscount,
                item_brand: 'Bluemart.com.bd',
                item_category: gtmcategory,
                currency: "BDT",
                quantity: 1,
            }]

        }
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById('submitaddtocart').addEventListener('submit', function (event) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                ecommerce: null
            });
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    currency: "BDT",
                    value: gtmprice,
                    items: [{
                        item_id: gtmsku,
                        item_name: gtmproductname,
                        index: 0,
                        price: gtmprice,
                        discount: gtmdiscount,
                        item_brand: 'Bluemart.com.bd',
                        item_category: gtmcategory,
                        currency: "BDT",
                        quantity: $('#qtyoror').val()
                    }]
                }
            });
        });
    });
</script>
<script src="<?php echo e(asset('public/webview/assets/js/zoomsl.min.js')); ?>"></script>
<script type="text/javascript">
    $(".block__pic").imagezoomsl({
        zoomrange: [3, 3]
    });
</script><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/product/loadproduct.blade.php ENDPATH**/ ?>