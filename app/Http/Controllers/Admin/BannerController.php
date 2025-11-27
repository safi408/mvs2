<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    //
    public function create(){
        return view('admin.banner.create');
    }
      public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'title' => 'string|max:255',
            'subtitle' => 'string|max:255',
            'text_button' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ Prepare data
        $data = $request->only(['title', 'subtitle', 'text_button']);

        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            // store('banners', 'public') => saves to storage/app/public/banners
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        // ✅ Save banner to DB
        Banner::create($data);

        // ✅ Redirect back or to banner list
        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner added successfully!');
    }
    public function index(){
        $banners = Banner::latest()->get();
        return view('admin.banner.manage', compact('banners'));
    }

    public function destroy($id)
{
    $banner = Banner::findOrFail($id);

    // 🧹 Delete image file if it exists
    if ($banner->image && \Storage::disk('public')->exists($banner->image)) {
        \Storage::disk('public')->delete($banner->image);
    }

    // 🗑️ Delete the banner
    $banner->delete();

    return redirect()
        ->route('banner.index')
        ->with('warning', 'Banner deleted successfully!');
}
public function edit($id){
    $banner = Banner::find($id);
    return view('admin.banner.edit', compact('banner'));
}

public function update(Request $request, $id)
{
    $banner = \App\Models\Banner::findOrFail($id);

    $request->validate([
        'title' => 'string|max:255',
        'subtitle' => 'string|max:255',
        'text_button' => 'string|max:255',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only(['title', 'subtitle', 'text_button', 'status']);

    if ($request->hasFile('image')) {
        // Delete old image
        if ($banner->image && \Storage::disk('public')->exists($banner->image)) {
            \Storage::disk('public')->delete($banner->image);
        }

        // Upload new one
        $data['image'] = $request->file('image')->store('banners', 'public');
    }

    $banner->update($data);

    return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
}


public function toggleStatus($id)
{
    $banner = Banner::findOrFail($id);

    // Toggle status
    $banner->status = $banner->status === 'active' ? 'inactive' : 'active';
    $banner->save();

    return redirect()->back()->with('success', 'Banner status updated!');
}



}
