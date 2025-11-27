<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ShopCollection;

class ShopCollectionController extends Controller
{
    //
    public function create()
    {

        $collection = ShopCollection::first();

   
        if (!$collection) {
            $collection = ShopCollection::create([
                'title1' => 'Default Title 1',
                'subtitle1' => 'Default Subtitle 1',
                'button_text1' => 'Shop Now',
                'title2' => 'Default Title 2',
                'subtitle2' => 'Default Subtitle 2',
                'button_text2' => 'Shop Now',
                'status' => true,
            ]);
        }

        return view('admin.home.shop.create', compact('collection'));
    }
    // public function store(Request $request){
       
    //   $request->validate([
    //      'title' => 'required',
    //      'subtitle' => 'required',
    //      'button_text' => 'required'
    //    ]);


    //    $imageAddress = "shopcollection".time().'.'.$request->image->getClientOriginalExtension();
    //    $request->image->StoreAs('shopcollection',$imageAddress,'public');

    //    $shop = new ShopCollection();
    //    $shop->title = $request->title;
    //    $shop->subtitle = $request->subtitle;
    //    $shop->button_text = $request->button_text;
    //    $shop->image = "shopcollection/".$imageAddress;

    //    $shop->save();

    //    return redirect()->route('admin.shop.show')->with('success','Shop Collection save successfully!');

    // }



    // public function delete($id){
    //    $collection = ShopCollection::find($id);
    //    $collection->delete();
    //    return redirect()->route('admin.shop.show')->with('warning','shop collection deleted successfully!');
    // }

    // public function edit($id){
    //      $collection = ShopCollection::find($id);
    //      return view('admin.home.shop.edit',compact('collection'));
    // }


    
    // 🟦 Update first record
    public function update(Request $request, $id)
    {
        $collection = ShopCollection::findOrFail($id);

        $request->validate([
            'title1' => 'nullable|string|max:255',
            'subtitle1' => 'nullable|string|max:255',
            'button_text1' => 'nullable|string|max:100',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'title2' => 'nullable|string|max:255',
            'subtitle2' => 'nullable|string|max:255',
            'button_text2' => 'nullable|string|max:100',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'button_link' => 'nullable|url',
            'status' => 'nullable|boolean',
        ]);

        // 🖼️ Handle image uploads
        foreach (['image1', 'image2'] as $field) {
            if ($request->hasFile($field)) {
                if ($collection->$field && Storage::exists('public/' . $collection->$field)) {
                    Storage::delete('public/' . $collection->$field);
                }
                $path = $request->file($field)->store('collections', 'public');
                $collection->$field = $path;
            }
        }

        // 🧾 Update other fields
        $collection->fill($request->except(['image1', 'image2']));
        $collection->status = $request->has('status');
        $collection->save();

        return redirect()->back()->with('success', 'Shop Collection updated successfully!');
    }



}
