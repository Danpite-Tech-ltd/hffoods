<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>- Create Landingpage
    <?php $__env->stopSection(); ?>
    <style>
        .card {
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
        }

        .select2-container .select2-dropdown {
            max-height: 300px;
            overflow: hidden;
        }

        .select2-results {
            max-height: 250px;
            overflow-y: auto;
        }

        .select2-search--dropdown {
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .select2-results__option {
            padding: 10px;
            font-size: 14px;
        }

        .select2-results__option--highlighted {
            background-color: #0d6efd !important;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 45px;
            padding: 5px;
        }

        input {
            border:1px solid #ddd !important;
        }
    </style>
    <div class="container mt-5">
        <div class="p-4 shadow card">
            <h4 class="mb-4">Create Landing Page</h4>

            <form action="<?php echo e(route('admin.campaigns.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Landingpage Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Image2</label>
                        <input type="file" class="form-control" name="image2">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Old Price Title</label>
                        <input type="text" class="form-control" name="oldprice_title">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Price Title</label>
                        <input type="text" class="form-control" name="price_title">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Select Products</label>
                        <select class="form-control select2" multiple name="product_id[]">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>">
                                    <?php echo e($value->ProductName); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Why Choose Us</label>
                        <textarea id="why_choose" name="why_choose"></textarea>
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- Summernote CSS -->
    <!-- JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select Products",
                allowClear: true,
                width: '100%',
                closeOnSelect: false
            });
        });
    </script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {

            // Summernote init
            $('#description').summernote({
                placeholder: 'Write description here...',
                tabsize: 2,
                height: 200
            });
            $('#why_choose').summernote({
                placeholder: 'Write description here...',
                tabsize: 2,
                height: 200
            });

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/backend/content/campaign/create.blade.php ENDPATH**/ ?>