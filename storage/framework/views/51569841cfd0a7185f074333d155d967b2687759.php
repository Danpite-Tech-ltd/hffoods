<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>- Landingpage List
    <?php $__env->stopSection(); ?>

    <div class="mt-4 container-fluid">
        <div class="shadow card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Campaign List</h5>
                <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="btn btn-primary btn-sm">Add Campaign</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped" id="campaignTable" style="border:1px solid #ddd">
                    <thead class="table-dark" style="border:1px solid #ddd">
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price Title</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>

                                <td>
                                    <img src="<?php echo e(asset($campaign->image)); ?>" width="60" height="60" style="object-fit:cover;">
                                </td>

                                <td style="max-width:250px;">
                                    <?php echo e(Str::limit($campaign->name, 60)); ?>

                                </td>

                                <td>
                                    <small class="text-muted d-block"><?php echo e($campaign->oldprice_title); ?></small>
                                    <strong><?php echo e($campaign->price_title); ?></strong>
                                </td>

                                <td>
                                    <?php
                                        $products = json_decode($campaign->product_id, true);
                                    ?>

                                    <?php if($products): ?>
                                        <span class="badge bg-info">
                                            <?php echo e(count($products)); ?> Products
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($campaign->status == 1): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="<?php echo e(route('admin.campaigns.show', $campaign->slug)); ?>"
                                        class="btn btn-sm btn-info">Show</a>

                                    <a href="<?php echo e(route('admin.campaigns.edit', $campaign->id)); ?>"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?php echo e(route('admin.campaigns.destroy', $campaign->id)); ?>" method="POST"
                                        style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure to delete this campaign?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/backend/content/campaign/index.blade.php ENDPATH**/ ?>