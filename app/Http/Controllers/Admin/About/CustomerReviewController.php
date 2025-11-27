<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReview;

class CustomerReviewController extends Controller
{
    //
    public function create(){
        return view('admin.about.review.create');
    }
        // ✅ Store review
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        CustomerReview::create([
            'name' => $request->name,
            'title' => $request->title,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->route('admin.about.customer.show')->with('success', 'Review added successfully!');
    }
    public function show(){
        $reviews = CustomerReview::latest()->get();
        return view('admin.about.review.manage', compact('reviews'));
    }
        // ✅ Show edit form
    public function edit($id)
    {
        $review = CustomerReview::findOrFail($id);
        return view('admin.about.review.edit', compact('review'));
    }

    // ✅ Update review
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = CustomerReview::findOrFail($id);
        $review->update($request->only(['name', 'title', 'message', 'rating']));

        return redirect()->route('admin.about.customer.show')->with('success', 'Review updated successfully!');
    }

    // ✅ Delete review
    public function destroy($id)
    {
        $review = CustomerReview::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.about.customer.show')->with('warning', 'Review deleted successfully!');
    }
}
