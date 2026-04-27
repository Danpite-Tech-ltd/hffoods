<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> <?php echo $__env->yieldContent('title'); ?> </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset(App\Models\Basicinfo::first()->favicon)); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset(App\Models\Basicinfo::first()->favicon)); ?>"/>
    
    <?php echo $__env->make('backend.partials.links.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('subcss'); ?>
    <style>

        .scrollable-element {
          scrollbar-color: red yellow !important;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: red;
        }
    </style>
</head>

<body style="font-size:14px !important;">
    <div class="p-0 container-fluid position-relative d-flex">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php echo $__env->make('backend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php echo $__env->make('backend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start  main content-->
            <?php echo $__env->yieldContent('maincontent'); ?>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <?php echo $__env->make('backend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    
    <?php echo $__env->make('backend.partials.links.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('subjs'); ?>

    <script>
        <?php if(Session::has('message')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("<?php echo e(session('message')); ?>");
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>
    </script>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/backend/master.blade.php ENDPATH**/ ?>