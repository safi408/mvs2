<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    //
    public function create(){
        return view('admin.home.testimonial.create');
    }
       /**
     * Store a new testimonial
     */
    public function store(Request $request)
    {
        // ✅ Validate request
        $request->validate([
            'name'          => 'required|string|max:255',
            'title'         => 'nullable|string|max:255',
            'order'         => 'nullable|integer',
            'message'       => 'required|string',
            'rating'        => 'nullable|integer|min:1|max:5',
            'is_active'     => 'nullable|boolean',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'price'         => 'required',
        ]);

        // ✅ Handle customer image
        $imageAddress1 = null;
        if ($request->hasFile('image')) {
            $imageAddress1 = 'customer_' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('customer', $imageAddress1, 'public');
        }

        // ✅ Handle product image
        $imageAddress2 = null;
        if ($request->hasFile('product_image')) {
            $imageAddress2 = 'review_' . time() . '.' . $request->product_image->getClientOriginalExtension();
            $request->product_image->storeAs('review', $imageAddress2, 'public');
        }

        // ✅ Create and save testimonial
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->message = $request->message;
        $testimonial->price = $request->price;
        $testimonial->rating = $request->rating;
        $testimonial->order = $request->order;

        // ✅ Fix: default is_active to 0 if checkbox not checked
        $testimonial->is_active = $request->has('is_active') ? 1 : 0;

        $testimonial->image = $imageAddress1 ? 'customer/' . $imageAddress1 : null;
        $testimonial->product_image = $imageAddress2 ? 'review/' . $imageAddress2 : null;
        $testimonial->save();

        // ✅ Redirect back with success message
        return redirect()->route('admin.testimonial.show')->with('success', 'Testimonial added successfully!');
    }



public function show()
{
    // Fetch all testimonials, latest first
    $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

    // Return view with data
    return view('admin.home.testimonial.manage', compact('testimonials'));
}


    // Delete Testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Delete images if exist
        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        if ($testimonial->product_image && Storage::disk('public')->exists($testimonial->product_image)) {
            Storage::disk('public')->delete($testimonial->product_image);
        }

        // Delete testimonial
        $testimonial->delete();

        // Redirect back with success message
        return redirect()->route('admin.testimonial.show')->with('warning', 'Testimonial deleted successfully.');
    }


    public function edit($id)
{
    $testimonial = Testimonial::findOrFail($id);
    return view('admin.home.testimonial.edit', compact('testimonial'));
}



    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Validate input
        $request->validate([
            'name'          => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'order'         => 'required|integer|min:1',
            'message'       => 'required|string',
            'rating'        => 'required|integer|min:1|max:5',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'is_active'     => 'nullable|boolean'
        ]);

        // Update fields
        $testimonial->name       = $request->name;
        $testimonial->title      = $request->title;
        $testimonial->order      = $request->order;
        $testimonial->message    = $request->message;
        $testimonial->price  = $request->price;
        $testimonial->rating     = $request->rating;
        $testimonial->is_active  = $request->has('is_active') ? 1 : 0;

        // Handle customer image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image && Storage::exists($testimonial->image)) {
                Storage::delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        // Handle product image upload
        if ($request->hasFile('product_image')) {
            if ($testimonial->product_image && Storage::exists($testimonial->product_image)) {
                Storage::delete($testimonial->product_image);
            }
            $testimonial->product_image = $request->file('product_image')->store('testimonials', 'public');
        }

        $testimonial->save();

        return redirect()->route('admin.testimonial.show')
                         ->with('success', 'Testimonial updated successfully!');
    }



}
