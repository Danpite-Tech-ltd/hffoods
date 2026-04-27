<?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <?php if(isset(App\Models\User::where('id', $review->user_id)->first()->profile)): ?>
                    <img src="<?php echo e(asset(App\Models\User::where('id', $review->user_id)->first()->profile)); ?>"
                        style="width:60px;height:60px">
                <?php else: ?>
                    <img src="<?php echo e(asset('public/profile-user.png')); ?>" style="width:60px;height:60px">
                <?php endif; ?>
                <div class="info ps-2">
                    <h6 class="m-0" style="font-weight: bold;font-size: 18px;">
                        <?php echo e(App\Models\User::where('id', $review->user_id)->first()->name); ?></h6>
                    <div class="review">
                        <div class="d-flex">
                            <div class="star">
                                <?php if($review->rating == 1): ?>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                <?php elseif($review->rating == 2): ?>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                <?php elseif($review->rating == 3): ?>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                <?php elseif($review->rating == 4): ?>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;"></span>
                                <?php else: ?>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                    <span class="fas fa-star" style="font-size:16px;" id="checked"></span>
                                <?php endif; ?>
                            </div>
                            <span style="padding-left: 10px;padding-top: 2px;"><?php echo e(date('d M, Y')); ?></span>
                        </div>
                        <p>
                            <?php echo e($review->messages); ?>

                        </p>
                        <?php if(isset($review->file)): ?>
                            <img src="<?php echo e(asset($review->file)); ?>" alt="" width="60px">
                        <?php else: ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="d-flex" style="justify-content: space-around;font-size: 26px;">
                <span><span class="stss"
                        id="likeof<?php echo e($review->id); ?>"><?php echo e(App\Models\Like::where('review_id', $review->id)->get()->count()); ?></span><i
                        class="fas fa-thumbs-up" id="likedone<?php echo e($review->id); ?>"
                        onclick="givelike(<?php echo e($review->id); ?>)"></i></span>
                <span><span class="stss"
                        id="shareof<?php echo e($review->id); ?>"><?php echo e(App\Models\Share::where('review_id', $review->id)->get()->count()); ?></span><i
                        class="fas fa-heart" id="sharedone<?php echo e($review->id); ?>"
                        onclick="giveshare(<?php echo e($review->id); ?>)"></i></span>
            </div>


        </div>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="card">
        <div class="card-body">
            No review found !
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/product/review.blade.php ENDPATH**/ ?>