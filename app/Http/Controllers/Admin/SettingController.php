<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //

       public function __construct()
    {
        $this->middleware('permission:settings');
    }

    public function setting(){
        $setting = Setting::first();
        return view('admin.settings', compact('setting'));
    }



public function store(Request $request)
{
    $request->validate([
        'site_name' => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'phone'     => 'nullable|string|max:255',
        'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'address'   => 'required|max:300',
        'direction_link' => 'nullable',
        'open_time_weekdays' => 'nullable|string|max:255',
        'open_time_sunday'   => 'nullable|string|max:255',
    ]);

    $setting = Setting::first() ?? new Setting();

    $setting->site_name = $request->site_name;
    $setting->email = $request->email;
    $setting->phone = $request->phone;
    $setting->contact = $request->contact; //  new field
    $setting->address = $request->address;
    $setting->direction_link = $request->direction_link;
    $setting->direction_address = $request->direction_address; //  new field
    $setting->facebook = $request->facebook;
    $setting->x = $request->x;
    $setting->instagram = $request->instagram;
    $setting->tiktok = $request->tiktok;
    $setting->youtube = $request->youtube;
    $setting->pinterest = $request->pinterest;

    // ⏰ New Fields
    $setting->open_time_weekdays = $request->open_time_weekdays;
    $setting->open_time_sunday = $request->open_time_sunday;

    // 🖼️ Handle logo upload
    if ($request->hasFile('image')) {
        if ($setting->logo && \Storage::disk('public')->exists($setting->logo)) {
            \Storage::disk('public')->delete($setting->logo);
        }

        $imageName = 'logo_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('logo', $imageName, 'public');
        $setting->logo = 'logo/' . $imageName;
    }

    $setting->save();

    return redirect()->route('settings')->with('success', 'Settings updated successfully.');
}


  

}
