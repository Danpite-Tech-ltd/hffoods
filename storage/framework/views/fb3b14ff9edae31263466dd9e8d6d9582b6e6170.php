<?php
$admin = App\Models\Admin::where('id', Auth::guard('admin')->user()->id)->first();
?>
<div class="pb-3 sidebar" style="background: #d7dceb !important">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="<?php echo e(url('/admin/dashboard')); ?>" class="mx-4 mb-3 navbar-brand">
            <h3 class="text-primary"><img src="<?php echo e(asset(\App\Models\Basicinfo::first()->logo)); ?>" alt="logo" style="width:100%"></h3>
        </a>

        <div class="navbar-nav w-100">
            <a href="<?php echo e(url('/admin/dashboard')); ?>" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <?php if($admin->hasRole('superadmin') || $admin->hasRole('manager') || $admin->hasRole('admin')): ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Admins</a>
                    <div class="bg-transparent border-0 dropdown-menu">

                        <?php if($admin->hasRole('superadmin') || $admin->hasRole('admin')): ?>
                        <a href="<?php echo e(route('admin.admins.index')); ?>" class="dropdown-item">Admins</a>
                        <?php endif; ?>
                        <a href="<?php echo e(url('admin/block-user')); ?>" class="dropdown-item">Block Ip</a>
                    </div>
                </div>

                <?php if($admin->hasRole('manager') || $admin->hasRole('superadmin')): ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Accounts</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(url('admin/account-deposit/Courier')); ?>" class="dropdown-item">Courier Payment</a>
                        <a href="<?php echo e(url('admin/account-deposit/Office Sale')); ?>" class="dropdown-item">Office Sale Payment</a>
                        <a href="<?php echo e(url('admin/account-deposit/Wholesale')); ?>" class="dropdown-item">Wholesale Payment</a>
                        <a href="<?php echo e(url('admin/account-deposit/Total')); ?>" class="dropdown-item">Total Payment</a>
                        <a href="<?php echo e(url('admin/expense-cost/Boost Cost')); ?>" class="dropdown-item">Boost Cost</a>
                        <a href="<?php echo e(url('admin/expense-cost/Office Cost')); ?>" class="dropdown-item">Office Cost</a>
                        <a href="<?php echo e(url('admin/expense-cost/Bank Deposit')); ?>" class="dropdown-item">Bank Deposit</a>
                        <a href="<?php echo e(url('admin/expense-cost/Total Cost')); ?>" class="dropdown-item">Total Cost</a>
                    </div>
                </div>
                <?php endif; ?>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Store</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('admin.categorys.index')); ?>" class="dropdown-item">Category</a>
                        <a href="<?php echo e(route('admin.subcategorys.index')); ?>" class="dropdown-item">Sub Category</a>
                        <!-- <a href="<?php echo e(route('admin.brands.index')); ?>" class="dropdown-item">Brand</a> -->
                        <a href="<?php echo e(route('admin.attrvalues.index')); ?>" class="dropdown-item">Size & Sigment</a>
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="dropdown-item">Single Products</a>
                        <a href="<?php echo e(route('mainproducts.index')); ?>" class="dropdown-item">Varient Products</a>
                        <a href="<?php echo e(route('purchases.index')); ?>" class="dropdown-item">Purchase</a>
                        <a href="<?php echo e(route('returns.index')); ?>" class="dropdown-item">Return</a>
                        <a href="<?php echo e(url('admin/stock/overview')); ?>" class="dropdown-item">Inventory</a>
                        <a href="<?php echo e(route('orderchange.bybarcode')); ?>" class="dropdown-item">Auto Shipment</a>
                        <a href="<?php echo e(route('orderchange.manualbarcode')); ?>" class="dropdown-item">Manual Shipment</a>
                        <a href="<?php echo e(route('orderchange.autoreturn')); ?>" class="dropdown-item">Auto Return</a>
                        <a href="<?php echo e(route('orderchange.manualreturn')); ?>" class="dropdown-item">Manual Return</a>
                        <!--<a href="<?php echo e(route('stocks.index')); ?>" class="dropdown-item">Stock</a>-->
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Landingpage</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="dropdown-item">Create Landingpage</a>
                        <a href="<?php echo e(route('admin.campaigns.index')); ?>" class="dropdown-item">Landingpage List</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Orders</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(url('admin/create/order')); ?>" class="dropdown-item">Create Order</a>
                        <a href="<?php echo e(url('admin_order/Pending')); ?>" class="dropdown-item">Orders</a>
                        <a href="<?php echo e(url('incomplete_order/Incomplete')); ?>" class="dropdown-item">Incomplete</a>
                        <a href="<?php echo e(url('admin/maps')); ?>" class="dropdown-item">Maps</a>
                        <a href="<?php echo e(url('complain/Pending')); ?>" class="dropdown-item">Complane Box</a>
                    </div>
                </div>


                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Wholesale</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('wsales.index')); ?>" class="dropdown-item">W-sale</a>
                        <a href="<?php echo e(route('wcustomers.index')); ?>" class="dropdown-item">W-customer</a>
                        <a href="<?php echo e(route('wsalestocks.index')); ?>" class="dropdown-item">W-sale Stock</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="far fa-file-alt me-2"></i>Pages</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('admin.blogs.index')); ?>" class="dropdown-item">Blog</a>
                        <a href="<?php echo e(route('admin.sliders.index')); ?>" class="dropdown-item">Sliders</a>
                        <a href="<?php echo e(route('admin.addbanners.index')); ?>" class="dropdown-item">Adds</a>
                        <a href="<?php echo e(route('admin.menus.index')); ?>" class="dropdown-item d-none">Youtube Gallery</a>
                        <a href="<?php echo e(url('admin/information/about_us')); ?>" class="dropdown-item">About Us</a>
                        <a href="<?php echo e(url('admin/information/contact_us')); ?>" class="dropdown-item">Contact Us</a>
                        <a href="<?php echo e(url('admin/information/faq')); ?>" class="dropdown-item">FAQ</a>
                        <a href="<?php echo e(url('admin/information/news')); ?>" class="dropdown-item">Our News</a>
                        <a href="<?php echo e(url('admin/information/terms_codition')); ?>" class="dropdown-item">Terms Conditions</a>
                        <a href="<?php echo e(url('admin/information/privacy_policy')); ?>" class="dropdown-item">Privacy Policy</a>
                        <a href="<?php echo e(url('admin/information/refund_return_policy')); ?>" class="dropdown-item">Refund & Return Policy</a>
                        <a href="<?php echo e(url('admin/information/shipping_policy')); ?>" class="dropdown-item">Shipping Policy</a>
                        <a href="<?php echo e(url('admin/information/payment_policy')); ?>" class="dropdown-item">Payment Policy</a>
                        <a href="<?php echo e(url('admin/information/contact_info')); ?>" class="dropdown-item">Contact Information</a>

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fas fa-cog fa-spin me-2"></i>Settings</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('admin.basicinfos.index')); ?>" class="dropdown-item">Settings</a>
                        <a href="<?php echo e(route('couriers.index')); ?>" class="dropdown-item">Courier</a>
                        <a href="<?php echo e(route('cities.index')); ?>" class="dropdown-item">City</a>
                        <a href="<?php echo e(route('zones.index')); ?>" class="dropdown-item">Zone</a>
                        
                        <a href="<?php echo e(route('payments.index')); ?>" class="dropdown-item">Payment</a>
                        <a href="<?php echo e(route('paymenttypes.index')); ?>" class="dropdown-item">Payment Method</a>
                        <a href="<?php echo e(route('admin.coupons.index')); ?>" class="dropdown-item d-none">Coupons</a>
                        <!-- <a href="<?php echo e(route('admin.reviews.index')); ?>" class="dropdown-item">Reviews</a> -->
                         <a href="<?php echo e(route('admin.brands.index')); ?>" class="dropdown-item">Brand</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="far fa-file-alt me-2"></i>Report</a>
                    <div class="bg-transparent border-0 dropdown-menu">
                        <a href="<?php echo e(route('courieruserreport')); ?>" class="dropdown-item">Salse Report</a>
                        <a href="<?php echo e(route('courierreport')); ?>" class="dropdown-item">Courier Report</a>
                        <a href="<?php echo e(route('userreport')); ?>" class="dropdown-item">User Report</a>
                        <a href="<?php echo e(route('productreport')); ?>" class="dropdown-item">Product</a>
                        <a href="<?php echo e(url('admin/download/orderinfo')); ?>" class="dropdown-item">Download Order</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($admin->hasRole('user')): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Orders</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(url('admin/create/order')); ?>" class="dropdown-item">Create Order</a>
                    <a href="<?php echo e(url('admin_order/Pending')); ?>" class="dropdown-item">Orders</a>
                    <a href="<?php echo e(url('incomplete_order/Incomplete')); ?>" class="dropdown-item">Incomplete</a>
                    <a href="<?php echo e(url('admin/maps')); ?>" class="dropdown-item">Maps</a>
                    <a href="<?php echo e(url('complain/Pending')); ?>" class="dropdown-item">Complane Box</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if($admin->hasRole('accounts')): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Accounts</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(url('admin/account-deposit/Courier')); ?>" class="dropdown-item">Courier Payment</a>
                    <a href="<?php echo e(url('admin/account-deposit/Office Sale')); ?>" class="dropdown-item">Office Sale Payment</a>
                    <a href="<?php echo e(url('admin/account-deposit/Wholesale')); ?>" class="dropdown-item">Wholesale Payment</a>
                    <a href="<?php echo e(url('admin/account-deposit/Total')); ?>" class="dropdown-item">Total Payment</a>
                    <a href="<?php echo e(url('admin/expense-cost/Boost Cost')); ?>" class="dropdown-item">Boost Cost</a>
                    <a href="<?php echo e(url('admin/expense-cost/Office Cost')); ?>" class="dropdown-item">Office Cost</a>
                    <a href="<?php echo e(url('admin/expense-cost/Bank Deposit')); ?>" class="dropdown-item">Bank Deposit</a>
                    <a href="<?php echo e(url('admin/expense-cost/Total Cost')); ?>" class="dropdown-item">Total Cost</a>
                </div>
            </div>
             <?php endif; ?>
            <?php if($admin->hasRole('accounts') || $admin->hasRole('store')): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Store</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('admin.categorys.index')); ?>" class="dropdown-item">Category</a>
                    <a href="<?php echo e(route('admin.subcategorys.index')); ?>" class="dropdown-item">Sub Category</a>
                    
                    <a href="<?php echo e(route('admin.attrvalues.index')); ?>" class="dropdown-item">Size & Sigment</a>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="dropdown-item">Single Products</a>
                    <a href="<?php echo e(route('mainproducts.index')); ?>" class="dropdown-item">Varient Products</a>
                    <a href="<?php echo e(route('purchases.index')); ?>" class="dropdown-item">Purchase</a>
                    <a href="<?php echo e(route('returns.index')); ?>" class="dropdown-item">Return</a>
                    <a href="<?php echo e(url('admin/stock/overview')); ?>" class="dropdown-item">Inventory</a>
                    <a href="<?php echo e(route('orderchange.bybarcode')); ?>" class="dropdown-item">Auto Shipment</a>
                    <a href="<?php echo e(route('orderchange.manualbarcode')); ?>" class="dropdown-item">Manual Shipment</a>
                    <a href="<?php echo e(route('orderchange.autoreturn')); ?>" class="dropdown-item">Auto Return</a>
                    <a href="<?php echo e(route('orderchange.manualreturn')); ?>" class="dropdown-item">Manual Return</a>
                    <!--<a href="<?php echo e(route('stocks.index')); ?>" class="dropdown-item">Stock</a>-->
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Orders</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(url('admin/create/order')); ?>" class="dropdown-item">Create Order</a>
                    <a href="<?php echo e(url('admin_order/Pending')); ?>" class="dropdown-item">Orders</a>
                    <a href="<?php echo e(url('incomplete_order/Incomplete')); ?>" class="dropdown-item">Incomplete</a>
                    <a href="<?php echo e(url('admin/maps')); ?>" class="dropdown-item">Maps</a>
                    <a href="<?php echo e(url('complain/Pending')); ?>" class="dropdown-item">Complane Box</a>
                    <a href="<?php echo e(url('admin/block-user')); ?>" class="dropdown-item">Block Ip</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Wholesale</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('wsales.index')); ?>" class="dropdown-item">W-sale</a>
                    <a href="<?php echo e(route('wcustomers.index')); ?>" class="dropdown-item">W-customer</a>
                    <a href="<?php echo e(route('wsalestocks.index')); ?>" class="dropdown-item">W-sale Stock</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Report</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('courieruserreport')); ?>" class="dropdown-item">Salse Report</a>
                    <a href="<?php echo e(route('courierreport')); ?>" class="dropdown-item">Courier Report</a>
                    <a href="<?php echo e(route('userreport')); ?>" class="dropdown-item">User Report</a>
                    <a href="<?php echo e(route('productreport')); ?>" class="dropdown-item">Product</a>
                    <a href="<?php echo e(url('admin/download/orderinfo')); ?>" class="dropdown-item">Download Order</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if($admin->hasRole('support')): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Orders</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(url('admin/create/order')); ?>" class="dropdown-item">Create Order</a>
                    <a href="<?php echo e(url('admin_order/Pending')); ?>" class="dropdown-item">Orders</a>
                    <a href="<?php echo e(url('incomplete_order/Incomplete')); ?>" class="dropdown-item">Incomplete</a>
                    <a href="<?php echo e(url('admin/maps')); ?>" class="dropdown-item">Maps</a>
                    <a href="<?php echo e(url('complain/Pending')); ?>" class="dropdown-item">Complane Box</a>
                    <a href="<?php echo e(url('admin/block-user')); ?>" class="dropdown-item">Block Ip</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Report</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('courieruserreport')); ?>" class="dropdown-item">Salse Report</a>
                    <a href="<?php echo e(route('courierreport')); ?>" class="dropdown-item">Courier Report</a>
                    <a href="<?php echo e(route('userreport')); ?>" class="dropdown-item">User Report</a>
                    <a href="<?php echo e(route('productreport')); ?>" class="dropdown-item">Product</a>
                    <a href="<?php echo e(url('admin/download/orderinfo')); ?>" class="dropdown-item">Download Order</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if($admin->hasRole('storeassistant')): ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Store</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('orderchange.bybarcode')); ?>" class="dropdown-item">Auto Shipment</a>
                    <a href="<?php echo e(route('orderchange.manualbarcode')); ?>" class="dropdown-item">Manual Shipment</a>
                    <a href="<?php echo e(route('orderchange.autoreturn')); ?>" class="dropdown-item">Auto Return</a>
                    <a href="<?php echo e(route('orderchange.manualreturn')); ?>" class="dropdown-item">Manual Return</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Orders</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(url('admin/create/order')); ?>" class="dropdown-item">Create Order</a>
                    <a href="<?php echo e(url('admin_order/Pending')); ?>" class="dropdown-item">Orders</a>
                    <a href="<?php echo e(url('incomplete_order/Incomplete')); ?>" class="dropdown-item">Incomplete</a>
                    <a href="<?php echo e(url('admin/maps')); ?>" class="dropdown-item">Maps</a>
                    <a href="<?php echo e(url('complain/Pending')); ?>" class="dropdown-item">Complane Box</a>
                    <a href="<?php echo e(url('admin/block-user')); ?>" class="dropdown-item">Block Ip</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Report</a>
                <div class="bg-transparent border-0 dropdown-menu">
                    <a href="<?php echo e(route('courieruserreport')); ?>" class="dropdown-item">Salse Report</a>
                    <a href="<?php echo e(route('courierreport')); ?>" class="dropdown-item">Courier Report</a>
                    <a href="<?php echo e(route('userreport')); ?>" class="dropdown-item">User Report</a>
                    <a href="<?php echo e(route('productreport')); ?>" class="dropdown-item">Product</a>
                    <a href="<?php echo e(url('admin/download/orderinfo')); ?>" class="dropdown-item">Download Order</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </nav>
</div>


<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/backend/partials/sidebar.blade.php ENDPATH**/ ?>