<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductBrand;
use Illuminate\Support\Facades\Storage;

class ProductBrandController extends Controller
{
    //
    public function create(){
        return view('admin.brand.create');
    }
    public function show(){
        $brands = ProductBrand::latest()->get();
        return view('admin.brand.manage', compact('brands'));
    }
    public function store(Request $request){

      $request->validate([
          'name' => 'required',
       ]);

      $brand = new ProductBrand;
      $imageAddress = 'brands_logo'.time().'.'.$request->image->getClientOriginalExtension();
      $request->image->StoreAs('brands_logo',$imageAddress,'public');

      $brand->name = $request->name;
      $brand->logo = 'brands_logo/'.$imageAddress;

      $brand->save();

      return redirect()->route('admin.productbrand.index')->with('success','product brand saved successfully!');
    
    }
    public function edit($id){
       $brand = ProductBrand::find($id);
       return view('admin.brand.edit',compact('brand'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
    ]);

    $brand = ProductBrand::findOrFail($id);

    // ✅ Check if new image uploaded
    if ($request->hasFile('image')) {

        // ✅ Delete old image (only if file exists and is NOT a directory)
        if ($brand->logo) {
            $oldImagePath = storage_path('app/public/' . $brand->logo);
            if (file_exists($oldImagePath) && !is_dir($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // ✅ Upload new image
        $imageAddress = 'brands_logo' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('brands_logo', $imageAddress, 'public');

        $brand->logo = 'brands_logo/' . $imageAddress;
    }

    // ✅ Update name
    $brand->name = $request->name;

    $brand->save();

    return redirect()->route('admin.productbrand.index')->with('success', 'Product brand updated successfully!');
}




    public function destroy($id){
        $brand = ProductBrand::find($id);
        $brand->delete();
        return redirect()->route('admin.productbrand.index')->with('warning', 'product brand deleted successfully!');
    }
}
