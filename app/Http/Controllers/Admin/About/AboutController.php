<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutBanner;
use App\Models\AboutBrand;
use Illuminate\Support\Facades\File;


class AboutController extends Controller
{
    //
    public function edit(){
        $about = AboutBanner::first();
        return view('admin.about.edit',compact('about'));
    }

        public function update(Request $request){
      
    $about = AboutBanner::first();
    // If no banner exists, create a new one
    if (!$about) {
        $about  = new AboutBanner();
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'breadcrumb' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = 'contact_banner_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('contact_banners', $filename, 'public');
        $about->image = $path;
    }

    $about->title = $request->title;
    $about->breadcrumb = $request->breadcrumb;
    $about->save();

    return redirect()->route('admin.about.edit')->with('success', 'About banner updated successfully.');

    }


    public function create(){
        return view('admin.about.create');
    }

 

        public function store(Request $request)
    {
        // ✅ Step 1: Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // ✅ Step 2: New Model Object
        $brand = new AboutBrand();
        $brand->name = $request->name;

        // ✅ Step 3: Handle Image Upload (if available)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/brands'), $filename);
            $brand->logo = 'uploads/brands/' . $filename;
        }

        // ✅ Step 4: Save to Database
        $brand->save();

        // ✅ Step 5: Redirect Back with Message
        return redirect()->route('admin.about.brand')->with('success', 'Brand added successfully!');
    }



    public function brand(){
        $brands = AboutBrand::latest()->get();
        return view('admin.about.brand', compact('brands'));
    }

        public function editBrand($id)
    {
        $brand = AboutBrand::findOrFail($id);
        return view('admin.about.brandedit', compact('brand'));
    }



        // 🟢 Update
    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $brand = AboutBrand::findOrFail($id);
        $brand->name = $request->name;

        if ($request->hasFile('logo')) {
            if ($brand->logo && File::exists(public_path($brand->logo))) {
                File::delete(public_path($brand->logo));
            }

            $file = $request->file('logo');
            $path = 'uploads/brands/';
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
            $brand->logo = $path . $filename;
        }

        $brand->save();

        return redirect()->route('admin.about.brand')->with('success', 'Brand updated successfully');
    }



        // 🟢 Delete
    public function destroy($id)
    {
        $brand = AboutBrand::findOrFail($id);

        if ($brand->logo && File::exists(public_path($brand->logo))) {
            File::delete(public_path($brand->logo));
        }

        $brand->delete();
        return redirect()->route('admin.about.brand')->with('warning', 'Brand deleted successfully');
    }

}
