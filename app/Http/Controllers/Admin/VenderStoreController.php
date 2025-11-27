<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;

class VenderStoreController extends Controller
{
    //
    public function vendor(){
         $users = User::where('role_id', 8)->get();
         return view('admin.vendors.vendor', compact('users'));
    }
    public function create($id){
        $user = User::find($id);
        return view('admin.vendors.create', compact('user'));
    }
        public function store(Request $request)
    {
        // Validation
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'store_name'        => 'required|string|max:255',
            'store_slug'        => 'nullable|string|max:255|unique:vendors,store_slug',
            'store_logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone'             => 'nullable|string|max:20',
            'city'              => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'commission_rate'   => 'nullable|numeric|min:0|max:100',
            'status'            => 'required|in:pending,active,blocked',
            'address'           => 'nullable|string',
            'store_description' => 'nullable|string',
            'is_verified'       => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Auto-generate slug if not provided
        if (empty($data['store_slug'])) {
            $data['store_slug'] = Str::slug($data['store_name']) . '-' . uniqid();
        }

        // Upload store logo if exists
        if ($request->hasFile('store_logo')) {
            $data['store_logo'] = $request->file('store_logo')->store('vendors/logos', 'public');
        }

        // Set is_verified flag
        $data['is_verified'] = $request->has('is_verified') ? true : false;

        // Create vendor
        Vendor::create($data);

        return redirect()->route('vendors.index', $request->user_id)
                         ->with('success', 'Vendor created successfully.');
    }
        // * All Vendor Stores List

    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();
        return view('admin.vendors.manage', compact('vendors'));
    }

                public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendors.edit', compact('vendor'));
    }
   
        public function update(Request $request, $id)
{
    $vendor = Vendor::findOrFail($id);

    $request->validate([
        'store_name'        => 'required|string|max:255',
        'store_slug'        => 'nullable|string|max:255|unique:vendors,store_slug,'.$vendor->id,
        'store_logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'phone'             => 'nullable|string|max:20',
        'city'              => 'nullable|string|max:100',
        'country'           => 'nullable|string|max:100',
        'commission_rate'   => 'nullable|numeric|min:0|max:100',
        'status'            => 'required|in:pending,active,blocked',
        'address'           => 'nullable|string',
        'store_description' => 'nullable|string',
        'is_verified'       => 'nullable|boolean',
    ]);

    $data = $request->all();

    // slug auto-generate agar empty ho
    if (empty($data['store_slug'])) {
        $data['store_slug'] = Str::slug($data['store_name']) . '-' . uniqid();
    }

    // logo upload
    if ($request->hasFile('store_logo')) {
        // purana logo delete karna optional
        if ($vendor->store_logo && Storage::disk('public')->exists($vendor->store_logo)) {
            Storage::disk('public')->delete($vendor->store_logo);
        }
        $data['store_logo'] = $request->file('store_logo')->store('vendors/logos', 'public');
    } else {
        $data['store_logo'] = $vendor->store_logo; // purana logo rakho
    }

    $data['is_verified'] = $request->has('is_verified') ? true : false;

    $vendor->update($data);

    return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
}

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        if ($vendor->store_logo && Storage::disk('public')->exists($vendor->store_logo)) {
            Storage::disk('public')->delete($vendor->store_logo);
        }

        $vendor->delete();

        return redirect()->route('vendors.index')->with('warning', 'Vendor store deleted successfully.');
    }

        // Show a single vendor
    public function show($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id); // eager load user (owner of vendor)
        return view('admin.vendors.view', compact('vendor'));
    }

    public function updateStatus($id, $status)
{
    $vendor = Vendor::findOrFail($id);
    $vendor->status = $status;
    $vendor->save();

    if ($status == 'active') {
        return redirect()->back()->with('success', 'Vendor store has been activated successfully!');
    } elseif ($status == 'blocked') {
        return redirect()->back()->with('warning', 'Vendor store has been blocked!');
    } else {
        return redirect()->back()->with('info', 'Vendor store status updated.');
    }
}


    public function vendorProduct()
    {
        $products = VendorProduct::with(['vendor.user', 'category', 'subcategory', 'images'])
            ->WhereNotNull('vendor_id')
            ->latest()
            ->get();

        return view('admin.vendors.vendorsproducts', compact('products'));
    }

    public function approve($id)
    {
        $product = VendorProduct::findOrFail($id);
        $product->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Product approved successfully!');
    }

    public function reject($id)
    {
        $product = VendorProduct::findOrFail($id);
        $product->update(['status' => 'rejected']);
        return redirect()->back()->with('warning', 'Product rejected!');
    }

}
