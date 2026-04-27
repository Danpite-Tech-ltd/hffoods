@extends('webview.master')

@section('maincontent')
@section('title')
    {{ env('APP_NAME') }}- Category Product
@endsection
{{-- category slug --}}
<style>
    .product{
            margin-top: 4px !important;

    }

    #featureimagess{
        width: 100%;
        padding: 0px;
        padding-top: 0;
        height:180px;
    }
    #checked {
        color: orange;
    }
    .star{
        font-size: 8px !important;
    }
</style>
<style>
    .pagination-wrapper {
        text-align: center;
        margin-top: 30px;
    }

    .pagination {
        list-style: none;
        display: inline-flex;
        gap: 6px;
        padding: 0;
    }

    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 14px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 6px;
    }

    .pagination li.active span {
        background: #ff6a00;
        color: #fff;
        border-color: #ff6a00;
    }

    .pagination li a:hover {
        background: #f5f5f5;
    }

    .pagination li.disabled span {
        color: #aaa;
    }
</style>
<!-- /.breadcrumb -->
<div class="container body-content outer-top-xs">

    <div class="pt-2 breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="p-0 breadcrumb-inner">
                        <ul class="mb-0 list-inline list-unstyled">
                            <li style="list-style:none;font-size:12px;color:#888;">

                                <a href="{{ url('/') }}"
                                style="text-decoration:none;color:#888;padding-right:6px;text-transform:capitalize;">
                                Home
                                </a>

                                <span style="padding:0 6px;color:#aaa;">/</span>

                                <a style="text-decoration:none;color:#333;font-weight:500;text-transform:capitalize;">
                                    Category
                                </a>

                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /.breadcrumb-inner -->
            </div>
        </div>
    </div>

<style>

.shop-category-box h3{
    font-size:22px;
    font-weight:700;
    /* margin-bottom:20px; */
    margin-top:0;
    color:#333;
}

.category-item{
    display:block;
    text-decoration:none;
    color:#444;
    font-size:16px;
    margin-bottom:12px;
    transition:0.3s;
}

.category-item:hover{
    color:#000;
    padding-left:5px;
}

</style>
    <div class="row ">
        <div class="col-12 col-lg-3">
            <div class="shop-category-box">
                <h3 class="m-0 mb-2">Shop by Subategory</h3>

                <form method="GET" id="subcategoryForm">
                    @foreach ($subcategories as $subcategory)
                        <div>
                            <input
                                type="checkbox"
                                id="subcat{{ $subcategory->id }}"
                                name="subcategory[]"
                                value="{{ $subcategory->id }}"
                                onchange="document.getElementById('subcategoryForm').submit()"
                                {{ in_array($subcategory->id, request('subcategory', [])) ? 'checked' : '' }}
                            >

                            <label for="subcat{{ $subcategory->id }}" style="cursor:pointer;">
                                {{ $subcategory->sub_category_name }}
                            </label>
                        </div>
                    @endforeach
                </form>

            </div>

            <div class="shop-category-box">
                <h3 class="m-0 mb-2">Price</h3>
                <form method="GET" id="priceForm">
                    <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}" class="mb-2 form-control">
                    <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}" class="mb-2 form-control">
                    <button type="submit" class="btn btn-primary w-100"> Apply Filter </button>
                </form>
            </div>

            <div class="shop-category-box">
                <h3 class="m-0 mb-2">Shop by Brand</h3>
                @php
                    $brands = App\Models\Brand::where('status', 'Active')->get();
                @endphp

                <form method="GET" id="brandForm">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @foreach ($brands as $brand)
                        <div>
                            <input
                                type="checkbox"
                                id="brand{{ $brand->id }}"
                                name="brand[]"
                                value="{{ $brand->id }}"

                                onchange="document.getElementById('brandForm').submit()"

                                {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>

                            <label for="brand{{ $brand->id }}" style="cursor:pointer;">
                                {{ $brand->brand_name }}
                            </label>
                        </div>
                    @endforeach

                </form>

            </div>

        </div>



        <div class="col-12 col-lg-9">
            <div style="display: flex;align-items: center;justify-content: space-between;">
                <div style="text-align:right;font-size:14px;color:#666;font-weight:500;margin:20px 0;">
                    Showing {{ $categoryproducts->firstItem() }}–{{ $categoryproducts->lastItem() }} of {{ $categoryproducts->total() }} results
                </div>
                <form method="GET" id="filterForm" style="margin-bottom:0">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <select name="filter" class="w-auto form-select d-inline"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">Filter</option>

                        <option value="latest" {{ request('filter') == 'latest' ? 'selected' : '' }}>
                            Latest Product
                        </option>

                        <option value="oldest" {{ request('filter') == 'oldest' ? 'selected' : '' }}>
                            Oldest Product
                        </option>

                        <option value="low_to_high" {{ request('filter') == 'low_to_high' ? 'selected' : '' }}>
                            Price Low → High
                        </option>

                        <option value="high_to_low" {{ request('filter') == 'high_to_low' ? 'selected' : '' }}>
                            Price High → Low
                        </option>

                        <option value="a_to_z" {{ request('filter') == 'a_to_z' ? 'selected' : '' }}>
                            A → Z
                        </option>

                        <option value="z_to_a" {{ request('filter') == 'z_to_a' ? 'selected' : '' }}>
                            Z → A
                        </option>
                    </select>
                </form>
            </div>

            <!-- /.container -->
            <div class="pt-2 pb-2 row" id="cateoryPro" style="background: white;">

                @forelse ($categoryproducts as $promotional)
                    @php
                        $firstpro = App\Models\Product::with([
                            'sizes' => function ($query) {
                                $query
                                    ->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')
                                    ->take(1);
                            },
                        ])
                            ->where('id', json_decode($promotional->RelatedProductIds)[0]->productID)
                            ->select('id', 'ProductName')
                            ->first();

                    @endphp
                    @if (isset($firstpro))
                        <div class="col-6 col-lg-4 border-animation">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col-12">
                                                <div class="product-image" style="position: relative;">
                                                    <div class="text-center image">
                                                        @if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice)
                                                            <div class="frs_discount">
                                                                <span> -
                                                                    {{ ($firstpro->sizes[0]->RegularPrice > 0) ? round((($firstpro->sizes[0]->RegularPrice - $firstpro->sizes[0]->SalePrice) / $firstpro->sizes[0]->RegularPrice) * 100) : 0 }}%
                                                                    <!-- <span class="pip_pip_1s">ছাড়</span>  -->
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <div class="wishlist-eye-btn">
                                                        <form action="{{ route('wishlist.add') }}" method="POST"
                                                                class="p-0 m-0 wishlist-form">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $promotional->id }}">

                                                                <button type="submit" class="wishlist-btn">
                                                                    @php
                                                                        $wishlist = session()->get('wishlist', []);
                                                                        $inWishlist = in_array($promotional->id, $wishlist);
                                                                    @endphp

                                                                    @if($inWishlist)
                                                                        <i class="fa-solid fa-heart fs-5"
                                                                            style="font-size:18px;color:black;"></i>
                                                                    @else
                                                                        <i class="fa-regular fa-heart fs-5"
                                                                            style="font-size:18px;color:black;"></i>
                                                                    @endif
                                                                </button>
                                                            </form>
                                                            <button class="quick-shop-btn" type="button"
                                                                data-product-id="{{ $promotional->id }}">
                                                                <i class="fa-regular fa-eye"
                                                                    style="font-size: 18px;color:black;"></i>
                                                            </button>
                                                        </div>
                                                        <a href="{{ url('view-product/' . $promotional->ProductSlug) }}">
                                                            <img src="{{ asset($promotional->ProductImage) }}">
                                                        </a>

                                                        {{-- <form>
                                                            <button class="addtocartbtn">
                                                                Add To Cart
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12">
                                                <div class="p-2 infofe p-md-2"
                                                    style="padding-bottom: 4px !important;background: white;">
                                                    <div class="product-info">
                                                        <h2 class="name text-truncate" id="f_name"><a
                                                                href="{{ url('view-product/' . $promotional->ProductSlug) }}"
                                                                id="f_pro_name">{{ $promotional->ProductName }}</a>
                                                        </h2>
                                                    </div>

                                                    <div class="price-box" style="padding-top: 5px;">
                                                        @if($firstpro->sizes[0]->RegularPrice > $firstpro->sizes[0]->SalePrice)
                                                            <del class="old-product-price strong-400"
                                                                style="color:#db4444">৳{{ round($firstpro->sizes[0]->RegularPrice) }}</del>
                                                        @endif
                                                        <span class="product-price strong-600"
                                                        style="color:black;margin-left:7px;">৳{{ round($firstpro->sizes[0]->SalePrice) }}</span>
                                                    </div>

                                                    <div class="d-flex" style="justify-content:space-between">
                                                        <div class="star" style="padding-top: 5px;">

                                                            <span class="fas fa-star" id="checked"></span>
                                                            <span class="fas fa-star" id="checked"></span>
                                                            <span class="fas fa-star" id="checked"></span>
                                                            <span class="fas fa-star" id="checked"></span>
                                                            <span class="fas fa-star" id="checked"></span>
                                                            <span
                                                                style="font-weight: bold;color:black;font-size:12px">({{ App\Models\Review::where('product_id', $promotional->id)->get()->count() }})</span>

                                                        </div>

                                                    </div>



                                                </div>
                                                <!-- <a href="{{ url('view-product/' . $promotional->ProductSlug) }}">
                                                    <button class="mb-0 btn btn-danger btn-sm btn-block"
                                                        style="width: 100%;border-radius: 0%;"
                                                        id="purcheseBtn">অর্ডার করুন</button>
                                                </a> -->

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
            @if ($categoryproducts->hasPages())
            <div class="pagination-wrapper">
                <ul class="pagination">

                    {{-- Previous --}}
                    @if ($categoryproducts->onFirstPage())
                        <li class="disabled"><span>«</span></li>
                    @else
                        <li>
                            <a href="{{ $categoryproducts->previousPageUrl() }}">«</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $categoryproducts->lastPage(); $i++)
                        @if ($i == $categoryproducts->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li>
                                <a href="{{ $categoryproducts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    {{-- Next --}}
                    @if ($categoryproducts->hasMorePages())
                        <li>
                            <a href="{{ $categoryproducts->nextPageUrl() }}">»</a>
                        </li>
                    @else
                        <li class="disabled"><span>»</span></li>
                    @endif

                </ul>
            </div>
        @endif
        </div>

    </div>

<script>
    $(document).ready(function () {
        $('.quick-shop-btn').on('click', function () {
            var productId = $(this).data('product-id');

            $('#quickShopModalBody').html('<p>Loading...</p>');

            $('#quickShopModal').modal('show');

            $.ajax({
                url: '{{url("quick-shop")}}/' + productId, // your route
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

<!-- <script>
document.querySelectorAll('.wishlist-form').forEach(function (form) {
    form.addEventListener('submit', function () {

        setTimeout(function () {
            window.location.reload();

            setTimeout(function () {
                window.location.reload();
            }, 300);

        }, 300);

    });
});
</script> -->

</div>
@endsection
