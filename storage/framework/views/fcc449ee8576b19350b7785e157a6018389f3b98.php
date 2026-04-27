<?php $__env->startSection('maincontent'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(env('APP_NAME')); ?>- Category Product
<?php $__env->stopSection(); ?>

<style>
    .product{
            margin-top: 4px !important;

    }

    #featureimagess{
        width: 100%;
        padding: 0px;
        padding-top: 0;
        height:180px;
    }
    #checked {
        color: orange;
    }
    .star{
        font-size: 8px !important;
    }
</style>
<style>
    .pagination-wrapper {
        text-align: center;
        margin-top: 30px;
    }

    .pagination {
        list-style: none;
        display: inline-flex;
        gap: 6px;
        padding: 0;
    }

    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 14px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 6px;
    }

    .pagination li.active span {
        background: #ff6a00;
        color: #fff;
        border-color: #ff6a00;
    }

    .pagination li a:hover {
        background: #f5f5f5;
    }

    .pagination li.disabled span {
        color: #aaa;
    }
</style>
<!-- /.breadcrumb -->
<div class="container body-content outer-top-xs">

    <div class="pt-2 breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="p-0 breadcrumb-inner">
                        <ul class="mb-0 list-inline list-unstyled">
                            <li style="list-style:none;font-size:12px;color:#888;">

                                <a href="<?php echo e(url('/')); ?>"
                                style="text-decoration:none;color:#888;padding-right:6px;text-transform:capitalize;">
                                Home
                                </a>

                                <span style="padding:0 6px;color:#aaa;">/</span>

                                <a style="text-decoration:none;color:#333;font-weight:500;text-transform:capitalize;">
                                    Category
                                </a>

                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /.breadcrumb-inner -->
            </div>
        </div>
    </div>

<style>

.shop-category-box h3{
    font-size:22px;
    font-weight:700;
    /* margin-bottom:20px; */
    margin-top:0;
    color:#333;
}

.category-item{
    display:block;
    text-decoration:none;
    color:#444;
    font-size:16px;
    margin-bottom:12px;
    transition:0.3s;
}

.category-item:hover{
    color:#000;
    padding-left:5px;
}

</style>
    <div class="row ">
        <div class="col-12 col-lg-3">
            <div class="shop-category-box">
                <h3 class="m-0 mb-2">Shop by Subategory</h3>

                <form method="GET" id="subcategoryForm">
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <input
                                type="checkbox"
                                id="subcat<?php echo e($subcategory->id); ?>"
                                name="subcategory[]"
                                value="<?php echo e($subcategory->id); ?>"
                                onchange="document.getElementById('subcategoryForm').submit()"
                                <?php echo e(in_array($subcategory->id, request('subcategory', [])) ? 'checked' : ''); ?>

                            >

                            <label for="subcat<?php echo e($subcategory->id); ?>" style="cursor:pointer;">
                                <?php echo e($subcategory->sub_category_name); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>

            </div>

            <!-- <div class="shop-category-box">
                <h3 class="m-0 mb-2">Price</h3>
                <form method="GET" id="priceForm">
                    <input type="number" name="min_price" placeholder="Min Price" value="<?php echo e(request('min_price')); ?>" class="mb-2 form-control">
                    <input type="number" name="max_price" placeholder="Max Price" value="<?php echo e(request('max_price')); ?>" class="mb-2 form-control">
                    <button type="submit" class="btn btn-primary w-100"> Apply Filter </button>
                </form>
            </div> -->

            <!-- <div class="shop-category-box">
                <h3 class="m-0 mb-2">Shop by Brand</h3>
                <?php
                    $brands = App\Models\Brand::where('status', 'Active')->get();
                ?>

                <form method="GET" id="brandForm">
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <input
                                type="checkbox"
                                id="brand<?php echo e($brand->id); ?>"
                                name="brand[]"
                                value="<?php echo e($brand->id); ?>"

                                onchange="document.getElementById('brandForm').submit()"

                                <?php echo e(in_array($brand->id, request('brand', [])) ? 'checked' : ''); ?>>

                            <label for="brand<?php echo e($brand->id); ?>" style="cursor:pointer;">
                                <?php echo e($brand->brand_name); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </form>

            </div> -->

        </div>



        <div class="col-12 col-lg-9">
            <div style="display: flex;align-items: center;justify-content: space-between;">
                <div style="text-align:left;font-size:14px;color:#666;font-weight:500;margin:20px 0;">
                    Showing <?php echo e($categoryproducts->firstItem()); ?>–<?php echo e($categoryproducts->lastItem()); ?> of <?php echo e($categoryproducts->total()); ?> results
                </div>
                <form method="GET" id="filterForm" style="margin-bottom:0">
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                    <select name="filter" class="w-auto form-select d-inline"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">Filter</option>

                        <option value="latest" <?php echo e(request('filter') == 'latest' ? 'selected' : ''); ?>>
                            Latest Product
                        </option>

                        <option value="oldest" <?php echo e(request('filter') == 'oldest' ? 'selected' : ''); ?>>
                            Oldest Product
                        </option>

                        <option value="low_to_high" <?php echo e(request('filter') == 'low_to_high' ? 'selected' : ''); ?>>
                            Price Low → High
                        </option>

                        <option value="high_to_low" <?php echo e(request('filter') == 'high_to_low' ? 'selected' : ''); ?>>
                            Price High → Low
                        </option>

                        <option value="a_to_z" <?php echo e(request('filter') == 'a_to_z' ? 'selected' : ''); ?>>
                            A → Z
                        </option>

                        <option value="z_to_a" <?php echo e(request('filter') == 'z_to_a' ? 'selected' : ''); ?>>
                            Z → A
                        </option>
                    </select>
                </form>
            </div>

            <!-- /.container -->
            <div class="pt-2 pb-2 row" id="cateoryPro" style="background: white;">

                <?php $__empty_1 = true; $__currentLoopData = $categoryproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                <div class="col-6 col-md-4" style="margin-top:10px;">
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
            <?php if($categoryproducts->hasPages()): ?>
            <div class="pagination-wrapper">
                <ul class="pagination">

                    
                    <?php if($categoryproducts->onFirstPage()): ?>
                        <li class="disabled"><span>«</span></li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo e($categoryproducts->previousPageUrl()); ?>">«</a>
                        </li>
                    <?php endif; ?>

                    
                    <?php for($i = 1; $i <= $categoryproducts->lastPage(); $i++): ?>
                        <?php if($i == $categoryproducts->currentPage()): ?>
                            <li class="active"><span><?php echo e($i); ?></span></li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($categoryproducts->url($i)); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    
                    <?php if($categoryproducts->hasMorePages()): ?>
                        <li>
                            <a href="<?php echo e($categoryproducts->nextPageUrl()); ?>">»</a>
                        </li>
                    <?php else: ?>
                        <li class="disabled"><span>»</span></li>
                    <?php endif; ?>

                </ul>
            </div>
        <?php endif; ?>
        </div>

    </div>

<script>
    $(document).ready(function () {
        $('.quick-shop-btn').on('click', function () {
            var productId = $(this).data('product-id');

            $('#quickShopModalBody').html('<p>Loading...</p>');

            $('#quickShopModal').modal('show');

            $.ajax({
                url: '<?php echo e(url("quick-shop")); ?>/' + productId, // your route
                type: 'GET',
                success: function (response) {
                    $('#quickShopModalBody').html(response);
                },
                error: function () {
                    $('#quickShopModalBody').html('<p>Something went wrong!</p>');
                }
            });
        });
    });

</script>

<!-- <script>
document.querySelectorAll('.wishlist-form').forEach(function (form) {
    form.addEventListener('submit', function () {

        setTimeout(function () {
            window.location.reload();

            setTimeout(function () {
                window.location.reload();
            }, 300);

        }, 300);

    });
});
</script> -->

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/product.blade.php ENDPATH**/ ?>