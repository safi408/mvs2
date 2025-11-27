<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;
use Illuminate\Support\Facades\Storage;

class OfferBannerController extends Controller
{
    //
    public function edit(){
                // single offer banner record fetch karo
        $banner = OfferBanner::first();

        // agar nahi hai to ek create kar do (default blank)
        if (!$banner) {
            $banner = OfferBanner::create([
                'title' => 'Special Offer',
                'subtitle' => 'Limited Time Only',
                'discount' => '50% Off',
                'button_text' => 'Shop Now',
                'end_date' => now()->addDays(7)->format('Y-m-d'),
                'image' => null,
            ]);
        }

        return view('admin.home.offerbanner.edit', compact('banner'));
    }

        // ✅ Update Offer Banner
    public function update(Request $request)
    {
        $banner = OfferBanner::first();

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'discount' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ✅ Image Upload
        if ($request->hasFile('image')) {
            // Purani image delete karo
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            // Nayi image save karo
            $path = $request->file('image')->store('offer_banners', 'public');
            $validated['image'] = $path;
        }

        // ✅ Data update
        $banner->update($validated);

        return redirect()
            ->route('admin.offer.edit')
            ->with('success', 'Offer banner updated successfully!');
    }

 

        public function show()
    {
        $banner = OfferBanner::first();

        // Agar koi offer nahi hai
        if (!$banner) {
            return view('admin.home.offerbanner.view', ['banner' => null]);
        }

        return view('admin.home.offerbanner.view', compact('banner'));
    }
}
