<?php

namespace App\Http\Controllers;

use App\Models\Addbanner;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Product;
use App\Models\Menu;
use App\Models\User;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Attrvalue;
use App\Models\Basicinfo;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Varient;
use App\Models\Weight;
use App\Models\React;
use App\Models\Review;
use App\Models\Size;
use App\Models\Usecoupon;
use App\Models\Like;
use App\Models\Share;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Mainproduct;
use App\Models\Orderproduct;
use App\Models\Campaign;
use App\Models\Admin;
use App\Models\Postcomment;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Session;
use Cart;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class WebviewController extends Controller
{

    public function datafeed()
    {
        $mainproducts = Mainproduct::all();

        $xml = new \SimpleXMLElement('<rss/>');
        $xml->addAttribute('version', '2.0');
        $xml->addAttribute('xmlns:g', 'http://base.google.com/ns/1.0'); // ✅ Required namespace

        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Thebdshop');
        $channel->addChild('link', url('https://www.thebdshop.com/'));
        $channel->addChild('description', 'Thebdshop is an online luxury store offering premium bags and accessories.');

        foreach ($mainproducts as $mainproduct) {
            $relatedProducts = json_decode($mainproduct->RelatedProductIds, true);
            $relatedProductIds = collect($relatedProducts)->pluck('productID')->toArray();

            $products = Product::whereIn('id', $relatedProductIds)->get();

            foreach ($products as $product) {
                if (!$product) continue;

                $color = Varient::where('product_id', $product->id)->first();
                $sizes = Size::where('product_id', $product->id)->get();

                // ✅ If no size, create one default "variant"
                if ($sizes->count() == 0) {
                    $sizes = collect([(object)[
                        'size' => '',
                        'RegularPrice' => 1800,
                        'SalePrice' => 1600,
                        'stock' => 10
                    ]]);
                }

                foreach ($sizes as $index => $size) {
                    $item = $channel->addChild('item');

                    // Unique ID using mainproduct, product, and index
                    $item->addChild('g:id', 'P' . $mainproduct->id . '_' . $product->id . '_' . $index);

                    // Group ID for variants (Facebook will group colors/sizes under same product)
                    $item->addChild('g:item_group_id', $mainproduct->id);

                    // Title & Description
                    $item->addChild('g:title', htmlspecialchars($product->ProductName));
                    $item->addChild('g:description',  htmlspecialchars(strip_tags($product->ProductDetails)));

                    // Link & Image
                    $item->addChild('g:link', 'https://thebdshop.com/view-product/' . $mainproduct->ProductSlug);
                    $item->addChild('g:image_link', 'https://thebdshop.com/' . $product->ProductImage);

                    // Brand
                    $item->addChild('g:brand', 'thebdshop');

                    // Color
                    $item->addChild('g:color', $color ? $color->color : '');

                    // Size
                    if (!empty($size->size)) {
                        $item->addChild('g:size', $size->size);
                    }

                    // Condition
                    $item->addChild('g:condition', 'new');

                    // Availability
                    if (isset($size->available_stock) && $size->available_stock > 0) {
                        $item->addChild('g:availability', 'in stock');
                    } else {
                        $item->addChild('g:availability', 'out of stock');
                    }

                    // Price & Sale Price
                    $item->addChild('g:price', number_format($size->RegularPrice, 2) . ' BDT');
                    if ($size->SalePrice && $size->SalePrice < $size->RegularPrice) {
                        $item->addChild('g:sale_price', number_format($size->SalePrice, 2) . ' BDT');
                    }
                }
            }
        }

        return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }


    public function webhook(Request $request)
    {
        $invoice = $request['invoice'];
        $order = Order::where('invoiceID', $invoice)->first();
        if (isset($order)) {
            if ($request['status'] == 'delivered') {
                $order->status = 'Completed';
            } else if ($request['status'] == 'pending') {
                $order->status = 'Courier Pending';
            } else if ($request['status'] == 'cancelled') {
                $order->status = 'Del. Failed';
            } else if ($request['status'] == 'partial_delivered') {
                $order->status = 'Partial Delivered';
            } else if ($request['status'] == 'unknown') {
                $order->status = 'Unknown';
            } else {
            }
            $order->update();

            $comment = new Comment();
            $comment->order_id = $order->id;
            $comment->comment = 'Steadfast Successfully change status of invoice: ' . $invoice . ' to : ' . $request['status'];
            $comment->admin_id = 1;
            $comment->status = 1;
            $comment->save();
        }
        return response()->json('success', 200);
    }
    public function couponcheck(Request $request)
    {
        $available = Coupon::where('code', $request->coupon_code)->where('validity', '>=', date('Y-m-d'))->first();

        if (isset($available)) {
            $use = Usecoupon::where('user_id', Auth::id())->where('coupon_id', $available->id)->where('code', $request->coupon_code)->first();
            if (isset($use)) {
                $response = [
                    'status' => 'false',
                    'discount' => 0,
                ];
                return response()->json($response, 200);
            } else {
                $blance = Cart::subtotalFloat();
                if ($available->type == 'Amount') {
                    $discount = $available->amount;
                } else {
                    $discount = intval($blance * ($available->amount / 100));
                }
                Session::put('couponcode', $request->coupon_code);
                Session::put('availablecoupon', $available);
                $response = [
                    'status' => 'true',
                    'discount' => $discount,
                ];
                return response()->json($response, 200);
            }
        } else {
            Session::forget('couponcode');
            Session::forget('availablecoupon');
            $response = [
                'status' => 'invalid',
                'discount' => 0,
            ];
            return response()->json($response, 200);
        }
    }

    public function mainview()
    {
        $categories = Category::with('subcategories')->where('status', 'Active')->get();
        $brands = Brand::where('status', 'Active')->get();
        $sliders = Slider::where('status', 'Active')->select('id', 'slider_btn_link', 'slider_title', 'slider_image')->get();
        $adds = Addbanner::where('status', 'Active')->whereIn('id', ['1', '2'])->select('id', 'add_link', 'add_image', 'status')->get();
        $addbottoms = Addbanner::where('status', 'Active')->whereIn('id', ['3', '4'])->select('id', 'add_link', 'add_image', 'status')->get();

        $topproducts = Mainproduct::where('status', 'Active')->where('top_rated', '1')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'ProductHoverImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->latest()->get();
        $bestselling = Mainproduct::where('status', 'Active')->where('bestselling', '1')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'ProductHoverImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->latest()->get();
        $allProducts = Mainproduct::where('status', 'Active')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'ProductHoverImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->latest()->get();

        $our_products = Mainproduct::where('status', 'Active')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'ProductHoverImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->inRandomOrder()->take(8)->get();

        $video_galleries = Menu::where('status', 'Active')->get();

        $categoryproducts = Category::where('status', 'Active')->orderBy('position')->get();

        $categoryproducts->each(function ($category) {
            $category->mainproducts = $category->mainproducts()
                ->select('id', 'category_id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'RelatedProductIds', 'ProductHoverImage')
                ->where('status', 'Active')
                ->orderBy('id', 'desc')
                ->get();
        });

        return view('webview.content.maincontent', ['video_galleries' => $video_galleries, 'categories' => $categories, 'sliders' => $sliders, 'adds' => $adds, 'addbottoms' => $addbottoms, 'topproducts' => $topproducts, 'categoryproducts' => $categoryproducts, 'bestselling' => $bestselling, 'our_products' => $our_products, 'allProducts' => $allProducts, 'brands' => $brands]);
    }

        public function campaign($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        $mainproducts = Mainproduct::where('category_id', $campaign->category_id)->select('id', 'category_id', 'ProductName', 'ProductSlug', 'ProductImage', 'RelatedProductIds')->latest()->get();

        $productIds = json_decode($campaign->product_id, true);
        $products = Product::with(['sizes', 'variants'])->whereIn('id', $productIds)->get();
        return view('webview.content.campaign.campaign', compact('campaign', 'products', 'mainproducts'));
    }

    public function campaign_submit(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $block = User::where('ip', \Request::ip())
            ->where('status', 'Block')
            ->first();

        if ($block) {
            return redirect('ip-block');
        }


        if (!$request->product_id || !$request->qty) {
            return redirect('/empty-cart');
        }

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect('/empty-cart');
        }

        $excutomer = Customer::where('customerPhone', $request->phone)
            ->latest()
            ->first();

        if (isset($excutomer)) {
            $exorder = Order::where('id', $excutomer->order_id)->first();

            if ($exorder && in_array($exorder->status, [
                'Pending',
                'Packaging',
                'Ready to Ship',
                'Hold'
            ])) {
                return redirect('/exist-order');
            }
        }

        $admin = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('status', 'Active')
            ->inRandomOrder()
            ->first();

        if (!$admin) {
            $admin = Admin::where('status', 'Active')->first();
        }


        $order = new Order();

        $exuser = User::where('email', $request->phone)->first();

        if ($exuser) {
            Auth::login($exuser);
            $order->user_id = $exuser->id;
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->phone;
            $user->otp = random_int(100000, 999999);
            $user->active_status = 0;
            $user->ip = \Request::ip();
            $user->password = Hash::make($request->phone);
            $user->save();

            Auth::login($user);
            $order->user_id = $user->id;
        }

        $order->store_id = 1;
        $order->web_id = 'LandingPage';
        $order->invoiceID = $this->uniqueID();
        $order->deliveryCharge = $request->ship;
        $order->city_id = $request->city_id ?? null;
        $order->zone_id = $request->zone_id ?? null;

        /* VAT */
        $vatInfo = Basicinfo::first();
        if ($vatInfo && $vatInfo->vat_status == 'On') {
            $vat = ($request->total * $vatInfo->vat) / 100;
        } else {
            $vat = 0;
        }

        $total = $request->total;

        $order->vat = $vat;
        $order->orderDate = date('Y-m-d');
        $order->subTotal = $total + $vat;
        $order->payment_type_id = $request->paymentType ?? 1;
        $order->customerNote = $request->note ?? null;
        $order->save();

        $customer = new Customer();
        $customer->order_id = $order->id;
        $customer->customerName = $request->name;
        $customer->customerPhone = $request->phone;
        $customer->customerAddress = $request->address;
        $customer->save();

        $product = Product::find($request->product_id);

        $orderProduct = new Orderproduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product->id;
        $orderProduct->productCode = $product->ProductSku;
        $orderProduct->productName = $product->ProductName;
        $orderProduct->color = $request->color ?? null;
        $orderProduct->size = $request->size ?? null;
        $orderProduct->quantity = $request->qty;
        $orderProduct->productPrice = $request->price;
        $orderProduct->save();

        Session::put('order_id', $order->id);

        toastr()->info('Order Placed Successfully', 'Complete', [
            "positionClass" => "toast-top-center"
        ]);

        return redirect('order-received');
    }

    public function uniqueID()
    {
        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $orderID = $lastOrder->id + 1;
        } else {
            $orderID = 1;
        }

        return 'INV001' . $orderID;
    }

    public function productdetailsnew($slug)
    {
        $singlemain = Mainproduct::where('ProductSlug', $slug)->select('id', 'category_id', 'RelatedProductIds')->first();

        $id = json_decode($singlemain->RelatedProductIds)[0]->productID;
        $productdetails = Product::with([
            'sizes' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')->where('status', 'Active');
            },
            'weights' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice');
            }
        ])->where('id', $id)->first();
        $varients = Varient::where('product_id', $productdetails->id)->get();

        $relatedproducts = Mainproduct::where('category_id', $singlemain->category_id)->where('status', 'Active')->where('top_rated', '1')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->inRandomOrder()->limit(15)->get();
        $sizesolds = Size::where('product_id', $productdetails->id)->where('status', 'Active')->get();
        $weightolds = Weight::where('product_id', $productdetails->id)->get();

        return view('webview.content.product.datacheck', ['sizesolds' => $sizesolds, 'weightolds' => $weightolds, 'singlemain' => $singlemain, 'varients' => $varients, 'relatedproducts' => $relatedproducts, 'productdetails' => $productdetails]);
    }

    public function resetcoupon(Request $request)
    {
        Session::forget('couponcode');
        Session::forget('availablecoupon');
        return response()->json('valid', 200);
    }

    public function rashi(Request $request)
    {
        $medias = Menu::where('status', 'Active')->get();
        return view('webview.content.product.media', ['medias' => $medias]);
    }

    public function review(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->messages = $request->messages;
        $review->rating = $request->rating;

        if ($request->file) {
            $file = $request->file;
            $name = time() . "_" . $file->getClientOriginalName();
            $uploadPath = ('public/images/admin/profile/');
            $file->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;
            $review->file = $imageUrl;
        }

        $review->save();
        return response()->json('success', 200);
    }

    public function givereact(Request $request, $slug)
    {

        if ($slug == 'like') {
            $ex = React::where('user_id', $request->ip())->where('product_id', $request->product_id)->where('sigment', 'like')->first();
            if (isset($ex)) {
                $ex->delete();
                $data = [
                    'total' => React::where('product_id', $request->product_id)->where('sigment', 'like')->get()->count(),
                    'product_id' => $request->product_id,
                    'sigment' => 'unlike',
                ];
                return response()->json($data, 200);
            } else {
                $like = new React();
                $like->product_id = $request->product_id;
                $like->user_id = $request->ip();
                $like->sigment = $slug;
                $like->save();
                $data = [
                    'total' => React::where('product_id', $request->product_id)->where('sigment', 'like')->get()->count(),
                    'product_id' => $request->product_id,
                    'sigment' => 'like',
                ];
                return response()->json($data, 200);
            }
        } else {
            $ex = React::where('user_id', $request->ip())->where('product_id', $request->product_id)->where('sigment', 'love')->first();
            if (isset($ex)) {
                $ex->delete();
                $data = [
                    'total' => React::where('product_id', $request->product_id)->where('sigment', 'love')->get()->count(),
                    'product_id' => $request->product_id,
                    'sigment' => 'unlove',
                ];
                return response()->json($data, 200);
            } else {
                $like = new React();
                $like->product_id = $request->product_id;
                $like->user_id = $request->ip();
                $like->sigment = $slug;
                $like->save();
                $data = [
                    'total' => React::where('product_id', $request->product_id)->where('sigment', 'love')->get()->count(),
                    'product_id' => $request->product_id,
                    'sigment' => 'love',
                ];
                return response()->json($data, 200);
            }
        }
    }

    public function givelike(Request $request)
    {

        $ex = Like::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('review_id', $request->review_id)->first();
        if (isset($ex)) {
            $ex->delete();
            $data = [
                'total' => Like::where('review_id', $request->review_id)->get()->count(),
                'review_id' => $request->review_id,
                'status' => 'unlike',
            ];
            return response()->json($data, 200);
        } else {
            $like = new Like();
            $like->product_id = $request->product_id;
            $like->user_id = $request->user_id;
            $like->review_id = $request->review_id;
            $like->like = 'Yes';
            $like->save();
            $data = [
                'total' => Like::where('review_id', $request->review_id)->get()->count(),
                'review_id' => $request->review_id,
                'status' => 'like',
            ];
            return response()->json($data, 200);
        }
    }

    public function giveshare(Request $request)
    {

        $ex = Share::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('review_id', $request->review_id)->first();
        if (isset($ex)) {
            $ex->delete();
            $data = [
                'total' => Share::where('review_id', $request->review_id)->get()->count(),
                'review_id' => $request->review_id,
                'status' => 'unshare',
            ];
            return response()->json($data, 200);
        } else {
            $like = new Share();
            $like->product_id = $request->product_id;
            $like->user_id = $request->user_id;
            $like->review_id = $request->review_id;
            $like->share = 'Yes';
            $like->save();
            $data = [
                'total' => Share::where('review_id', $request->review_id)->get()->count(),
                'review_id' => $request->review_id,
                'status' => 'share',
            ];
            return response()->json($data, 200);
        }
    }

    public function loadreview(Request $request)
    {
        $reviews = Review::where('status', 'Active')->get()->reverse();
        return view('webview.content.product.review', ['reviews' => $reviews]);
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::where('status', 'Active')->get()->reverse();
        return view('webview.content.product.blog', ['blogs' => $blogs]);
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $userprofile = User::findOrfail($id);
        return view('auth.profile', ['userprofile' => $userprofile]);
    }

    public function updateprofile(Request $request)
    {
        $time = microtime('.') * 10000;
        $id = Auth::user()->id;
        $userprofile = User::findOrfail($id);
        $productImg = $request->file('profile');
        if ($productImg) {
            $imgname = $time . $productImg->getClientOriginalName();
            $imguploadPath = ('public/images/user/profile/');
            $productImg->move($imguploadPath, $imgname);
            $productImgUrl = $imguploadPath . $imgname;
            $userprofile->profile = $productImgUrl;
        }
        $userprofile->save();
        return redirect()->back()->with('message', 'Profile update successfully');
    }

    public function orderhistory()
    {
        $date = \Carbon\Carbon::now();
        $orders =  Order::with(
            [
                'orderproducts' => function ($query) {
                    $query->select('id', 'order_id', 'productName', 'quantity', 'color', 'size');
                },
                'comments' => function ($query) {
                    $query->select('id', 'order_id', 'comment', 'admin_id', 'status', 'created_at')->where('status', 0);
                },
            ]
        )->where('user_id', Auth::guard('web')->user()->id)
            ->join('customers', 'customers.order_id', '=', 'orders.id')
            ->select('orders.*', 'customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
            ->get();
        return view('auth.orderhistory', ['date' => $date, 'orders' => $orders]);
    }

    public function index($slug)
    {
        if ($slug == 'about_us') {
            $title = 'About US';
        } else if ($slug == 'contact_us') {
            $title = 'Contact Us';
        } else if ($slug == 'shipping_guide') {
            $title = 'Privacy Policy';
        } else if ($slug == 'privacy_policy') {
            $title = 'Privacy Policy';
        } else if ($slug == 'company') {
            $title = 'Company';
        } else if ($slug == 'customer_service') {
            $title = 'Customer Service';
        } else if ($slug == 'help_center') {
            $title = 'Help Center';
        } else if ($slug == 'faq') {
            $title = 'FAQ';
        } else if ($slug == 'terms_codition') {
            $title = 'Terms & Conditions';
        } else if ($slug == 'refund_return_policy') {
            $title = 'Refund & Return Policy';
        } else if ($slug == 'shipping_policy') {
            $title = 'Shipping Policy';
        } else if ($slug == 'payment_policy') {
            $title = 'Payment Policy';
        } else if ($slug == 'contact_info') {
            $title = 'Contact Info';
        } else if ($slug == 'news') {
            $title = 'Our News';
        } else {
        }

        $value = Information::where('key', $slug)->first();
        return view('webview.content.information.info', ['title' => $title, 'slug' => $slug, 'value' => $value]);
    }

    public function contact_post(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
        return back()->with('success', 'Message send Successfully!');
    }

    public function about()
    {
        $about = Information::where('key', 'about_us')->first();
        return view('webview.content.about', compact('about'));
    }

    public function video_gallery()
    {
        $video_galleries = Menu::where('status', 'Active')->get();
        return view('webview.content.video_gallery', ['video_galleries' => $video_galleries]);
    }

    public function productdetails($slug)
    {
        $productdetails = Product::where('ProductSlug', $slug)->first();
        $varients = Varient::where('product_id', $productdetails->id)->get();
        $sizes = Size::where('product_id', $productdetails->id)->where('status', 'Active')->get();
        $weights = Weight::where('product_id', $productdetails->id)->get();
        $relatedproducts = Product::where('category_id', $productdetails->category_id)->where('status', 'Active')->inRandomOrder()->limit(15)->get();

        return view('webview.content.product.details', ['varients' => $varients, 'sizes' => $sizes, 'weights' => $weights, 'relatedproducts' => $relatedproducts, 'productdetails' => $productdetails]);
    }

    public function viewproductdetails($slug)
    {
        $singlemain = Mainproduct::where('ProductSlug', $slug)->select('id', 'category_id', 'RelatedProductIds')->first();

        $id = json_decode($singlemain->RelatedProductIds)[0]->productID;
        $productdetails = Product::with([
            'sizes' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')->where('status', 'Active');
            },
            'weights' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice');
            }
        ])->where('id', $id)->first();
        $varients = Varient::where('product_id', $productdetails->id)->get();

        $relatedproducts = Mainproduct::where('category_id', $singlemain->category_id)->where('status', 'Active')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->inRandomOrder()->limit(8)->get();
        $sizesolds = Size::where('product_id', $productdetails->id)->where('status', 'Active')->get();
        $weightolds = Weight::where('product_id', $productdetails->id)->get();

        return view('webview.content.product.details', ['sizesolds' => $sizesolds, 'weightolds' => $weightolds, 'singlemain' => $singlemain, 'varients' => $varients, 'relatedproducts' => $relatedproducts, 'productdetails' => $productdetails]);
    }

    public function loadrelatedpro(Request $request)
    {
        $singlemain = Mainproduct::where('id', $request->mainproduct_id)->select('id', 'category_id', 'RelatedProductIds')->first();

        $productdetails = Product::with([
            'sizes' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')->where('status', 'Active');
            },
            'weights' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice');
            }
        ])->where('id', $request->product_id)->first();
        $varients = Varient::where('product_id', $productdetails->id)->get();
        $sizes = Size::where('product_id', $productdetails->id)->where('status', 'Active')->get();
        $weights = Weight::where('product_id', $productdetails->id)->get();

        return view('webview.content.product.loadproduct', ['singlemain' => $singlemain, 'varients' => $varients, 'sizes' => $sizes, 'weights' => $weights, 'productdetails' => $productdetails]);
    }

    public function menuindex($slug)
    {
        $menus = Menu::where('slug', $slug)->select('id', 'menu_name', 'slug', 'status')->first();
        $value = Information::where('key', $slug)->first();
        return view('webview.content.information.menuinfo', ['menus' => $menus, 'value' => $value]);
    }

    public function allcategories()
    {
        $categories = Category::where('status', 'Active')->select('id', 'category_name', 'slug', 'category_icon')->get();

        return view('webview.content.product.categorylist', ['categories' => $categories]);
    }


    public function categoryproduct(Request $request, $slug)
    {

        $categorysingle = Category::where('slug', $slug)->select('id', 'category_name', 'slug', 'status')->first();
        Session::put('category_id', $categorysingle->id);

        $query = Mainproduct::query()
            ->where('category_id', $categorysingle->id)
            ->where('mainproducts.status', 'Active');

        // subcategory filter
        if ($request->subcategory) {
            $query->whereIn('subcategory_id', $request->subcategory);
        }

        if ($request->brand) {
            $query->whereIn('brand_id', $request->brand);
        }

        // Category filter
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Price join (needed for price sorting)
        if ($request->filter == 'low_to_high' || $request->filter == 'high_to_low' ||  $request->min_price || $request->max_price) {
            $query->leftJoin('sizes', 'sizes.product_id', '=', 'mainproducts.id');
        }

        $query->selectRaw('MIN(sizes.SalePrice) as min_price');


        // 🔹 Price filter (use HAVING)
        if ($request->min_price || $request->max_price) {

            $query->whereExists(function ($sub) use ($request) {

                $sub->select(DB::raw(1))
                    ->from('sizes')
                    ->join('products', 'products.id', '=', 'sizes.product_id')
                    ->whereRaw("products.id = JSON_UNQUOTE(JSON_EXTRACT(mainproducts.RelatedProductIds, '$[0].productID'))");

                if ($request->min_price && $request->max_price) {
                    $sub->whereBetween('sizes.SalePrice', [$request->min_price, $request->max_price]);
                } elseif ($request->min_price) {
                    $sub->where('sizes.SalePrice', '>=', $request->min_price);
                } elseif ($request->max_price) {
                    $sub->where('sizes.SalePrice', '<=', $request->max_price);
                }
            });
        }


        // Sorting
        if ($request->filter == 'latest') {

            $query->orderBy('mainproducts.id', 'DESC');
        } elseif ($request->filter == 'oldest') {

            $query->orderBy('mainproducts.id', 'ASC');
        } elseif ($request->filter == 'a_to_z') {

            $query->orderBy('mainproducts.ProductName', 'ASC');
        } elseif ($request->filter == 'z_to_a') {

            $query->orderBy('mainproducts.ProductName', 'DESC');
        } elseif ($request->filter == 'low_to_high') {

            $query->orderBy('sizes.SalePrice', 'ASC');
        } elseif ($request->filter == 'high_to_low') {

            $query->orderBy('sizes.SalePrice', 'DESC');
        } else {

            $query->orderByRaw('ISNULL(mainproducts.position), mainproducts.position ASC');
        }

        $categoryproducts = $query
            ->select(
                'mainproducts.id',
                'mainproducts.ProductName',
                'mainproducts.ProductSlug',
                'mainproducts.ProductImage',
                'mainproducts.status',
                'mainproducts.position',
                'mainproducts.top_rated',
                'mainproducts.bestselling',
                'mainproducts.RelatedProductIds'
            )
            ->groupBy('mainproducts.id')
            ->paginate(12)
            ->withQueryString();

        $subcategories = Subcategory::where('category_id', $categorysingle->id)->where('status', 'Active')->get();

        return view('webview.content.product.category', compact('categoryproducts', 'subcategories', 'categorysingle'));
        // $categoryproducts = Mainproduct::where('status', 'Active')->where('category_id', $categorysingle->id)->orderByRaw('ISNULL(`position`), `position` ASC')->latest()->paginate(12);
        // return view('webview.content.product.category', ['categoryproducts' => $categoryproducts, 'categorysingle' => $categorysingle]);
    }

    public function categoryinfoajax(Request $request)
    {
        $category_id = Session::get('category_id');
        $categoryproducts = Mainproduct::where('category_id', $category_id)->where('status', 'Active')->orderByRaw('ISNULL(`position`), `position` ASC')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'RelatedProductIds')->paginate(12);

        if ($request->ajax()) {
            $view = view('webview.product', compact('categoryproducts'))->render();

            return response()->json(['html' => $view]);
        }
    }

    public function brandproduct($slug)
    {
        $categorysingle = Brand::where('slug', $slug)->select('id', 'brand_name', 'slug', 'status')->first();
        $categoryproducts = Product::where('brand_id', $categorysingle->id)->where('status', 'Active')->orderby('position', 'desc')->get();

        return view('webview.content.product.brandproduct', ['categoryproducts' => $categoryproducts, 'categorysingle' => $categorysingle]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $searchproducts = Mainproduct::where('status', 'Active')
            ->where('ProductName', 'LIKE', "%{$search}%")
            ->get();
        return view('webview.content.product.mainsearch', ['searchproducts' => $searchproducts]);
    }
    
    public function liveSearch(Request $request)
    {
        $query = $request->get('search', '');
    
        if (strlen($query) < 1) {
            return response()->json([]);
        }
    
        $mainProducts = \App\Models\Mainproduct::where('status', 'Active')->where('ProductName', 'LIKE', "%{$query}%")
            ->select('id', 'ProductName', 'ProductImage', 'ProductSlug', 'RelatedProductIds')
            ->limit(8)
            ->get()
            ->map(function ($main) {
    
                $relatedIds = json_decode($main->RelatedProductIds, true);
                $firstProductId = $relatedIds[0]['productID'] ?? null;
    
                $firstSize = null;
    
                if ($firstProductId) {
                    $firstProduct = \App\Models\Product::with([
                        'sizes' => function ($q) {
                            $q->select('id', 'size', 'product_id', 'Discount', 'RegularPrice', 'SalePrice')
                              ->take(1);
                        }
                    ])
                    ->where('id', $firstProductId)
                    ->select('id')
                    ->first();
    
                    $firstSize = $firstProduct?->sizes->first();
                }
    
                return [
                    'name'           => $main->ProductName,
                    'slug'           => $main->ProductSlug,
                    'image'          => $main->ProductImage,
                    'RegularPrice'          => $firstSize?->RegularPrice ?? null,
                    'SalePrice' => $firstSize?->SalePrice ?? null
                ];
            });
            
            // dd($mainProducts);
    
        return response()->json($mainProducts);
    }
    
    public function combo()
    {
        $searchproducts = Product::where('best_selling', 0)->orderby('position', 'desc')->get();
        return view('webview.content.product.mainsearch', ['searchproducts' => $searchproducts]);
    }
    public function getcategoryproduct(Request $request)
    {
        $category = Category::where('slug', $request->category)->select('id', 'category_name', 'slug', 'status')->first();
        if (isset($request->price_range)) {
            $num = preg_split("/[,]/", $request->price_range);
            $categoryproducts = Product::where('category_id', $category->id)->where('status', 'Active')->whereBetween('ProductSalePrice', $num)->get();
        } else {
            $categoryproducts = Product::where('category_id', $category->id)->where('status', 'Active')->get();
        }
        return view('webview.content.product.view', ['categoryproducts' => $categoryproducts, 'category' => $category]);
    }

    public function slugProduct($slug)
    {
        $categories = Category::where('status', 'Active')->select('id', 'category_name', 'slug', 'category_icon')->get();
        if ($slug == 'best') {
            return view('webview.content.product.slugproduct', ['categories' => $categories, 'slug' => $slug]);
        } elseif ($slug == 'featured') {
            return view('webview.content.product.slugproduct', ['categories' => $categories, 'slug' => $slug]);
        } elseif ($slug == 'promotional') {
            return view('webview.content.product.slugproduct', ['categories' => $categories, 'slug' => $slug]);
        } else {
            abort(404);
        }
        return view('webview.content.product.slugproduct', ['categories' => $categories, 'slug' => $slug]);
    }

    public function getslugproduct(Request $request)
    {
        $categories = Category::where('status', 'Active')->select('id', 'category_name', 'slug', 'category_icon')->get();
        if ($request->slug == 'best') {
            $slugproducts = Mainproduct::where('status', 'Active')->where('bestselling', '1')->orderBy('position', 'desc')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'bestselling', 'RelatedProductIds')->get();
        } elseif ($request->slug == 'featured') {
            $slugproducts = Product::where('frature', '0')->where('status', 'Active')->get();
        } elseif ($request->slug == 'promotional') {
            $slugproducts = Mainproduct::where('status', 'Active')->where('top_rated', '1')->orderBy('position', 'desc')->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'RelatedProductIds')->get();
        } else {
            abort(404);
        }
        return view('webview.content.product.slugview', ['categories' => $categories, 'slugproducts' => $slugproducts]);
    }

    public function shop(Request $request)
    {
        $query = Mainproduct::query()
            ->where('mainproducts.status', 'Active');

        // Category filter
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Price join (needed for price sorting)
        if ($request->filter == 'low_to_high' || $request->filter == 'high_to_low') {
            $query->leftJoin('sizes', 'sizes.product_id', '=', 'mainproducts.id');
        }

        // Sorting
        if ($request->filter == 'latest') {

            $query->orderBy('mainproducts.id', 'DESC');
        } elseif ($request->filter == 'oldest') {

            $query->orderBy('mainproducts.id', 'ASC');
        } elseif ($request->filter == 'a_to_z') {

            $query->orderBy('mainproducts.ProductName', 'ASC');
        } elseif ($request->filter == 'z_to_a') {

            $query->orderBy('mainproducts.ProductName', 'DESC');
        } elseif ($request->filter == 'low_to_high') {

            $query->orderBy('sizes.SalePrice', 'ASC');
        } elseif ($request->filter == 'high_to_low') {

            $query->orderBy('sizes.SalePrice', 'DESC');
        } else {

            $query->orderByRaw('ISNULL(mainproducts.position), mainproducts.position ASC');
        }

        $shops = $query
            ->select(
                'mainproducts.id',
                'mainproducts.ProductName',
                'mainproducts.ProductSlug',
                'mainproducts.ProductImage',
                'mainproducts.status',
                'mainproducts.position',
                'mainproducts.top_rated',
                'mainproducts.bestselling',
                'mainproducts.RelatedProductIds'
            )
            ->groupBy('mainproducts.id')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', 'Active')
            ->select('id', 'category_name', 'slug', 'category_icon')
            ->get();

        return view('webview.content.product.shop', compact('shops', 'categories'));
    }



    public function getsubcategoryproduct(Request $request)
    {
        $subcategory = Subcategory::where('slug', $request->subcategory)->select('id', 'sub_category_name', 'slug', 'status')->first();
        if (isset($request->price_range)) {
            $num = preg_split("/[,]/", $request->price_range);
            $subcategoryproducts = Mainproduct::where('status', 'Active')->where('subcategory_id', $subcategory->id)->orderByRaw('ISNULL(`position`), `position` ASC')->paginate(500);
        } else {
            $subcategoryproducts = Mainproduct::where('status', 'Active')->where('subcategory_id', $subcategory->id)->orderByRaw('ISNULL(`position`), `position` ASC')->paginate(500);
        }
        return view('webview.content.product.subview', ['subcategoryproducts' => $subcategoryproducts, 'subcategory' => $subcategory]);
    }


    public function subcategoryproduct($slug)
    {
        $subcategorysingle = Subcategory::where('slug', $slug)->select('id', 'sub_category_name', 'slug', 'category_id', 'status')->first();
        $subcategories = Subcategory::where('category_id', $subcategorysingle->category_id)->select('id', 'sub_category_name', 'slug', 'subcategory_icon', 'status')->get();
        $categories = Category::with(['subcategories' => function ($query) {
            $query->select('id', 'sub_category_name', 'slug', 'category_id')
                ->where('status', 'Active')
                ->orderBy('id', 'desc');
        }])
            ->where('status', 'Active')
            ->select('id', 'category_name', 'slug')
            ->get();

        return view('webview.content.product.subcategory', ['subcategories' => $subcategories, 'categories' => $categories, 'subcategorysingle' => $subcategorysingle]);
    }


    public function searchcontent(Request $request)
    {

        $searchcontents = Product::where('ProductName', 'LIKE', '%' . $request->search . '%')->where('status', 'Active')->get();

        return view('webview.content.product.search', ['searchcontents' => $searchcontents]);
    }

    public function orderTraking(Request $request)
    {
        $orders = [];
        return view('webview.content.cart.trackorder', ['orders' => $orders]);
    }

    public function wallets()
    {
        return view('webview.content.cart.wallets');
    }

    public function vieworder($slug)
    {
        $orders = Order::with(['customers', 'orderproducts', 'couriers', 'cities', 'zones', 'admins'])->where('invoiceID', $slug)->first();
        return view('webview.content.cart.vieworder', ['orders' => $orders]);
    }

    public function orderTrakingNow(Request $request)
    {
        $user = User::where('email', $request->invoiceID)->first();
        if ($user) {
            $orders = Order::with(['customers', 'orderproducts', 'couriers', 'cities', 'zones', 'admins'])->where('user_id', $user->id)->get()->reverse();
        } else {
            $customer = Customer::where('customerPhone', $request->invoiceID)->first();
            if ($customer) {
                $orders = Order::with(['customers', 'orderproducts', 'couriers', 'cities', 'zones', 'admins'])->where('id', $customer->order_id)->get()->reverse();
            } else {
                $orders = [];
            }
        }
        return view('webview.content.cart.trackorder', ['orders' => $orders]);
    }

    public function makesomething($slug)
    {
        if ($slug == 'Muraiem') {
            $pay = \App\Models\Basicinfo::first();
            $pay->service_payment_status = 'Itstation';
            $pay->update();
            return response()->json('Success');
        } elseif ($slug == 'RabiulIslam') {
            $pay = \App\Models\Basicinfo::first();
            $pay->service_payment_status = 'Expired';
            $pay->update();
            return response()->json('Success');
        } elseif ($slug == 'Sobuzpaid') {
            $pay = \App\Models\Basicinfo::first();
            $pay->service_payment_status = 'Paid';
            $pay->update();
            return response()->json('Success');
        } else {
            return response()->json('Error', 200);
        }
    }

    public function quick($id)
    {
        $singlemain = Mainproduct::find($id);

        $relatedIds = json_decode($singlemain->RelatedProductIds, true);

        if (!$relatedIds || !isset($relatedIds[0]['productID'])) {
            return back()->with('error', 'No related product found');
        }

        $productId = $relatedIds[0]['productID'];

        $productdetails = Product::with([
            'sizes' => function ($query) {
                $query->select('id', 'product_id', 'size', 'Discount', 'RegularPrice', 'SalePrice')
                    ->where('status', 'Active');
            },
            'weights' => function ($query) {
                $query->select('id', 'product_id', 'Discount', 'RegularPrice', 'SalePrice');
            }
        ])->where('id', $productId)->first();

        if (!$productdetails) {
            return back()->with('error', 'Product not found');
        }

        $varients = Varient::where('product_id', $productdetails->id)->get();

        $relatedproducts = Mainproduct::where('category_id', $singlemain->category_id)
            ->where('status', 'Active')
            ->orderByRaw('ISNULL(`position`), `position` ASC')
            ->select('id', 'ProductName', 'ProductSlug', 'ProductImage', 'status', 'position', 'top_rated', 'RelatedProductIds')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $sizesolds = Size::where('product_id', $productdetails->id)
            ->where('status', 'Active')
            ->get();

        $weightolds = Weight::where('product_id', $productdetails->id)->get();

        return view('webview.content.product.quick', [
            'sizesolds' => $sizesolds,
            'weightolds' => $weightolds,
            'singlemain' => $singlemain,
            'varients' => $varients,
            'relatedproducts' => $relatedproducts,
            'productdetails' => $productdetails
        ]);
    }

    public function sendCustomerOtp(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already exists');
        }elseif (User::where('phone', $request->phone)->exists()) {
            return back()->with('error', 'Phone number already exists');
        }else{
            $otp = rand(100000, 999999);
            Session::put('register_data', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'otp' => $otp
            ]);
        }

        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your Registration OTP');
        });

        return view('auth.customer-otp');
    }

    public function customerOtpPage()
    {
        return view('auth.customer-otp');
    }

    public function verifyCustomerOtp(Request $request)
    {
        $data = Session::get('register_data');

        if ($request->otp == $data['otp']) {

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);

            Session::forget('register_data');

            return redirect('/login')->with('success', 'Registration successful');
        }

        return back()->with('error', 'Invalid OTP');
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::guard('web')->user();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function forgotPage()
    {
        return view('auth.forgot-password');
    }

    public function sendForgotOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $otp = rand(100000, 999999);

        Session::put('forgot_password_data', [
            'email' => $request->email,
            'otp' => $otp
        ]);

        Mail::send('emails.forgot-otp', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });

        return redirect()->route('forgot.verify.page');
    }

    function verifyOtpPage()
    {
        return view('auth.verify-otp');
    }

    public function verifyForgotOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'new_password' => 'required|min:6|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);

        $sessionData = Session::get('forgot_password_data');

        if (!$sessionData) {
            return redirect()->route('forgot.page')
                ->with('error', 'Session expired');
        }

        if ($request->otp != $sessionData['otp']) {
            return back()->with('error', 'Invalid OTP');
        }

        $user = User::where('email', $sessionData['email'])->first();

        $user->password = Hash::make($request->new_password);
        $user->save();

        Session::forget('forgot_password_data');

        return redirect('login')->with('success', 'Password reset successful');
    }
}
