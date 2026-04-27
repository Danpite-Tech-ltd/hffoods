<div class="text-cart" style="padding-top: 20px">
    <i class="fa fa-check" id="checkIconCart"></i>
    <h3 style="margin-top:0;color: #212129; margin-bottom: 0;"><span id="itemCount"><?php echo e(count($cartProducts)); ?></span> Item
        added to your cart!</h3>
</div>
<button type="button" id="closebtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
        aria-hidden="true">×</span></button>
<h4 style="margin-top:0;text-align: center; font-weight: bold; margin-bottom: 0;">Cart Items</h4>
<hr style="margin-top: 10px;margin-bottom: 10px">
<div id="itemlest">
    <?php $__empty_1 = true; $__currentLoopData = $cartProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="d-flex align-items-center" style="margin-bottom:10px">
            <div class="dc-image">
                <a href="<?php echo e(asset($item->image)); ?>">
                    <img src="<?php echo e(asset($item->image)); ?>" class="img-fluid" alt=""
                        style="height: 70px;">
                </a>
            </div>
            <div class="dc-content">
                <span class="mb-1 d-block dc-product-name text-capitalize strong-600">
                    <a href="#" style="color: black">
                        <?php echo e($item->name); ?>

                    </a>
                </span>
                <span class="pt-0 pr-3 d-block" id="proPrice">  <small
                    style="color: #000000;font-size: 16px;font-weight: bold;">
                    <?php if(isset($item->options['size'])): ?>
                        Size : <?php echo e($item->options['size']); ?>,&nbsp;
                    <?php endif; ?>
                    <?php if(isset($item->options['size'])): ?>
                        Color : <?php echo e($item->options['color']); ?>,&nbsp;
                    <?php endif; ?>
                    <?php if(isset($item->options['sigment'])): ?>
                        Sigment : <?php echo e($item->options['sigment']); ?>

                    <?php endif; ?>
                </small></span>
                <span class="dc-quantity">x<?php echo e($item->qty); ?></span>
                <span class="dc-price">৳<?php echo e($item->qty * $item->price); ?></span>
            </div>
            <div class="dc-actions">
                <button type="button" onClick="removeFromCartItem('<?php echo e($item->rowId); ?>')" id="cartIconCloss">
                    ×
                </button>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
</div>
<div class="py-3 dc-item">
    <span class="subtotal-text">Subtotal</span>
    <span class="subtotal-amount">৳ <span id="totalAmountCart"><?php echo e(Cart::subtotal()); ?></span></span>
</div>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/product/cartproductmodal.blade.php ENDPATH**/ ?>