<?php $__env->startSection('maincontent'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(env('APP_NAME')); ?>- Edit Add Banners
<?php $__env->stopSection(); ?>
<style>
    div#roleinfo_length {
        color: red;
    }

    div#roleinfo_filter {
        color: red;
    }

    div#roleinfo_info {
        color: red;
    }

</style>

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="h-100 bg-secondary rounded p-4 pb-0">
                <div class="d-flex align-items-center justify-content-between" style="width: 50%;float:left;">
                    <h6 class="mb-0">Addbanners List</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <form name="form" action="<?php echo e(route('admin.addbanners.update', $addbanner->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="add_link" id="add_link" placeholder="Add Link"
                            value="<?php echo e($addbanner->add_link); ?>">
                        <label for="floatingInput">Add Link</label>
                    </div>
                    <div class="mt-4 mb-4">
                        <input class="form-control form-control-lg bg-dark" name="add_image" id="add_image" type="file">
                    </div>

                    <div class="m-3 ms-0 mb-0" style="text-align: center;height: 170px;margin-top:20px !important">
                        <h4 style="width:30%;float: left;text-align: left;">Image : </h4>
                        <div id="previmg" style="float: left;width:70%">
                            <img src="<?php echo e(asset($addbanner->add_image)); ?>" alt="" srcset="" style="height: 140px;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group mt-4 pt-4" style="text-align: right">
                        <div class="submitBtnSCourse">
                            <a href="<?php echo e(route('admin.addbanners.index')); ?>" class="btn btn-dark btn-block"
                                style="float: left">Close</a>
                            <button type="submit" name="btn"
                                class="btn btn-primary AddCourierBtn btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/backend/content/addbanner/edit.blade.php ENDPATH**/ ?>