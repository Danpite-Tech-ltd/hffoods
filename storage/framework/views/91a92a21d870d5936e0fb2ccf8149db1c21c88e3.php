<?php $__env->startSection('maincontent'); ?>
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1>404</h1>
                        <p>We are sorry, the page you've requested is not available. </p>
                        <form role="form" class="outer-top-vs outer-bottom-xs">
                            <input placeholder="Search" autocomplete="off">
                            <button class="  btn-default le-button">Go</button>
                        </form>
                        <a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> Go To Homepage</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/errors/404.blade.php ENDPATH**/ ?>