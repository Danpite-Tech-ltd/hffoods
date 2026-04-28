<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <?php echo $__env->yieldContent('meta'); ?>

    <?php echo $__env->make('webview.partials.links.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset(App\Models\Basicinfo::first()->favicon)); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset(App\Models\Basicinfo::first()->favicon)); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('public/webview/assets/css/zoomsl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/webview/assets/css/custom.css')); ?>">
    <?php echo $__env->yieldContent('subhead'); ?>
    <style>
        #crimg:hover {
            transform: rotate(360deg);
            /* Firefox */
            -moz-transition: all .5s ease-in;
            -webkit-transition: all .5s ease-in;
            -o-transition: all .5s ease-in;
            transition: all .5s ease-in;
        }

        #shimg:hover {
            transform: rotate(360deg);
            /* Firefox */
            -moz-transition: all .5s ease-in;
            -webkit-transition: all .5s ease-in;
            -o-transition: all .5s ease-in;
            transition: all .5s ease-in;
        }

        #message {
            display: none;
        }

        #crossm {
            display: none;
        }

        #crossms {
            display: none;
        }

        #hideser {
            display: none;
            float: left;
            padding: 0;
        }

        .header-top-inner {
            padding: 4px;
        }

        #subcategoryhover li {
            border-bottom: 1px solid #eee;
        }

        #subcategoryhover a:hover {
            color: #c30909 !important
        }


        #discountpart {
            position: absolute;
            top: 0px;
            right: 0px;
            background: red;
            border-radius: 16px 0% 0% 16px;
            height: 20px;
            width: 60px;
            box-shadow: 1px 1px 10px 1px #05050522;

        }

        #discountparttwo {
            background: #ff0a01;
            border-radius: 50%;
            height: 32px;
            width: 32px;
            float: left;

        }

        #pdis {
            font-size: 10px;
            margin: 0;
            padding-top: 2px;
            float: right;
            color: white;
            font-weight: bold;
            padding-right: 4px;
        }

        .product-image {
            overflow: hidden;
        }

        /* .product-image img:hover{
            transform: scale(1.2);
        } */
        .product-image img {
            transition: .5s;
        }

        /*#sync1 .items img:hover{*/
        /*    transform: scale(1.4);*/
        /*}*/
        #sync1 .items img {
            transition: .5s;
        }

        #posit {
            position: fixed;
            left: 0;
            z-index: 1111;
            top: 50%;
            background: #212129;
            height: 40px;
            width: 55px;
            text-align: end;
            border-radius: 0px;
        }

        .module-title {
            border-bottom: 2px solid #212129;
            padding-bottom: 4px;
            width: max-content;
        }


        @keyframes  pip_pip {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0;
                transform: scale(1.2);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .frs_discount {
            position: absolute;
            text-align: center;
            background: #db4444;
            display: inline-block;
            color: #fff !important;
            font-weight: bold;
            padding: 4px 8px;
            left: 0px;
            top: 2px;
            /* width: 40px;
            height: 40px; */
            border-radius: 4px;
            margin: 5px;
            font-size: 12px;
            /* z-index:9999; */
        }

        .pip_pip_1s {
            animation: pip_pip 1s infinite !important;
        }

        .category_Banner_Image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        @media  screen and (max-width:768px) {
            .category_Banner_Image {
                height: 100px !important;
            }
        }
    </style>


    <?php echo $basicinfo->facebook_pixel; ?>

    <?php echo $basicinfo->google_analytics; ?>


</head>

<body class="main-body">

    <!-- header -->
    <?php echo $__env->make('webview.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- header end -->


    <!-- Body -->
    <div class="body-content" id="top-banner-and-menu" style="overflow:hidden">
        
        <?php echo $__env->yieldContent('maincontent'); ?>
        
    </div>
    <!-- Body end -->

    <!-- === FOOTER === -->
    <?php echo $__env->make('webview.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- === FOOTER : END === -->
    
    <div class="mobnav-container-91x2 d-none">

        <a href="<?php echo e(url('/')); ?>" class="mobnav-item-91x2 active">
            <i class="bi bi-house" style="font-size:24px;"></i>
            <!--<span class="mobnav-text-91x2">Home</span>-->
        </a>

        <!--<a onclick="openNav()" class="mobnav-item-91x2 active">-->
        <!--    <i class="fa-solid fa-bars mobnav-icon-91x2"></i>-->
        <!--    <span class="mobnav-text-91x2">Category</span>-->
        <!--</a>-->

        <a href="<?php echo e(url('shop')); ?>" class="mobnav-item-91x2 active">
            <i class="bi bi-bag-check" style="font-size:24px;"></i>
            <!--<span class="mobnav-text-91x2">Shop</span>-->
        </a>
        
        <a href="<?php echo e(url('video-gallery')); ?>" class="mobnav-item-91x2 active">
            <i class="bi bi-play-btn" style="font-size:24px;"></i>
            <!--<span class="mobnav-text-91x2">Shop</span>-->
        </a>

        <a href="<?php echo e(url('track-order')); ?>" class="mobnav-item-91x2 active">
            <i class="bi bi-truck" style="font-size:24px;"></i>
            <!--<span class="mobnav-text-91x2">Bag</span>-->
        </a>

        <a href="<?php echo e(url('login')); ?>" class="mobnav-item-91x2 active">
            <i class="bi bi-person" style="font-size:24px;"></i>
            <!--<span class="mobnav-text-91x2">Account</span>-->
        </a>

    </div>
    <style>
        /* Hidden by default */
        .mobnav-container-91x2 {
            display: none;
        }

        /* Mobile only */
        @media (max-width: 768px) {

            .mobnav-container-91x2 {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #ffffff;
                border-top: 1px solid #e5e5e5;
                justify-content: space-around;
                align-items: center;
                padding: 6px 0;
                z-index: 9999;
            }

            .mobnav-item-91x2 {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 11px;
                color: #777;
                transition: all 0.3s ease;
            }

            .mobnav-icon-91x2 {
                font-size: 18px;
                margin-bottom: 3px;
                transition: transform 0.2s ease, color 0.2s ease;
            }

            .mobnav-text-91x2 {
                font-size: 11px;
            }

            /* Tap effect */
            .mobnav-item-91x2:active .mobnav-icon-91x2 {
                transform: scale(1.2);
            }

            /* Active state */
            .mobnav-item-91x2.active {
                color: #000;
            }

            .mobnav-item-91x2.active .mobnav-icon-91x2 {
                color: #000;
                transform: translateY(-2px);
            }
        }
    </style>

    <!--Footer Js-->
    <?php echo $__env->make('webview.partials.links.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('subfooter'); ?>

    <div id="message">

        <a href="<?php echo e($basicinfo->messanger); ?>" target="_blank"
            style="position: fixed;bottom: 230px;right: 6px;z-index:1111">
            <img src="<?php echo e(asset('public/messenger.png')); ?>" style="height:60px;border-radius:50%">
        </a>
        <a href="tel:+88<?php echo e($basicinfo->wp_1); ?>" target="_blank"
            style="position: fixed;bottom: 160px;right: 6px;z-index:1111">
            <img src="<?php echo e(asset('public/telephone.png')); ?>" style="height:60px;border-radius:50%">
        </a>

        <a href="https://wa.me/+88<?php echo e($basicinfo->wp_1); ?>?text=I%20am%20interested"
            style="position: fixed;bottom: 90px;right: 6px;z-index:1111">
            <img src="<?php echo e(asset('public/whatsappns.png')); ?>" style="height:60px;border-radius:50%">
        </a>
    </div>

    <a href="javascript:void(0);" class="" onclick="showmessage()" id="showm"
        style="position: fixed;bottom: 10px;right: 6px;z-index:1111">
        <img src="<?php echo e(asset('public/chat.png')); ?>" style="height:60px;" id="shimg">
    </a>
    <a href="javascript:void(0);" onclick="hidemessage()" id="crossm"
        style="position: fixed;bottom: 10px;right: 6px;z-index:1111">
        <img src="<?php echo e(asset('public/chat.png')); ?>" style="height:60px;" id="crimg">
    </a>

    

    <div class="modal" id="processing">
        <div class="modal-dialog">
            <div class="modal-content" style="text-align: center;background: none;">
                <i class="spinner fa fa-spinner fa-spin" style="color: #ffffff; font-size: 70px;  padding: 22px;"></i>
            </div>
        </div>
    </div>


    <div class="modal" id="cartViewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="AddToCartModel" style="padding-top: 0">

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span aria-hidden="true">Add
                            More Products</span></button>
                    <a href="<?php echo e(url('checkout')); ?>" class="btn" style="background: #212129;color:#fff">Submit Order</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quickShopModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header with Close Button -->
                <div class="modal-header">
                    <h5 class="m-0 modal-title fs-6 fw-bold">Select your product </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="quickShopModalBody">
                </div>
            </div>
        </div>
    </div>



    
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />

    <?php echo $basicinfo->chat_box; ?>


    <script>

        window.onscroll = function () {
            myFunction()
        };

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }

        function checkcartview() {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('get-cart-content')); ?>',

                success: function (response) {
                    $('#cartViewModal .modal-body').empty().append(
                        response);
                },
                error: function (error) {
                    console.log('error');
                }
            });
            $('#processing').modal('hide');
            $('#cartViewModal').modal('show');
        }



        function showmessage() {
            $('#showm').css('display', 'none');
            $('#showms').css('display', 'none');
            $('#crossms').css('display', 'inline');
            $('#crossm').css('display', 'inline');
            $("#message").fadeIn('slow');
        }
        function hidemessage() {
            $('#showm').css('display', 'inline');
            $('#showms').css('display', 'inline');
            $('#crossms').css('display', 'none');
            $('#crossm').css('display', 'none');
            $("#message").fadeOut('slow');
        }


        $(document).ready(function () {
            var idval = $('#CountSlider').val();

            $('#slider').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 600,
                lazyLoad: true,
                autoplayHoverPause: true,
                dots: true,
                nav: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 1,
                    }
                }
            });





            $('#categorySlide').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                lazyLoad: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsiveClass: true,
                dots: false,
                nav: true,
                responsive: {
                    0: {
                        items: 3,
                    },
                    600: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                    1000: {
                        items: 6,
                    }
                }
            });

            $('#promotionalofferSlide').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                lazyLoad: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsiveClass: true,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 4,
                    }
                }
            });
            $('#topsaleofferSlide').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                lazyLoad: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsiveClass: true,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 4,
                    }
                }
            });
            $('#reviewSlide').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                lazyLoad: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsiveClass: true,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 3,
                    }
                }
            });






        });

        var token = $("input[name='_token']").val();

        function addtocart(product_id) {
            $('#processing').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            })
            $('#processing').modal('show');
            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('add-to-cart')); ?>',
                data: {
                    _token: token,
                    product_id: product_id,
                    qty: '1',
                },

                success: function (data) {
                    updatecart();
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo e(url('get-cart-content')); ?>',

                        success: function (response) {
                            $('#cartViewModal .modal-body').empty().append(
                                response);
                        },
                        error: function (error) {
                            console.log('error');
                        }
                    });
                    $('#processing').modal('hide');
                    $('#cartViewModal').modal('show');
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function buynow(product_id) {
            $('#processing').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            })
            $('#processing').modal('show');
            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('add-to-cart')); ?>',
                data: {
                    _token: token,
                    product_id: product_id,
                    qty: '1',
                },

                success: function (data) {
                    updatecart();
                    if (data == 'success') {
                        window.location.href = 'https://com/checkout';
                        $('#processing').modal('hide');
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }


        function removeFromCartItem(rowId) {

            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('remove-cart')); ?>',
                data: {
                    _token: token,
                    rowId: rowId,
                },

                success: function (response) {

                    updatecart();
                    swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Product remove from your Cart',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if (response == 'empty') {
                        $('#loadingreload').css({
                            'display': 'flex',
                            'justify-content': 'center',
                            'align-items': 'center'
                        })
                        $('#loadingreload').modal('show');
                        $('#cartViewModal').modal('hide');
                        location.reload();
                    } else {
                        $('#cartViewModal .modal-body').empty().append(
                            response);
                        $('#cartViewModal').modal('show');
                    }


                },
                error: function (error) {
                    console.log('error');
                }
            });
        }



        function upQuantity() {
            var qty = $('#proQuantity').val();
            if (qty >= 10) {

            } else {
                var b = parseInt(qty);
                var cq = b + 1;
                $('#proQuantity').val(cq);
                $('#qty').val(cq);
                $('#qtyor').val(cq);
            }
        }

        function downQuantity() {
            var qty = $('#proQuantity').val();
            if (qty <= 1) {

            } else {
                var b = parseInt(qty);
                var cq = b - 1;
                $('#proQuantity').val(cq);
                $('#qty').val(cq);
                $('#qtyor').val(cq);
            }


        }

        function checkcart() {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('get-checkcart-content')); ?>',

                success: function (response) {
                    $('#checkcartview').html('');
                    $('#checkcartview').append(
                        response);
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function removeFromCartItemHead(rowId) {

            $.ajax({
                type: 'POST',
                url: '<?php echo e(url('remove-cart')); ?>',
                data: {
                    _token: token,
                    rowId: rowId,
                },

                success: function (response) {
                    if (response == 'empty') {
                        $('#loadingreload').css({
                            'display': 'flex',
                            'justify-content': 'center',
                            'align-items': 'center'
                        })
                        $('#loadingreload').modal('show');
                        toastr.success('Product remove from Cart');
                        checkcart();
                        viewcart();
                        updatecart();
                        location.reload();
                    } else {
                        console.log('hi');
                        toastr.success('Product remove from Cart');
                        checkcart();
                        viewcart();
                        updatecart();
                    }


                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function viewcart() {
            $.ajax({
                type: 'get',
                url: '<?php echo e(url('load-cart')); ?>',

                success: function (response) {
                    $('#cart-summary').empty().append(
                        response);
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function updatecart() {
            $.ajax({
                type: 'get',
                url: '<?php echo e(url('update-cart')); ?>',

                success: function (response) {
                    $('.basket-item-count').html(response.item);
                    $('.cartamountvalue').html(response.amount);
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function searchproduct() {
            var search = $('#modalsearchinput').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('get-search-content')); ?>',
                data: {
                    _token: token,
                    search: search,
                },

                success: function (response) {
                    $('#searchproductlist').html('');
                    $('#searchproductlist').append(
                        response);
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        $(document).ready(function () {
            $('img').lazyload();
        });
    </script>

    <script src="<?php echo e(asset('public/webview/assets/js/zoomsl.min.js')); ?>"></script>
    <script type="text/javascript">
        $(".block__pic").imagezoomsl({
            zoomrange: [3, 3]
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.quick-shop-btn').on('click', function () {
                var productId = $(this).data('product-id');

                $('#quickShopModalBody').html('<p>Loading...</p>');

                $('#quickShopModal').modal('show');

                $.ajax({
                    url: '<?php echo e(url("quick-shop")); ?>/' + productId, // your route
                    type: 'GET',
                    success: function (response) {
                        $('#quickShopModalBody').html(response);
                    },
                    error: function () {
                        $('#quickShopModalBody').html('<p>Something went wrong!</p>');
                    }
                });
            });
        });

    </script>



</body>

</html><?php /**PATH D:\xampp\htdocs\premium\hffoods\resources\views/webview/master.blade.php ENDPATH**/ ?>