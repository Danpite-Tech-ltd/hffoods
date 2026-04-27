<?php if(count($cartProducts) > 0): ?>
    <div class="cart-item product-summary">
        <?php $__empty_1 = true; $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="row">
                <div class="col-4 col-xs-4">
                    <div class="image">
                        <a href="#"><img src="<?php echo e(asset($item->image)); ?>" alt=""></a>
                    </div>
                </div>
                <div class="col-7 col-xs-7" style="padding-left: 0">
                    <h3 class="name"><a href="#" style="font-size: 11px;color: black;"><?php echo e($item->name); ?></a>
                    </h3>
                    <div class="price">৳<?php echo e($item->price); ?></div>
                </div>
                <div class="col-1 col-xs-1 action"> <a type="button" style="cursor: pointer"
                        onclick="removeFromCartItemHead('<?php echo e($item->rowId); ?>')"><i class="fa fa-trash"></i></a> </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>

    </div>
    <!-- /.cart-item -->
    <div class="clearfix"></div>
    <hr>
    <div class="clearfix cart-total">
        <div class="pull-right"> <span class="text">Sub Total :</span><span
                class='price'>৳<?php echo e(Cart::subtotal()); ?></span>
        </div>
        <div class="clearfix"></div>
        <a href="<?php echo e(url('/checkout')); ?>" class="btn btn-upper btn-block m-t-20" style="width: 100%;background:#212129;color:#fff">Checkout</a>
    </div>
    <!-- /.cart-total-->
<?php else: ?>
    <div class="clearfix cart-total" style="    background: #e1dcdc;  padding: 10px; font-size: 22px;">
        Nothing here...!
    </div>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/product/checkcartview.blade.php ENDPATH**/ ?>