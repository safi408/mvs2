<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    //
    public function AboutSection(){
        $about = AboutSection::first();
        return view('admin.about.abouctsection',compact('about'));
    }

    
        public function update(Request $request)
    {

  $about = AboutSection::first() ?? new AboutSection();

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'tab1_title' => 'nullable|string|max:255',
            'tab1_content' => 'nullable|string',
            'tab2_title' => 'nullable|string|max:255',
            'tab2_content' => 'nullable|string',
            'tab3_title' => 'nullable|string|max:255',
            'tab3_content' => 'nullable|string',
            'tab4_title' => 'nullable|string|max:255',
            'tab4_content' => 'nullable|string',
        ]);

        // Handle image upload (replace old image)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('about_section', 'public');
            $about->image = $imagePath;
        }




        // Update other fields
        $about->title = $request->title;
        $about->tab1_title = $request->tab1_title;
        $about->tab1_content = $request->tab1_content;
        $about->tab2_title = $request->tab2_title;
        $about->tab2_content = $request->tab2_content;
        $about->tab3_title = $request->tab3_title;
        $about->tab3_content = $request->tab3_content;
        $about->tab4_title = $request->tab4_title;
        $about->tab4_content = $request->tab4_content;
        $about->button_text = $request->button_text;

        $about->save();

        return redirect()->back()->with('success', 'About Section updated successfully!');
    }
}
