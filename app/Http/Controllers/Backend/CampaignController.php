<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('backend.content.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 'Active')->get();
        $categories = Category::where('status', 'Active')->get();
        return view('backend.content.campaign.create', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'review_images' => 'nullable|array',
            'review_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'oldprice_title' => 'nullable|string|max:255',
            'price_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'product_id' => 'required|array',
        ]);

        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->slug = Str::slug($request->name);
        $campaign->title = $request->title;
        $campaign->subtitle = $request->subtitle;
        $campaign->oldprice_title = $request->oldprice_title;
        $campaign->price_title = $request->price_title;
        $campaign->description = $request->description;
        $campaign->why_choose = $request->why_choose;
        $campaign->category_id = $request->category_id;
        $campaign->product_id = json_encode($request->product_id);

        if ($request->file('image')) {
            $image = $request->file('image');

            $imageName = microtime('.') . '.' . $image->getClientOriginalExtension();
            $imagePath = 'public/images/campaign/';
            $image->move($imagePath, $imageName);

            $campaign->image = $imagePath . $imageName;
        }
        if ($request->file('image2')) {
            $image2 = $request->file('image2');

            $image2Name = microtime('.') . '.' . $image2->getClientOriginalExtension();
            $image2Path = 'public/images/campaign/';
            $image2->move($image2Path, $image2Name);

            $campaign->image2 = $image2Path . $image2Name;
        }

        if ($request->hasFile('review_images')) {
            $reviewImagePaths = [];
            foreach ($request->file('review_images') as $reviewImage) {
                $reviewImageName = time() . '_' . uniqid() . '.' . $reviewImage->getClientOriginalExtension();
                $reviewImagePath = 'public/images/campaign/reviews/';
                $reviewImage->move($reviewImagePath, $reviewImageName);
                $reviewImagePaths[] = $reviewImagePath . $reviewImageName;
            }
            $campaign->review_images = json_encode($reviewImagePaths);
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $products = Product::where('status', 'Active')->get();
        $categories = Category::where('status', 'Active')->get();
        return view('backend.content.campaign.edit', compact('campaign', 'products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'review_images' => 'nullable|array',
            'review_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'oldprice_title' => 'nullable|string|max:255',
            'price_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'product_id' => 'required|array',
        ]);

        $campaign = Campaign::findOrFail($id);

        $campaign->name = $request->name;
        $campaign->slug = Str::slug($request->name);
        $campaign->title = $request->title;
        $campaign->subtitle = $request->subtitle;
        $campaign->oldprice_title = $request->oldprice_title;
        $campaign->price_title = $request->price_title;
        $campaign->description = $request->description;
        $campaign->why_choose = $request->why_choose;
        $campaign->category_id = $request->category_id;
        $campaign->product_id = json_encode($request->product_id);

        if ($request->file('image')) {

            if ($campaign->image && file_exists($campaign->image)) {
                unlink($campaign->image);
            }

            $image = $request->file('image');
            $imageName = microtime(true) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'public/images/campaign/';
            $image->move($imagePath, $imageName);

            $campaign->image = $imagePath . $imageName;
        }
        if ($request->file('image2')) {

            if ($campaign->image2 && file_exists($campaign->image2)) {
                unlink($campaign->image2);
            }

            $image2 = $request->file('image2');
            $image2Name = microtime(true) . '.' . $image2->getClientOriginalExtension();
            $image2Path = 'public/images/campaign/';
            $image2->move($image2Path, $image2Name);

            $campaign->image2 = $image2Path . $image2Name;
        }

        if ($request->hasFile('review_images')) {
            if ($campaign->review_images) {
                $oldReviewImages = json_decode($campaign->review_images, true);
                foreach ($oldReviewImages as $oldReviewImage) {
                    if ($oldReviewImage && file_exists($oldReviewImage)) {
                        unlink($oldReviewImage);
                    }
                }
            }

            $reviewImagePaths = [];
            foreach ($request->file('review_images') as $reviewImage) {
                $reviewImageName = time() . '_' . uniqid() . '.' . $reviewImage->getClientOriginalExtension();
                $reviewImagePath = 'public/images/campaign/reviews/';
                $reviewImage->move($reviewImagePath, $reviewImageName);
                $reviewImagePaths[] = $reviewImagePath . $reviewImageName;
            }
            $campaign->review_images = json_encode($reviewImagePaths);
        }

        $campaign->save();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        if ($campaign->image && file_exists(public_path($campaign->image))) {
            unlink(public_path($campaign->image));
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully!');
    }
}
