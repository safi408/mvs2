<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreFeature;

class StoreFeatureController extends Controller
{
    //
    public function create(){
        return view('admin.home.storefeature.create');
    }
    public function store(Request $request){

      $request->validate([
        'icon' =>  'required',
        'title' => 'required',
        'description' => 'required'
      ]);

       $store = new StoreFeature();
       $store->icon = $request->icon;
       $store->title = $request->title;
       $store->description = $request->description;

       $store->save();

       return redirect()->route('admin.feature.index')->with('success', 'Store Feature saved successfully!');

    }
    public function show(){

        $features = StoreFeature::all();  
        return view('admin.home.storefeature.manage', compact('features'));
    }

    public function delete($id){
        $feature = StoreFeature::find($id);
        $feature->delete();
        return redirect()->route('admin.feature.index')->with('warning', 'Store Feature deleted succfully!');
    }
    public function edit($id){
      $feature = StoreFeature::find($id);
      return view('admin.home.storefeature.edit', compact('feature'));
    }

    public function update(Request $request, $id){
      
      $request->validate([
        'icon' =>  'required',
        'title' => 'required',
        'description' => 'required'
      ]);

      $store = StoreFeature::find($id);

       $store->icon = $request->icon;
       $store->title = $request->title;
       $store->description = $request->description;

        $store->save();

       return redirect()->route('admin.feature.index')->with('success', 'Store Feature updated successfully!');


    }
}
