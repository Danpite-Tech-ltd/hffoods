<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>-Search Products
    <?php $__env->stopSection(); ?>

    <style>
        #checked {
            color: orange;
        }

        .star {
            font-size: 8px !important;
        }

        #featureimageCt {
            height: 300px;
            width: auto;
            padding: 2px;
            padding-top: 0;
        }

        @media  only screen and (max-width: 600px) {
            #featureimageCt {
                height: 220px;
                width: auto;
                padding: 2px;
                padding-top: 0;
            }
        }
    </style>
    <div class="body-content outer-top-xs">
        <div class="pt-2 breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="p-0 breadcrumb-inner">
                            <ul class="mb-0 list-inline list-unstyled">
                                <li><a href="#"
                                        style="text-transform: capitalize !important;color: #888;padding-right: 12px;font-size: 12px;">Home
                                        > Search > <span class="active"></span>Products</span>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.breadcrumb-inner -->
                </div>
            </div>
            <!-- /.container -->
        </div>

        <div class="container">

            <div class="row g-4">
                <!-- <div class="owl-carousel " id="promotionalofferSlide"> -->
                <?php $__empty_1 = true; $__currentLoopData = $searchproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
        <!-- /.container -->

    </div>
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
                        $('#cateoryPro #likereactof' + id).text(data.total);
                        $('#cateoryPro #likereactdone' + id).css('color', 'orange');
                    } else if (data.sigment == 'unlike') {
                        $('#cateoryPro #likereactof' + id).text(data.total);
                        $('#cateoryPro #likereactdone' + id).css('color', 'black');
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
                        $('#cateoryPro #lovereactof' + id).text(data.total);
                        $('#cateoryPro #lovereactdone' + id).css('color', 'orange');
                    } else {
                        $('#cateoryPro #lovereactof' + id).text(data.total);
                        $('#cateoryPro #lovereactdone' + id).css('color', 'black');
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/product/mainsearch.blade.php ENDPATH**/ ?>