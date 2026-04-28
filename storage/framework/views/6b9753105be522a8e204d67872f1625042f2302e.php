<?php $__env->startSection('maincontent'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(env('APP_NAME')); ?>-Order Press Successfully
<?php $__env->stopSection(); ?>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class="breadcrumb pt-2">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-inner p-0">
                    <ul class="list-inline list-unstyled mb-0">
                        <li><a href="#"
                                style="text-transform: capitalize !important;color: #888;padding-right: 12px;font-size: 12px;">Home
                                > Order > <span class="active"></span>Successfully</span>
                            </a></li>
                    </ul>
                </div>
                <!-- /.breadcrumb-inner -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <section class="mt-1 mb-3">
        <div class="container">
            <?php if($orders == 'Nothing'): ?>
            <?php else: ?>
                <?php if(isset($orders)): ?> 
                    <div class="card mt-4">
                        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                            <div class="float-left" style="color: red;text-align:center">
                                <h2 class="h4 pb-3" style="color:#198754">আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে | আমাদের কল সেন্টার থেকে ফোন করে আপনার অর্ডারটি কনফার্ম করা হবে | যেকোনো প্রয়োজনে সরাসরি যোগাযোগ করুন আমাদের এই নাম্বারে : <?php echo e(App\Models\Basicinfo::first()->phone_one); ?></h2>
                                <a class="btn btn-primary mt-3" style="background: black; color: white;" href="<?php echo e(url('/')); ?>">প্রোডাক্ট বাছাই করুন</a>
                            </div>
                        </div>
                        <div class="card-body pb-0 ps-0 pe-0">
                            <div class="row">
                                 <div class="col-md-8 m-auto">
                                    <div class="card mt-4">
                                        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                            <div class="float-left" style="color: red;text-align:center"> <b>Current Status : Order has been <?php echo e($orders->status); ?></b> </div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <table class="details-table table" style="border:none">
                                                <tbody style="border:none">
                                                    <tr style="border:none">
                                                        <td class="w-50 strong-600" style="border:none;font-size: 18px;">Order ID:</td>
                                                        <td style="border:none;font-size: 18px;"><?php echo e($orders->invoiceID); ?></td>
                                                    </tr>
                                                    <tr style="border:none">
                                                        <td class="w-50 strong-600" style="border:none;font-size: 18px;">Order Status:</td>
                                                        <td style="border:none;font-size: 18px;">Order has been <?php echo e($orders->status); ?></td>
                                                    </tr>
                                                    <tr style="border:none">
                                                        <td class="w-50 strong-600" style="border:none;font-size: 18px;">Customer Name:</td>
                                                        <td style="border:none;font-size: 18px;"><?php echo e($orders->customers->customerName); ?></td>
                                                    </tr>
                                                    <tr style="border:none">
                                                        <td class="w-50 strong-600" style="border:none;font-size: 18px;">Customer Phone:</td>
                                                        <td style="border:none;font-size: 18px;"><?php echo e($orders->customers->customerPhone); ?></td>
                                                    </tr>
                                                    <tr style="border:none">
                                                        <td class="w-50 strong-600" style="border:none;font-size: 18px;">Customer address:</td>
                                                        <td style="border:none;font-size: 18px;"><?php echo e($orders->customers->customerAddress); ?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="card">
                                                <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                                    <ul class="process-steps clearfix">
                                                        <?php if($orders->status == 'Pending' || $orders->status == 'Hold'): ?>
                                                            <li>
                                                                <div class="icon" style="background:#e62e04;color:white">1</div>
                                                                <div class="title" style="color:red">Pending</div>
                                                            </li>
                                                        <?php else: ?>
                                                            <li>
                                                                <div class="icon">1</div>
                                                                <div class="title">Pending</div>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if($orders->status == 'Ready to Ship' ||
                                                            $orders->status == 'Packaging'): ?>
                                                            <li>
                                                                <div class="icon" style="background:#e62e04;color:white">2</div>
                                                                <div class="title" style="color:red">Confirmed</div>
                                                            </li>
                                                        <?php else: ?>
                                                            <li>
                                                                <div class="icon">2</div>
                                                                <div class="title">Confirmed</div>
                                                            </li>
                                                        <?php endif; ?>
                        
                                                        <?php if($orders->status == 'Shipped'): ?>
                                                            <li>
                                                                <div class="icon" style="background:#e62e04;color:white">3</div>
                                                                <div class="title" style="color:red">On Going</div>
                                                            </li>
                                                        <?php else: ?>
                                                            <li>
                                                                <div class="icon">3</div>
                                                                <div class="title">On Going</div>
                                                            </li>
                                                        <?php endif; ?>
                        
                                                        <?php if($orders->status == 'Completed'): ?>
                                                            <li>
                                                                <div class="icon" style="background:#e62e04;color:white">4</div>
                                                                <div class="title" style="color:red">Delivered</div>
                                                            </li>
                                                        <?php else: ?>
                                                            <li>
                                                                <div class="icon">4</div>
                                                                <div class="title">Canceled</div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                     <table class="">
                                                        <tr>
                                                            <th style="width: 50%">Product</th>
                                                            <th style="width: 30%">Quantity</th>
                                                            <th style="width: 20%">Price</th>
                                                        </tr>
                                                        <?php
                                                        $products = DB::table('orderproducts')->where('order_id', '=', $orders->id)->get();
                                                        foreach ($products as $product) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo e(url('product',App\Models\Product::where('id',$product->product_id)->first()->ProductSlug)); ?>">
                                                                    <img src="<?php echo e(asset(App\Models\Product::where('id',$product->product_id)->first()->ProductImage)); ?>" style="width:60px">
                                                                    <?php echo e($product->productName); ?> <?php if($product->color && $product->size): ?>
                                                                        (Colour: <?php echo e($product->color); ?> , Size: <?php echo e($product->size); ?>)
                                                                    <?php elseif($product->size): ?>
                                                                        (Size: <?php echo e($product->size); ?>)
                                                                    <?php elseif($product->color): ?>
                                                                        (Size: <?php echo e($product->color); ?>)
                                                                    <?php else: ?>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo e($product->quantity); ?></td>
                                                            <td><?php echo e($product->productPrice); ?> Tk</td>
                                                        </tr>
                                                        <?php } ?>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Courier Charge : </th>
                                                                <td><?php echo e($orders->deliveryCharge); ?> Tk</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Total : </th>
                                                                <td><?php echo e($orders->subTotal+$orders->paymentAmount-$orders->discountCharge); ?> Tk</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Discount : </th>
                                                                <td><?php if($orders->discountCharge>0): ?><?php echo e($orders->discountCharge); ?><?php else: ?> 0 <?php endif; ?> Tk</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Paid : </th>
                                                                <td><?php if($orders->paymentAmount>0): ?><?php echo e($orders->paymentAmount); ?><?php else: ?> 0 <?php endif; ?> Tk</td>
                                                            </tr> 
                                                           <tr>
                                                                <td class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Vat : </th>
                                                                <td><?php echo e($orders->vat); ?> Tk</td>
                                                            </tr> 
                                                            <tr>
                                                                <td  class="d-none d-lg-block" colspan="1" style="border: none;"></td>
                                                                <th>Cash On Delivery : </th>
                                                                <td><?php echo e($orders->subTotal+$orders->vat+$orders->paymentAmount+$orders->discountCharge); ?> Tk</td>
                                                            </tr>
                                            
                                                    </table>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php else: ?>
                    <div class="card mt-4">
                        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                            <div class="float-left" style="color: red;text-align:center">No Records Found.Please call
                                our customer care or use Live Chat
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

</div>

<script>
    // Clear the previous ecommerce object.
    dataLayer.push({ ecommerce: null });

    // Push the begin_checkout event to dataLayer.
    dataLayer.push({
        event: "purchase", 
        ecommerce: { 
            currency: "BDT",  
            value: Number("<?php echo $orders->subTotal ?>"),
            shipping: "<?php echo $orders->deliveryCharge ?>",
            tax:0,
            coupon:"",
            affiliation:"", 
            external_id :"<?php echo $orders->id ?>",
            transaction_id:"<?php echo 'TRX45324'.$orders->id ?>", 
            items: [<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    item_name: "<?php echo e($cartInfo->productName); ?>",
                    item_id: "<?php echo e($cartInfo->product_id); ?>",
                    price: Number("<?php echo e($cartInfo->productPrice); ?>"),  
                    item_size: "<?php echo e($cartInfo->size); ?>",
                    item_color: "<?php echo e($cartInfo->color); ?>",
                    currency: "BDT",
                    quantity: <?php echo e($cartInfo->quantity ?? 0); ?>

                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            more:[
                {
                    Customer_Name:"<?php echo $orders->customers->customerName ?>", 
                    Customer_Address:"<?php echo $orders->customers->customerAddress ?>", 
                    Customer_Phone_Number:"<?php echo $orders->customers->customerPhone ?>", 
                    Customer_Country:'Bangladesh', 
                    Customer_Visitor_ID :"<?php echo $orders->customers->id ?>", 
                    payment_method:"Cash On Delivery", 
                }
            ]
        }
    });
    
</script>

<style>
    .process-steps {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .process-steps li {
        width: 25%;
        float: left;
        text-align: center;
        position: relative;
    }

    .process-steps li .icon {
        height: 30px;
        width: 30px;
        margin: auto;
        background: #fff;
        border-radius: 50%;
        line-height: 30px;
        font-size: 14px;
        font-weight: 700;
        color: #adadad;
        position: relative;
    }

    .process-steps li .title {
        font-weight: 600;
        font-size: 13px;
        color: #777;
        margin-top: 8px;
        margin-bottom: 0;
    }

    .process-steps li+li:after {
        position: absolute;
        content: "";
        height: 3px;
        width: calc(100% - 30px);
        background: #fff;
        top: 14px;
        z-index: 0;
        right: calc(50% + 15px);
    }

    .breadcrumb {
        padding: 5px 0;
        border-bottom: 1px solid #e9e9e9;
        background-color: #fafafa;
    }

    .search-area .search-button {
        border-radius: 0px 3px 3px 0px;
        display: inline-block;
        float: left;
        margin: 0px;
        padding: 5px 15px 6px;
        text-align: center;
        background-color: #e62e04;
        border: 1px solid #e62e04;
    }

    .search-area .search-button:after {
        color: #fff;
        content: "\f002";
        font-family: fontawesome;
        font-size: 16px;
        line-height: 9px;
        vertical-align: middle;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/cart/payment.blade.php ENDPATH**/ ?>