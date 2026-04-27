<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>-Best online shop in Bangladesh
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('meta'); ?>
        <meta name="description"
            content="Online shopping in Bangladesh for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta name="keywords"
            content="<?php echo e(env('APP_NAME')); ?>, online store bd, online shop bd, Organic fruits, Thai, UK, Korea, China, cosmetics, Jewellery, bags, dress, mobile, accessories, automation Products,">


        <meta itemprop="name" content="Best Online Shopping in Bangladesh | <?php echo e(env('APP_NAME')); ?>">
        <meta itemprop="description"
            content="Best online shopping in Bangladesh for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta itemprop="image" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png">

        <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Best Online Shopping in Bangladesh | <?php echo e(env('APP_NAME')); ?>">
        <meta property="og:description"
            content="Online shopping in BD for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta property="og:image" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png">
        <meta property="image" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png" />
        <meta property="url" content="<?php echo e(env('APP_URL')); ?>/">
        <meta itemprop="image" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png">
        <meta property="twitter:card" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png" />
        <meta property="twitter:title" content="Best Online Shopping in Bangladesh | <?php echo e(env('APP_NAME')); ?>" />
        <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
        <meta name="twitter:image" content="<?php echo e(env('APP_URL')); ?>/public/rankone1.png">
    <?php $__env->stopSection(); ?>

    <style>
        .product {
            margin-top: 4px !important;

        }

        #featureimagess {
            width: 100%;
            padding: 0px;
            padding-top: 0;
            /*max-height:200px;*/
        }

        #checked {
            color: orange;
        }

        .star {
            font-size: 12px !important;
        }

        .category-title {
            background: #212129;
            padding: 10px;
        }

        .category-list {
            margin-top: 20px;
            background: #fff;
            border-radius: 5px;
            /*padding: 15px;*/
            height: 445px;
            /*overflow: auto;*/
        }

        .category-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list ul li {
            padding: 0px 20px;
            display: flex;
            align-items: center;
        }

        .category-list ul li:hover {
            /* background: #ffbe9e; */
            color: #000 !important;
            font-weight: 600;
        }

        .today-deal {
            background: #ff650c;
            border-radius: 5px;
            padding: 15px;
            height: 400px;
        }

        .today-deal h5 {
            margin-bottom: 15px;
        }

        .deal-item {
            background: #fff;
            margin-bottom: 15px;
            padding-left: 15px;
            padding-top: 15px;
            border-radius: 8px;
        }

        .deal-item img {
            width: 110px;
            border-radius: 5px;
        }

        .deal-price {
            color: #f60;
            font-weight: bold;
        }

        .deal-old-price {
            text-decoration: line-through;
            color: #888;
        }

        .custom-carousel {
            position: relative;
        }

        .custom-carousel .carousel-indicators button {
            background-color: #000;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 5px;
        }

        .category-list li:hover>.subcategory-dropdown {
            display: block !important;
        }

        .subcategory-dropdown li a:hover {
            color: #000 !important;
            font-weight: 600;
        }
    </style>
    <style>
        /* Owl Nav Buttons */


        #categorySlide .owl-nav {
            position: absolute;
            top: 30%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
        }

        #categorySlide .owl-nav button {
            pointer-events: all;
            background: rgba(0, 0, 0, 0.6);
            color: black;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- banner -->
    <div class="container p-0">
        <div class="row">
            <!-- Categories -->
            <div class="p-0 mb-3 col-lg-2 col-12 d-none" style="border-right: 1px solid #ddd">
                <!-- <div class="category-title">
                            <h5 class="m-0 text-white fw-bold">Categories</h5>
                        </div> -->
                <div class="category-list">
                    <ul class="p-0 m-0 list-unstyled">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class=" position-relative">
                                <?php
                                    $subcategories = App\Models\Subcategory::where('status', 'Active')->where('category_id', $category->id)->get();
                                ?>

                                <a href="<?php echo e(url('products/category/' . $category->slug)); ?>"
                                    class="text-dark d-flex align-items-center py-2 <?php echo e($category->subcategories->count() ? 'dropdown-toggle' : ''); ?>">

                                    <img src="<?php echo e(asset($category->category_icon)); ?>" alt="" width="20">

                                    <span class="mx-2">
                                        <?php echo e($category->category_name); ?>

                                    </span>

                                </a>



                                <?php if($subcategories->isNotEmpty()): ?>
                                    <ul class="top-0 p-2 bg-white shadow-sm subcategory-dropdown list-unstyled position-absolute start-100 "
                                        style="min-width:180px; display:none; z-index:999;">
                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="py-1">
                                                <a href="<?php echo e(url('products/sub/category/' . $value->slug)); ?>"
                                                    class="text-muted small d-block"><?php echo e($value->sub_category_name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li><span class="text-muted">No categories found</span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Banner  -->
            <div class="mb-3 col-lg-12 col-12" style="padding-left:20px;margin-top:20px">
                <div class="owl-carousel owl-theme" id="slider">
                    <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="item" style="margin:0 !important;">
                            <a href="<?php echo e($slider->slider_btn_link); ?>">
                                <img src="<?php echo e(asset($slider->slider_image)); ?>" class="w-100">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Today's Deal -->

        </div>
    </div>


    <!-- New Arrival -->
    <div class="container">
        <?php if(count($bestselling) > 0): ?>
            <div class="pb-2 bg-white row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="flash-wrapper">
                            <h2 class="m-0 flashsale-main-title">NEW ARRIVAL</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="owl-carousel " id="promotionalofferSlide">
                        <?php $__empty_1 = true; $__currentLoopData = $bestselling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $firstpro = App\Models\Product::with([
                                    'sizes' => function ($query) {
                                        $query
                                            ->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')
                                            ->take(1);
                                    },
                                ])
                                    ->where('id', json_decode($promotional->RelatedProductIds)[0]->productID)
                                    ->select('id', 'ProductName')
                                    ->first();

                            ?>
                            <?php if(isset($firstpro)): ?>
                                <div class="item " id="featuredproduct">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col-12">
                                                        <div class="product-image" style="position: relative;">
                                                            <div class="text-center image">
                                                                <!-- <?php if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice): ?>
                                                                                    <div class="frs_discount">
                                                                                        <span> -
                                                                                            <?php echo e(($firstpro->sizes[0]->RegularPrice > 0) ? round((($firstpro->sizes[0]->RegularPrice - $firstpro->sizes[0]->SalePrice) / $firstpro->sizes[0]->RegularPrice) * 100) : 0); ?>%

                                                                                        </span>
                                                                                    </div>
                                                                                <?php endif; ?> -->
                                                                <div class="wishlist-eye-btn">
                                                                    <form action="<?php echo e(route('wishlist.add')); ?>" method="POST"
                                                                        class="p-0 m-0">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="product_id"
                                                                            value="<?php echo e($promotional->id); ?>">

                                                                        <button type="submit">
                                                                            <?php
                                                                                $wishlist = session()->get('wishlist', []);
                                                                                $inWishlist = in_array($promotional->id, $wishlist);
                                                                            ?>

                                                                            <?php if($inWishlist): ?>
                                                                                <i class="fa-solid fa-heart fs-5"
                                                                                    style="font-size: 18px;color:black;"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa-regular fa-heart fs-5"
                                                                                    style="font-size: 18px;color:black;"></i>
                                                                            <?php endif; ?>
                                                                        </button><br>
                                                                    </form>
                                                                    <button class="quick-shop-btn" type="button"
                                                                        data-product-id="<?php echo e($promotional->id); ?>">
                                                                        <i class="fa-regular fa-eye"
                                                                            style="font-size: 18px;color:black;"></i>
                                                                    </button>
                                                                </div>
                                                                <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                                    <img src="<?php echo e(asset($promotional->ProductImage)); ?>"
                                                                        style="padding:4px;">
                                                                </a>

                                                                
                                                            </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-12">
                                                        <div class="p-2 infofe p-md-2"
                                                            style="padding-bottom: 4px !important;background: white;">
                                                            <div class="product-info text-center">
                                                                <h2 class="name text-truncate" id="f_name"><a
                                                                        href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>"
                                                                        id="f_pro_name"><?php echo e($promotional->ProductName); ?></a>
                                                                </h2>
                                                            </div>

                                                            <div class="price-box text-center" style="padding: 8px 0;">
                                                                <?php if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice): ?>
                                                                    <del class="old-product-price strong-400"
                                                                        style="color:#db4444">৳<?php echo e(round($firstpro->sizes[0]->RegularPrice)); ?></del>
                                                                <?php endif; ?>
                                                                <span class="product-price strong-600"
                                                                    style="color:black;margin-left:7px;">৳<?php echo e(round($firstpro->sizes[0]->SalePrice)); ?></span>
                                                            </div>

                                                        </div>
                                                        <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                            <button class="mb-0 btn btn-danger btn-sm btn-block"
                                                                style="width: 100%;border-radius: 4px;padding: 8px 0; "
                                                                id="purcheseBtn">অর্ডার করুন</button>
                                                        </a>

                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- <div class="text-center" style="margin-top:30px">
                        <a href="<?php echo e(url('best/products')); ?>"
                            style="padding:15px 35px;color:white;font-weight:bold;font-size:15px;background:#db4444;border-radius:4px">
                            View All Products
                        </a>
                    </div> -->

        <?php else: ?>
        <?php endif; ?>
    </div>

    <!-- Top Selling -->
    <div class="container">
        <?php if(count($topproducts) > 0): ?>
            <div class="pb-2 bg-white row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="flash-wrapper">
                            <h2 class="m-0 flashsale-main-title">TOP SELLING</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="owl-carousel " id="topsaleofferSlide">
                        <?php $__empty_1 = true; $__currentLoopData = $topproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $firstpro = App\Models\Product::with([
                                    'sizes' => function ($query) {
                                        $query
                                            ->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')
                                            ->take(1);
                                    },
                                ])
                                    ->where('id', json_decode($promotional->RelatedProductIds)[0]->productID)
                                    ->select('id', 'ProductName')
                                    ->first();

                            ?>
                            <?php if(isset($firstpro)): ?>
                                <div class="item " id="featuredproduct">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col-12">
                                                        <div class="product-image" style="position: relative;">
                                                            <div class="text-center image">
                                                                <!-- <?php if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice): ?>
                                                                                    <div class="frs_discount">
                                                                                        <span> -
                                                                                            <?php echo e(($firstpro->sizes[0]->RegularPrice > 0) ? round((($firstpro->sizes[0]->RegularPrice - $firstpro->sizes[0]->SalePrice) / $firstpro->sizes[0]->RegularPrice) * 100) : 0); ?>%

                                                                                        </span>
                                                                                    </div>
                                                                                <?php endif; ?> -->
                                                                <div class="wishlist-eye-btn">
                                                                    <form action="<?php echo e(route('wishlist.add')); ?>" method="POST"
                                                                        class="p-0 m-0">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="product_id"
                                                                            value="<?php echo e($promotional->id); ?>">

                                                                        <button type="submit">
                                                                            <?php
                                                                                $wishlist = session()->get('wishlist', []);
                                                                                $inWishlist = in_array($promotional->id, $wishlist);
                                                                            ?>

                                                                            <?php if($inWishlist): ?>
                                                                                <i class="fa-solid fa-heart fs-5"
                                                                                    style="font-size: 18px;color:black;"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa-regular fa-heart fs-5"
                                                                                    style="font-size: 18px;color:black;"></i>
                                                                            <?php endif; ?>
                                                                        </button><br>
                                                                    </form>
                                                                    <button class="quick-shop-btn" type="button"
                                                                        data-product-id="<?php echo e($promotional->id); ?>">
                                                                        <i class="fa-regular fa-eye"
                                                                            style="font-size: 18px;color:black;"></i>
                                                                    </button>
                                                                </div>
                                                                <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                                    <img src="<?php echo e(asset($promotional->ProductImage)); ?>"
                                                                        style="padding:4px;">
                                                                </a>

                                                                
                                                            </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-12">
                                                        <div class="p-2 infofe p-md-2"
                                                            style="padding-bottom: 4px !important;background: white;">
                                                            <div class="product-info text-center">
                                                                <h2 class="name text-truncate" id="f_name"><a
                                                                        href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>"
                                                                        id="f_pro_name"><?php echo e($promotional->ProductName); ?></a>
                                                                </h2>
                                                            </div>

                                                            <div class="price-box text-center" style="padding: 8px 0;">
                                                                <?php if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice): ?>
                                                                    <del class="old-product-price strong-400"
                                                                        style="color:#db4444">৳<?php echo e(round($firstpro->sizes[0]->RegularPrice)); ?></del>
                                                                <?php endif; ?>
                                                                <span class="product-price strong-600"
                                                                    style="color:black;margin-left:7px;">৳<?php echo e(round($firstpro->sizes[0]->SalePrice)); ?></span>
                                                            </div>

                                                        </div>
                                                        <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                            <button class="mb-0 btn btn-danger btn-sm btn-block"
                                                                style="width: 100%;border-radius: 4px;padding: 8px 0; "
                                                                id="purcheseBtn">অর্ডার করুন</button>
                                                        </a>

                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- <div class="text-center" style="margin-top:30px">
                        <a href="<?php echo e(url('best/products')); ?>"
                            style="padding:15px 35px;color:white;font-weight:bold;font-size:15px;background:#db4444;border-radius:4px">
                            View All Products
                        </a>
                    </div> -->

        <?php else: ?>
        <?php endif; ?>
    </div>


    <!-- All Product -->
    <div class="container">
        <?php if(count($allProducts) > 0): ?>
            <div class="pb-2 bg-white row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="flash-wrapper">
                            <h2 class="m-0 flashsale-main-title">সকল পণ্য</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $allProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $firstpro = App\Models\Product::with([
                                    'sizes' => function ($query) {
                                        $query
                                            ->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')
                                            ->take(1);
                                    },
                                ])
                                    ->where('id', json_decode($promotional->RelatedProductIds)[0]->productID)
                                    ->select('id', 'ProductName')
                                    ->first();

                            ?>
                            <?php if(isset($firstpro)): ?>
                                <div class="col-6 col-md-3" style="margin-top:10px;">
                                    <div class="item" id="featuredproduct">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col-12">
                                                            <div class="product-image" style="position: relative;">
                                                                <div class="text-center image">
                                                                    
                                                                    
                                                                    <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                                        <img src="<?php echo e(asset($promotional->ProductImage)); ?>"
                                                                            style="padding:4px;">
                                                                    </a>

                                                                    
                                                                </div>
                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-12">
                                                            <div class="p-2 infofe p-md-2"
                                                                style="padding-bottom: 4px !important;background: white;">
                                                                <div class="product-info text-center">
                                                                    <h2 class="name text-truncate" id="f_name"><a
                                                                            href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>"
                                                                            id="f_pro_name"><?php echo e($promotional->ProductName); ?></a>
                                                                    </h2>
                                                                </div>

                                                                <div class="price-box text-center" style="padding: 8px 0;">
                                                                    <?php if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice): ?>
                                                                        <del class="old-product-price strong-400"
                                                                            style="color:#db4444">৳<?php echo e(round($firstpro->sizes[0]->RegularPrice)); ?></del>
                                                                    <?php endif; ?>
                                                                    <span class="product-price strong-600"
                                                                        style="color:black;margin-left:7px;">৳<?php echo e(round($firstpro->sizes[0]->SalePrice)); ?></span>
                                                                </div>

                                                            </div>
                                                            <a href="<?php echo e(url('view-product/' . $promotional->ProductSlug)); ?>">
                                                                <button class="mb-0 btn btn-danger btn-sm btn-block"
                                                                    style="width: 100%;border-radius: 4px;padding: 8px 0; "
                                                                    id="purcheseBtn">অর্ডার করুন</button>
                                                            </a>

                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- <div class="text-center" style="margin-top:30px">
                        <a href="<?php echo e(url('best/products')); ?>"
                            style="padding:15px 35px;color:white;font-weight:bold;font-size:15px;background:#db4444;border-radius:4px">
                            View All Products
                        </a>
                    </div> -->

        <?php else: ?>
        <?php endif; ?>
    </div>


    <!-- Categories -->
    <!-- <div class="container p-0 my-2">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="title-top">
                            <span class="bar"></span>
                            <span class="category-text">Categories</span>
                        </div>

                        <h2 class="main-title">Browse By Category</h2>
                    </div>

                    <div class="owl-carousel " id="categorySlide">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="item">
                                <a href="<?php echo e(url('products/category/' . $category->slug)); ?>">
                                    <div id="cath" style="border: 1px solid #000;border-radius:5px">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?php echo e(asset($category->category_icon)); ?>" id="catimg">
                                        </div>

                                        <p id="catp" style="font-weight:bold;"><?php echo e($category->category_name); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div> -->




    <?php if(Auth::id()): ?>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::id()); ?>">
    <?php else: ?>
        <input type="hidden" name="user_id" id="user_id">
    <?php endif; ?>

    <?php if(Auth::id()): ?>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::id()); ?>">
    <?php else: ?>
        <input type="hidden" name="user_id" id="user_id">
    <?php endif; ?>

    <script>
        function givereactlike(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('give/react/')); ?>' + '/like',
                data: {
                    'user_id': $('#user_id').val(),
                    'product_id': id,
                },

                success: function (data) {
                    if (data.sigment == 'like') {
                        $('#promotionalofferSlide #likereactof' + id).text(data.total);
                        $('#promotionalofferSlide #likereactdone' + id).css('color', 'green');
                        $('#propro #likereactof' + id).text(data.total);
                        $('#propro #likereactdone' + id).css('color', 'green');
                    } else if (data.sigment == 'unlike') {
                        $('#promotionalofferSlide #likereactof' + id).text(data.total);
                        $('#promotionalofferSlide #likereactdone' + id).css('color', 'black');
                        $('#propro #likereactof' + id).text(data.total);
                        $('#propro #likereactdone' + id).css('color', 'black');
                    } else {

                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function givereactlove(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('give/react/')); ?>' + '/love',
                data: {
                    'user_id': $('#user_id').val(),
                    'product_id': id,
                },

                success: function (data) {
                    if (data.sigment == 'love') {
                        $('#promotionalofferSlide #lovereactof' + id).text(data.total);
                        $('#promotionalofferSlide #lovereactdone' + id).css('color', 'red');
                        $('#propro #lovereactof' + id).text(data.total);
                        $('#propro #lovereactdone' + id).css('color', 'red');
                    } else {
                        $('#promotionalofferSlide #lovereactof' + id).text(data.total);
                        $('#promotionalofferSlide #lovereactdone' + id).css('color', 'black');
                        $('#propro #lovereactof' + id).text(data.total);
                        $('#propro #lovereactdone' + id).css('color', 'black');
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.hover-switch').each(function () {
                var $link = $(this);
                var mainImg = $link.data('main');
                var hoverImg = $link.data('hover');
                var $img = $link.find('.switchable-img');

                if (hoverImg && hoverImg !== '') {
                    $link.on('mouseenter', function () {
                        $img.attr('src', hoverImg);
                    }).on('mouseleave', function () {
                        $img.attr('src', mainImg);
                    });
                }
            });
        });
    </script>


    <script>

        let countDownDate = new Date("Jun 30, 2026 23:59:59").getTime();

        let x = setInterval(function () {

            let now = new Date().getTime();
            let distance = countDownDate - now;

            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (distance < 0) {
                clearInterval(x);
            }

        }, 1000);

    </script>

    <script>

        function musicBannerCountdown(endTime) {

            let end = new Date(endTime).getTime();

            let x = setInterval(function () {

                let now = new Date().getTime();
                let distance = end - now;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("mb-days").innerHTML = "00";
                    document.getElementById("mb-hours").innerHTML = "00";
                    document.getElementById("mb-minutes").innerHTML = "00";
                    document.getElementById("mb-seconds").innerHTML = "00";
                    return;
                }

                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                let minutes = Math.floor((distance / (1000 * 60)) % 60);
                let seconds = Math.floor((distance / 1000) % 60);

                document.getElementById("mb-days").innerHTML = days;
                document.getElementById("mb-hours").innerHTML = hours;
                document.getElementById("mb-minutes").innerHTML = minutes;
                document.getElementById("mb-seconds").innerHTML = seconds;

            }, 1000);
        }

        // Laravel blade থেকে date pass করা
        let bannerTime = "<?php echo e($basicinfo->banner_time); ?>";

        musicBannerCountdown(bannerTime);

    </script>
    <script>
        const targetDate = new Date("<?php echo e($basicinfo->flash_sale_time); ?>").getTime();

        const timer = setInterval(function () {

            const now = new Date().getTime();
            const distance = targetDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("flashsale-days").innerHTML = String(Math.max(days, 0)).padStart(2, '0');
            document.getElementById("flashsale-hours").innerHTML = String(Math.max(hours, 0)).padStart(2, '0');
            document.getElementById("flashsale-minutes").innerHTML = String(Math.max(minutes, 0)).padStart(2, '0');
            document.getElementById("flashsale-seconds").innerHTML = String(Math.max(seconds, 0)).padStart(2, '0');

            if (distance < 0) {
                clearInterval(timer);
            }

        }, 1000);
    </script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/maincontent.blade.php ENDPATH**/ ?>