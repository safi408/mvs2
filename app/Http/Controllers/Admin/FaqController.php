<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqBanner;
use App\Models\Faq;

class FaqController extends Controller
{
    //
    public function edit(){
        $faq = FaqBanner::first();
        return view('admin.faq.edit',compact('faq'));
    }
    public function update(Request $request){
     $faq = FaqBanner::first();
    // If no banner exists, create a new one
    if (!$faq) {
        $faq  = new FaqBanner();
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'breadcrumb' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = 'faqs_banner_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('faqs_banners', $filename, 'public');
        $faq->image = $path;
    }

    $faq->title = $request->title;
    $faq->breadcrumb = $request->breadcrumb;
    $faq->save();

    return redirect()->back()->with('success', 'FAQS banner updated successfully.');
    }
    public function create(){
        return view('admin.faq.create');
    }


        // Store FAQs from dynamic form
    public function store(Request $request) {
        $data = $request->validate([
            'categories' => 'required|array',
            'categories.*.category' => 'required|string|max:255',
            'categories.*.faqs' => 'required|array',
            'categories.*.faqs.*.question' => 'required|string|max:255',
            'categories.*.faqs.*.answer' => 'required|string',
        ]);

        foreach ($data['categories'] as $cat) {
            foreach ($cat['faqs'] as $faq) {
                Faq::create([
                    'category' => $cat['category'],
                    'question' => $faq['question'],
                    'answer'   => $faq['answer'],
                ]);
            }
        }

        return redirect()->route('admin.faq.index')->with('success', 'FAQs added successfully!');
    }


    public function show(){
        $faqs = Faq::latest()->get();
        return view('admin.faq.manage',compact('faqs'));
    }

    
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('warning', 'FAQ deleted successfully!');
    }

    public function edit2($id){
       $faq = Faq::find($id);
       return view('admin.faq.edit2', compact('faq'));
    }

    public function update2(Request $request, $id)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'question' => 'required|string',
        'answer'   => 'required|string',
    ]);

    $faq = Faq::findOrFail($id);
    $faq->update([
        'category' => $request->category,
        'question' => $request->question,
        'answer'   => $request->answer,
    ]);

    return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully!');
}

}
