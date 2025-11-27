<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactBanner;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function edit(){
        $contact = ContactBanner::first();
        return view('admin.contact.edit', compact('contact'));
    }
    public function update(Request $request){
      
           $contact = ContactBanner::first();

    // If no banner exists, create a new one
    if (!$contact) {
        $contact  = new ContactBanner();
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
        $contact->image = $path;
    }

    $contact->title = $request->title;
    $contact->breadcrumb = $request->breadcrumb;
    $contact->save();

    return redirect()->route('admin.contact.edit')->with('success', 'Contact banner updated successfully.');

    }

    public function show(){
        $contacts = Contact::latest()->get(); 
        return view('admin.contact.manage',compact('contacts'));
    }

    public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->back()->with('warning', 'Contact deleted successfully.');
}

}
