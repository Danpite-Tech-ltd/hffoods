@extends('webview.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}-User Dashboard
    @endsection


    <style>
        body {
            background: #f8f8f8;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .rimel-account-wrapper-unique {
            padding: 40px 0;
        }

        .rimel-sidebar-unique h6 {
            font-weight: 700;
            font-size: 14px;
            margin-top: 20px;
        }

        .rimel-menu-link-unique {
            display: block;
            color: #888;
            text-decoration: none;
            padding: 6px 0;
            font-size: 14px;
        }

        .rimel-menu-link-unique.active,
        .rimel-menu-link-unique:hover {
            color: #e74c3c;
        }

        .rimel-content-card-unique {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 30px;
            min-height: 420px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .03);
        }

        .rimel-section-title-unique {
            color: #e74c3c;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        input {
            background: #f5f5f5 !important;
            border: none !important;
            box-shadow: none !important;
            height: 45px !important;
        }

        .form-control {
            background: #f5f5f5;
            border: none;
            border-radius: 3px;
            height: 46px;
        }

        .rimel-btn-save-unique {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 4px;
        }

        .rimel-btn-save-unique:hover {
            background: #d84335;
            color: #fff;
        }

        @media(max-width:768px) {
            .rimel-sidebar-unique {
                margin-bottom: 25px;
            }

            .rimel-content-card-unique {
                padding: 20px;
            }
        }
    </style>
    @php
        $orders = App\Models\Order::with(
            [
                'orderproducts' => function ($query) {
                    $query->select('id', 'order_id', 'productName', 'quantity', 'color', 'size');
                },
            ]
        )->where('status', '!=', 'Cancelled')->where('user_id', Auth::guard('web')->user()->id)
            ->join('customers', 'customers.order_id', '=', 'orders.id')
            ->select('orders.*', 'customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
            ->get();

        $cancelorders = App\Models\Order::with(
            [
                'orderproducts' => function ($query) {
                    $query->select('id', 'order_id', 'productName', 'quantity', 'color', 'size');
                },
            ]
        )->where('status', 'Cancelled')->where('user_id', Auth::guard('web')->user()->id)
            ->join('customers', 'customers.order_id', '=', 'orders.id')
            ->select('orders.*', 'customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
            ->get();
    @endphp
    <div class="container rimel-account-wrapper-unique">
        <div class="mb-4 row">
            <div class="col-12 d-flex justify-content-between small text-muted">
                <div>Home / My Account</div>
                <div>Welcome! <span class="text-danger">{{ Auth::user()->name }}</span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 rimel-sidebar-unique">
                <h6>Manage My Account</h6>
                <a href="#" class="rimel-menu-link-unique active" onclick="showSection('profile', this)">My Profile</a>
                <a href="#" class="rimel-menu-link-unique" onclick="showSection('address', this)">Address Book</a>
                {{-- <a href="#" class="rimel-menu-link-unique" onclick="showSection('payment', this)">My Payment Options</a> --}}

                <h6>My Orders</h6>
                <a href="#" class="rimel-menu-link-unique" onclick="showSection('my-orders', this)">My Orders</a>
                <a href="#" class="rimel-menu-link-unique" onclick="showSection('cancel', this)">My Cancellations</a>

                <h6>My Wishlist</h6>
                <a href="{{ url('wishlist') }}" class="rimel-menu-link-unique">Wishlist Items</a>
                <a href="{{ url('logout') }}" class="rimel-menu-link-unique text-danger fw-bold"><i class="fas fa-comment category-icon text-danger" style="font-size: 14px"></i> Logout</a>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="rimel-content-card-unique">
                    <form action="{{ route('customer.profile.update') }}" method="POST" id="profile"
                        class="rimel-content-section-unique">
                        @csrf
                        @method('PUT')

                        <div class="rimel-section-title-unique">Edit Your Profile</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', Auth::guard('web')->user()->name ?? '') }}"
                                    placeholder="Name">
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', Auth::guard('web')->user()->phone ?? '') }}"
                                    placeholder="Phone Number">
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', Auth::guard('web')->user()->email ?? '') }}" placeholder="Email">
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', Auth::guard('web')->user()->address ?? '') }}"
                                    placeholder="Address">
                            </div>

                            <div class="col-12">
                                <input type="password" name="current_password" class="form-control"
                                    placeholder="Current Password">
                            </div>

                            <div class="col-12">
                                <input type="password" name="new_password" class="form-control" placeholder="New Password">
                            </div>

                            <div class="col-12">
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    placeholder="Confirm New Password">
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="reset" class="btn me-3">Cancel</button>
                            <button type="submit" class="btn rimel-btn-save-unique">Save Changes</button>
                        </div>
                    </form>

                    <div id="address" class="rimel-content-section-unique d-none">
                        <div class="rimel-section-title-unique">Address Book</div>
                        <div class="row g-3">
                            <div class="col-12"><input class="form-control" placeholder="Home Address" value="{{ old('address', Auth::guard('web')->user()->address ?? '') }}"></div>
                        </div>
                    </div>

                    <div id="payment" class="rimel-content-section-unique d-none">
                        <div class="rimel-section-title-unique">My Payment Options</div>
                        <div class="row g-3">
                            <div class="col-12"><input class="form-control" placeholder="Card Number"></div>
                            <div class="col-md-6"><input class="form-control" placeholder="Expiry Date"></div>
                            <div class="col-md-6"><input class="form-control" placeholder="CVV"></div>
                        </div>
                    </div>

                    <div id="my-orders" class="rimel-content-section-unique d-none">
                        <div class="rimel-section-title-unique">My Orders</div>
                        @if ($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Customer Address</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->invoiceID }}</td>
                                                <td>{{ $order->customerName }}</td>
                                                <td>{{ $order->customerPhone }}</td>
                                                <td>{{ $order->customerAddress }}</td>
                                                <td>
                                                    @foreach ($order->orderproducts as $product)
                                                        {{ $product->productName }} (x{{ $product->quantity }})<br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">No orders found.</p>
                        @endif
                    </div>

                    <div id="cancel" class="rimel-content-section-unique d-none">
                        <div class="rimel-section-title-unique">My Cancellations</div>
                        @if ($cancelorders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Customer Address</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cancelorders as $order)
                                            <tr>
                                                <td>{{ $order->invoiceID }}</td>
                                                <td>{{ $order->customerName }}</td>
                                                <td>{{ $order->customerPhone }}</td>
                                                <td>{{ $order->customerAddress }}</td>
                                                <td>
                                                    @foreach ($order->orderproducts as $product)
                                                        {{ $product->productName }} (x{{ $product->quantity }})<br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">No cancellations found.</p>
                        @endif
                    </div>


                    <div id="wishlist" class="rimel-content-section-unique d-none">
                        <div class="rimel-section-title-unique">My Wishlist</div>
                        <p class="text-muted">Your wishlist items will appear here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(id, el) {
            document.querySelectorAll('.rimel-content-section-unique').forEach(sec => sec.classList.add('d-none'));
            document.getElementById(id).classList.remove('d-none');
            document.querySelectorAll('.rimel-menu-link-unique').forEach(link => link.classList.remove('active'));
            el.classList.add('active');
        }
    </script>
@endsection
