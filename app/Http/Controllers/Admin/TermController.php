<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermBanner;
use App\Models\Term;

class TermController extends Controller
{
    //
    public function edit(){
        $term = TermBanner::first();
        return view('admin.term.edit', compact('term'));
    }
    public function terms(){
        $term = Term::first();
        return view('admin.term.term', compact('term'));
    }
    public function Addterm(Request $request){
                    // ✅ Validate all FAQ fields
    $rules = [];
    for ($i = 1; $i <= 5; $i++) {
        $rules["title_$i"] = 'nullable|string|max:255';
        $rules["content_$i"] = 'nullable|string';
    }

    $validated = $request->validate($rules);

 
    $term = Term::first();

    if (!$term) {
        $term = new Term();
    }
    for ($i = 1; $i <= 5; $i++) {
        $term->{"title_$i"} = $validated["title_$i"] ?? null;
        $term->{"content_$i"} = $validated["content_$i"] ?? null;
    }

    // ✅ Save changes
    $term->save();

    return redirect()->back()->with('success', 'Terms updated successfully.');
    
    }


    public function update(Request $request){
          $about = TermBanner::first();
    // If no banner exists, create a new one
    if (!$about) {
        $about  = new TermBanner();
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'breadcrumb' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = 'terms_banner_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('terms_banners', $filename, 'public');
        $about->image = $path;
    }

    $about->title = $request->title;
    $about->breadcrumb = $request->breadcrumb;
    $about->save();

    return redirect()->back()->with('success', 'Terms banner updated successfully.');
    }
}
