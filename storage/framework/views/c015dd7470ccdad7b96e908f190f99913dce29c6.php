<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>- Video Gallery
    <?php $__env->stopSection(); ?>

    <!-- Best Selling and all Products -->
    <div class="container p-0 pb-2 ">

        <div class="video-gallery">
            <div class="container">
                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $video_galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video_gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <iframe style="width:100%;height: 100% !important;aspect-ratio:1/1;border-radius: 4px;"
                                src="https://www.youtube.com/embed/<?php echo e($video_gallery->menu_banner); ?>">
                            </iframe>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/video_gallery.blade.php ENDPATH**/ ?>