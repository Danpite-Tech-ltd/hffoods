

<?php $__env->startSection('maincontent'); ?>
    <?php $__env->startSection('title'); ?>
        <?php echo e(env('APP_NAME')); ?>-<?php echo e($title); ?>

    <?php $__env->stopSection(); ?>

    <div class="body-content outer-top-xs">
        <div class="pt-2 breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="p-0 breadcrumb-inner">
                        <ul class="mb-0 list-inline list-unstyled">
                            <li><a href="<?php echo e(url('/')); ?>"
                                    style="text-transform: capitalize !important;color: #888;padding-right: 12px;font-size: 12px;">Home
                                    > <?php echo e($title); ?>

                                </a></li>
                        </ul>
                    </div>
                    <!-- /.breadcrumb-inner -->
                </div>
            </div>
            <!-- /.container -->
        </div>
    </div>

    <div class="container">
        <div class="mt-4 row">
            <div class="p-0 col-12">
                <div class="p-2 body-content outer-top-xs" style="background: white !important;">
                    <?php if(request()->segment(count(request()->segments())) == 'contact_us'): ?>
                            <?php
                                $basicinfo = App\Models\Basicinfo::first();
                            ?>

                            <div class="body-content">

                                <div class="container contact-section">
                                    <div class="row g-4 align-items-stretch">

                                        <!-- LEFT -->
                                        <div class="col-lg-4 col-md-5">
                                            <div class="contact-box">

                                                <div class="contact-item">
                                                    <div class="icon-circle">
                                                        <i class="fa-solid fa-phone"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="m-0 my-2">Call To Us</h5>
                                                        <p><?php echo e($basicinfo->address); ?></p>
                                                        <p class="mt-1">Phone: <?php echo e($basicinfo->phone_one); ?></p>
                                                    </div>
                                                </div>

                                                <div class="divider"></div>

                                                <div class="contact-item">
                                                    <div class="icon-circle">
                                                        <i class="fa-regular fa-envelope"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="m-0 my-2">Write To Us</h5>
                                                        <p>Fill out our form and we will contact you within 24 hours.</p>
                                                        <p class="mt-1"><?php echo e($basicinfo->email); ?></p>
                                                        <p><?php echo e($basicinfo->email); ?></p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- RIGHT -->
                                        <div class="col-lg-8 col-md-7">
                                            <div class="contact-box">

                                                <form class="contact-form" action="<?php echo e(url('contact/post')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>

                                                    <div class="mb-3 row g-3">
                                                        <div class="col-md-4">
                                                            <input type="text" class="w-100" name="name" placeholder="Your Name *">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="email" class="w-100" name="email" placeholder="Your Email *">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="w-100" name="phone" placeholder="Your Phone *">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <textarea class="w-100" name="message" placeholder="Your Message"></textarea>
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="submit" class="btn-custom">Send Message</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <?php else: ?>
                    <?php echo $value->value; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    </div>

    <style>
        .breadcrumb {
            padding: 5px 0;
            border-bottom: 1px solid #e9e9e9;
            background-color: #fafafa;
        }
    </style>
    <style>

        .contact-box {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.04);
            height: 100%;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            background: #db4444;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .contact-item h5 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .contact-item p {
            margin: 0;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .divider {
            height: 1px;
            background: #e5e5e5;
            margin: 25px 0;
        }

        /* FORM */
        .contact-form input,
        .contact-form textarea {
            background: #f5f5f5;
            border: none;
            border-radius: 6px;
            padding: 14px 15px;
            font-size: 14px;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            box-shadow: none;
            background: #f5f5f5;
        }

        .contact-form input:hover,
        .contact-form textarea:hover {
            background: #f5f5f5 !important;
            border: none;
            border-radius: 6px;
            padding: 14px 15px;
            font-size: 14px;
        }

        .contact-form textarea {
            height: 180px;
            resize: none;
        }

        .btn-custom {
            background: #db4444;
            color: #fff;
            padding: 12px 28px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #c73a3a;
        }

        /* Responsive Fix */
        @media (max-width: 767px) {
            .contact-box {
                padding: 20px;
            }

            .contact-form textarea {
                height: 150px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('webview.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/content/information/info.blade.php ENDPATH**/ ?>