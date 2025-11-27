<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\AddBlog;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    //
      public function banner(){
        $banner = Blog::first();
        return view('admin.blog.blogbanner', compact('banner'));
    }

  public function update(Request $request)
{
    $banner = Blog::first();

    // If no banner exists, create a new one
    if (!$banner) {
        $banner = new Blog();
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'breadcrumb' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = 'blog_banner_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('blog_banners', $filename, 'public');
        $banner->image = $path;
    }

    $banner->title = $request->title;
    $banner->breadcrumb = $request->breadcrumb;
    $banner->save();

    return redirect()->route('admin.blog.banner')->with('success', 'Blog banner updated successfully.');
}


    public function create(){
        return view('admin.blog.create');
    }



// public function store(Request $request)
// {
//     $request->validate([
//         'subtitle' => 'required|string|max:255',
//         'author' => 'required|string|max:255',
//         'publish_date' => 'required|date',
//         'paragraphs' => 'required|array|min:1',
//         'bullets' => 'required|array|min:1',
//         'image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//     ]);

//     $data = $request->only([
//         'subtitle',
//         'author',
//         'publish_date',
//         'related_previous_title',
//         'related_previous_url',
//         'related_next_title',
//         'related_next_url',
//     ]);

//     $data['paragraphs'] = json_encode($request->paragraphs);
//     $data['bullets'] = json_encode($request->bullets);
//     $data['tags'] = $request->filled('tags') ? json_encode($request->tags) : null;

//     // ✅ Image 1
//     if ($request->hasFile('image_1')) {
//         $filename1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $filename1, 'public');
//         $data['image_1'] = 'addblogs/' . $filename1;
//     }

//     // ✅ Image 2
//     if ($request->hasFile('image_2')) {
//         $filename2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $filename2, 'public');
//         $data['image_2'] = 'addblogs/' . $filename2;
//     }

//     BlogDeatail::create($data);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
// }


    // public function store(Request $request)
    // {
    //     // ✅ Step 1: Validate input
    //     $request->validate([
    //         'title'        => 'required|string|max:255',
    //         'author'       => 'required|string|max:255',
    //         'publish_date' => 'required|date',
    //         'description'  => 'nullable|string',
    //         'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     // ✅ Step 2: Generate a unique slug
    //     $slug = Str::slug($request->title);
    //     $originalSlug = $slug;
    //     $count = 1;

    //     while (AddBlog::where('slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $count++;
    //     }

    //     // ✅ Step 3: Handle image upload
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $filename = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
    //         $request->image->storeAs('addblogs', $filename, 'public');
    //         $imagePath = 'addblogs/' . $filename;
    //     }

    //     // ✅ Step 4: Save data to DB
    //     AddBlog::create([
    //         'title'        => $request->title,
    //         'slug'         => $slug,
    //         'author'       => $request->author,
    //         'publish_date' => $request->publish_date,
    //         'image'        => $imagePath,
    //         'description'  => $request->description,
    //     ]);

    //     // ✅ Step 5: Redirect with success message
    //     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
    // }



// public function store(Request $request)
// {
//     // ✅ Step 1: Validate the input
//     $request->validate([
//         'title'        => 'required|string|max:255',
//         'author'       => 'required|string|max:255',
//         'publish_date' => 'required|date',
//         'description'  => 'nullable|string',
//         'bullets'      => 'nullable|array',
//         'tags'         => 'nullable|array',
//         'image_1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//         'image_2'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     // ✅ Step 2: Create a unique slug
//     $slug = Str::slug($request->title);
//     $originalSlug = $slug;
//     $count = 1;
//     while (AddBlog::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $count++;
//     }

//     // ✅ Step 3: Handle image uploads
//     $image1Path = null;
//     $image2Path = null;

//     if ($request->hasFile('image_1')) {
//         $filename1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $filename1, 'public');
//         $image1Path = 'addblogs/' . $filename1;
//     }

//     if ($request->hasFile('image_2')) {
//         $filename2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $filename2, 'public');
//         $image2Path = 'addblogs/' . $filename2;
//     }

//     // ✅ Step 4: Store the blog in the database
//     AddBlog::create([
//         'title'                  => $request->title,
//         'slug'                   => $slug,
//         'author'                 => $request->author,
//         'publish_date'           => $request->publish_date,
//         'description'            => $request->description,
//         'bullets'                => json_encode($request->bullets), // store bullets array as JSON
//         'tags'                   => json_encode($request->tags),    // store tags array as JSON
//         'image_1'                => $image1Path,
//         'image_2'                => $image2Path,
//         'related_previous_title' => $request->related_previous_title,
//         'related_previous_url'   => $request->related_previous_url,
//         'related_next_title'     => $request->related_next_title,
//         'related_next_url'       => $request->related_next_url,
//     ]);

//     // ✅ Step 5: Redirect with success message
//     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
// }

// public function store(Request $request)
// {
//     // ✅ Step 1: Validate inputs
//     $request->validate([
//         'title'        => 'required|string|max:255',
//         'author'       => 'required|string|max:255',
//         'publish_date' => 'nullable|date',
//         'description'  => 'nullable|string',
//         'bullets'      => 'nullable|array',
//         'tags'         => 'nullable|array',
//         'image_1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//         'image_2'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     // ✅ Step 2: Generate unique slug
//     $slug = Str::slug($request->title);
//     $originalSlug = $slug;
//     $count = 1;
//     while (AddBlog::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $count++;
//     }

//     // ✅ Step 3: Handle image uploads
//     $image1Path = null;
//     $image2Path = null;

//     if ($request->hasFile('image_1')) {
//         $filename1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $filename1, 'public');
//         $image1Path = 'addblogs/' . $filename1;
//     }

//     if ($request->hasFile('image_2')) {
//         $filename2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $filename2, 'public');
//         $image2Path = 'addblogs/' . $filename2;
//     }

//     // ✅ Step 4: Create Blog Record
//     AddBlog::create([
//         'title'                  => $request->title,
//         'slug'                   => $slug,
//         'author'                 => $request->author,
//         'publish_date'           => $request->publish_date ?? now(),
//         'description'            => $request->description ?? '',
//         'bullets'                => json_encode($request->bullets ?? []),
//         'tags'                   => json_encode($request->tags ?? []),
//         'image_1'                => $image1Path,
//         'image_2'                => $image2Path,
//         'related_previous_title' => $request->related_previous_title ?? '',
//         'related_previous_url'   => $request->related_previous_url ?? '',
//         'related_next_title'     => $request->related_next_title ?? '',
//         'related_next_url'       => $request->related_next_url ?? '',
//     ]);

//     // ✅ Step 5: Redirect
//     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
// }


    // public function store(Request $request)
    // {
    //     // ✅ Step 1: Validate input
    //     $request->validate([
    //         'title'        => 'required|string|max:255',
    //         'author'       => 'required|string|max:255',
    //         'publish_date' => 'required|date',
    //         'description'  => 'nullable|string',
    //         'paragraphs'   => 'nullable|array',
    //         'bullets'      => 'nullable|array',
    //         'tags'         => 'nullable|array',
    //         'images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //         'image_1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //         'image_2'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     // ✅ Step 2: Generate unique slug
    //     $slug = Str::slug($request->title);
    //     $originalSlug = $slug;
    //     $count = 1;
    //     while (AddBlog::where('slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $count++;
    //     }

    //     // ✅ Step 3: Handle image_1 and image_2
    //     $image1Path = null;
    //     $image2Path = null;

    //     if ($request->hasFile('image_1')) {
    //         $filename1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
    //         $request->image_1->storeAs('addblogs', $filename1, 'public');
    //         $image1Path = 'addblogs/' . $filename1;
    //     }

    //     if ($request->hasFile('image_2')) {
    //         $filename2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
    //         $request->image_2->storeAs('addblogs', $filename2, 'public');
    //         $image2Path = 'addblogs/' . $filename2;
    //     }


    //     // ✅ Step 5: Create blog entry
    //     AddBlog::create([
    //         'title'        => $request->title,
    //         'slug'         => $slug,
    //         'author'       => $request->author,
    //         'publish_date' => $request->publish_date,
    //         'description'  => $request->description,

    //         'paragraphs'   => $request->paragraphs,
    //         'bullets'      => $request->bullets,
    //         'tags'         => $request->tags,

    //         'image_1'      => $image1Path,
    //         'image_2'      => $image2Path,
    //         // 'images'       => $imagePaths, // multiple JSON images

    //         'related_previous_title' => $request->related_previous_title,
    //         'related_previous_url'   => $request->related_previous_url,
    //         'related_next_title'     => $request->related_next_title,
    //         'related_next_url'       => $request->related_next_url,
    //     ]);

    //     // ✅ Step 6: Redirect with message
    //     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
    // }


//     public function store(Request $request)
// {
//     $request->validate([
//         'title'        => 'required|string|max:255',
//         'author'       => 'required|string|max:255',
//         'publish_date' => 'required|date',
//         'description'  => 'nullable|string',
//         'paragraphs'   => 'nullable|array',
//         'bullets'      => 'nullable|array',
//         'tags'         => 'nullable|array',
//         'image_1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//         'image_2'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     $slug = Str::slug($request->title);
//     $originalSlug = $slug;
//     $count = 1;
//     while (AddBlog::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $count++;
//     }

//     // ✅ Handle image uploads
//     $image1Path = null;
//     $image2Path = null;

//     if ($request->hasFile('image_1')) {
//         $image1Path = $request->file('image_1')->store('addblogs', 'public');
//     }

//     if ($request->hasFile('image_2')) {
//         $image2Path = $request->file('image_2')->store('addblogs', 'public');
//     }

//     AddBlog::create([
//         'title'        => $request->title,
//         'slug'         => $slug,
//         'author'       => $request->author,
//         'publish_date' => $request->publish_date,
//         'description'  => $request->description,
//         'paragraphs'   => $request->paragraphs,
//         'bullets'      => $request->bullets,
//         'tags'         => $request->tags,
//         'image_1'      => $image1Path,
//         'image_2'      => $image2Path,
//         'related_previous_title' => $request->related_previous_title,
//         'related_previous_url'   => $request->related_previous_url,
//         'related_next_title'     => $request->related_next_title,
//         'related_next_url'       => $request->related_next_url,
//     ]);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
// }




// public function store(Request $request)
// {
//     $request->validate([
//         'title'        => 'required|string|max:255',
//         'author'       => 'required|string|max:255',
//         'publish_date' => 'required|date',
//         'description'  => 'nullable|string',
//         'paragraphs'   => 'nullable|array',
//         'bullets'      => 'nullable|array',
//         'tags'         => 'nullable|array',
//         'image_1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//         'image_2'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     // ✅ Unique Slug Generation
//     $slug = Str::slug($request->title);
//     $originalSlug = $slug;
//     $count = 1;
//     while (AddBlog::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $count++;
//     }

//     // ✅ Handle image uploads
//     $image1Path = null;
//     $image2Path = null;

//     if ($request->hasFile('image_1')) {
//         $image1 = $request->file('image_1');
//         $imageName1 = time() . '_1.' . $image1->getClientOriginalExtension();
//         $image1->storeAs('addblogs', $imageName1, 'public');
//         $image1Path = 'addblogs/' . $imageName1;
//     }

//     if ($request->hasFile('image_2')) {
//         $image2 = $request->file('image_2');
//         $imageName2 = time() . '_2.' . $image2->getClientOriginalExtension();
//         $image2->storeAs('addblogs', $imageName2, 'public');
//         $image2Path = 'addblogs/' . $imageName2;
//     }

//     // ✅ Create Blog Record
//     AddBlog::create([
//         'title'        => $request->title,
//         'slug'         => $slug,
//         'author'       => $request->author,
//         'publish_date' => $request->publish_date,
//         'description'  => $request->description,

//         // Arrays stored as JSON (safe for DB)
//         'paragraphs'   => $request->has('paragraphs') ? json_encode($request->paragraphs) : json_encode([]),
//         'bullets'      => $request->has('bullets') ? json_encode(array_filter($request->bullets)) : json_encode([]),
//         'tags'         => $request->has('tags') ? json_encode($request->tags) : json_encode([]),

//         'image_1'      => $image1Path,
//         'image_2'      => $image2Path,

//         'related_previous_title' => $request->related_previous_title,
//         'related_previous_url'   => $request->related_previous_url,
//         'related_next_title'     => $request->related_next_title,
//         'related_next_url'       => $request->related_next_url,
//     ]);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully!');
// }





// public function store(Request $request)
// {
//     $request->validate([
//         'title'        => 'required|string|max:255',
//         'author'       => 'required|string|max:255',
//         'publish_date' => 'required|date',
//         'description'  => 'nullable|string',
//         'paragraphs'   => 'nullable|array',
//         'bullets'      => 'nullable|array',
//         'tags'         => 'nullable|array',
//         'image_1'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
//         'image_2'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     // ✅ Unique Slug
//     $slug = Str::slug($request->title);
//     $originalSlug = $slug;
//     $count = 1;
//     while (AddBlog::where('slug', $slug)->exists()) {
//         $slug = $originalSlug . '-' . $count++;
//     }

//     // ✅ Upload Images (Manual Check)
//     $image1Path = null;
//     $image2Path = null;

//     if ($request->file('image_1')) {
//         $file1 = $request->file('image_1');
//         $imageName1 = 'blog1_' . time() . '.' . $file1->getClientOriginalExtension();
//         $file1->storeAs('public/addblogs', $imageName1);
//         $image1Path = 'addblogs/' . $imageName1;
//     }

//     if ($request->file('image_2')) {
//         $file2 = $request->file('image_2');
//         $imageName2 = 'blog2_' . time() . '.' . $file2->getClientOriginalExtension();
//         $file2->storeAs('public/addblogs', $imageName2);
//         $image2Path = 'addblogs/' . $imageName2;
//     }

//     // ✅ Create Blog
//     AddBlog::create([
//         'title'        => $request->title,
//         'slug'         => $slug,
//         'author'       => $request->author,
//         'publish_date' => $request->publish_date,
//         'description'  => $request->description,
//         'paragraphs'   => json_encode($request->paragraphs ?? []),
//         'bullets'      => json_encode($request->bullets ?? []),
//         'tags'         => json_encode($request->tags ?? []),
//         'image_1'      => $image1Path,
//         'image_2'      => $image2Path,
//         'related_previous_title' => $request->related_previous_title,
//         'related_previous_url'   => $request->related_previous_url,
//         'related_next_title'     => $request->related_next_title,
//         'related_next_url'       => $request->related_next_url,
//     ]);

//     return redirect()->route('admin.blog.index')->with('success', '✅ Blog added successfully!');
// }



// public function store(Request $request)
// {
//     $request->validate([
//         'title'          => 'required|string|max:255',
//         'author'         => 'required|string|max:255',
//         'publish_date'   => 'required|date',
//         'description'    => 'nullable|string',
//         'paragraphs'     => 'nullable|array',      // ✅ Paragraphs array
//         'paragraphs.*'   => 'nullable|string',     // ✅ Each paragraph is string
//         'bullets'        => 'nullable|array',
//         'image_1'        => 'nullable|image|max:2048',
//         'image_2'        => 'nullable|image|max:2048',
//         'tags'           => 'nullable|array',
//         'related_previous_title' => 'nullable|string|max:255',
//         'related_previous_url'   => 'nullable|string|max:255',
//         'related_next_title'     => 'nullable|string|max:255',
//         'related_next_url'       => 'nullable|string|max:255',
//     ]);

//     $data = $request->except(['image_1', 'image_2']);

//     // ✅ Encode arrays before saving
//     if ($request->filled('paragraphs')) {
//         $data['paragraphs'] = json_encode($request->paragraphs);
//     }
//     if ($request->filled('bullets')) {
//         $data['bullets'] = json_encode($request->bullets);
//     }
//     if ($request->filled('tags')) {
//         $data['tags'] = json_encode($request->tags);
//     }

//     // 🖼 Handle image 1
//     if ($request->hasFile('image_1')) {
//         $imageName1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $imageName1, 'public');
//         $data['image_1'] = 'addblogs/' . $imageName1;
//     }

//     // 🖼 Handle image 2
//     if ($request->hasFile('image_2')) {
//         $imageName2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $imageName2, 'public');
//         $data['image_2'] = 'addblogs/' . $imageName2;
//     }

//     // 💾 Save blog
//     AddBlog::create($data);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!');
// }


// public function store(Request $request)
// {
//     $request->validate([
//         'title'          => 'required|string|max:255',
//         'author'         => 'required|string|max:255',
//         'publish_date'   => 'required|date',
//         'description'    => 'nullable|string',
//         'paragraphs'     => 'nullable|array',
//         'paragraphs.*'   => 'nullable|string',
//         'bullets'        => 'nullable|array',
//         'image_1'        => 'nullable|image|max:2048',
//         'image_2'        => 'nullable|image|max:2048',
//         'image_3'        => 'nullable|image|max:2048', // ✅ image_3
//         'tags'           => 'nullable|array',
//         'social_media'   => 'nullable|array',          // ✅ social media inputs
//         'related_previous_title' => 'nullable|string|max:255',
//         'related_previous_url'   => 'nullable|string|max:255',
//         'related_next_title'     => 'nullable|string|max:255',
//         'related_next_url'       => 'nullable|string|max:255',
//     ]);

//     $data = $request->except(['image_1', 'image_2', 'image_3']);

//     // ✅ Encode arrays before saving
//     if ($request->filled('paragraphs')) {
//         $data['paragraphs'] = json_encode($request->paragraphs);
//     }
//     if ($request->filled('bullets')) {
//         $data['bullets'] = json_encode($request->bullets);
//     }
//     if ($request->filled('tags')) {
//         $data['tags'] = json_encode($request->tags);
//     }
//     if ($request->filled('social_media')) {
//         $data['social_media'] = json_encode($request->social_media);
//     }

//     // 🖼 Handle image 1
//     if ($request->hasFile('image_1')) {
//         $imageName1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $imageName1, 'public');
//         $data['image_1'] = 'addblogs/' . $imageName1;
//     }

//     // 🖼 Handle image 2
//     if ($request->hasFile('image_2')) {
//         $imageName2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $imageName2, 'public');
//         $data['image_2'] = 'addblogs/' . $imageName2;
//     }

//     // 🖼 Handle image 3
//     if ($request->hasFile('image_3')) {
//         $imageName3 = time() . '_3.' . $request->image_3->getClientOriginalExtension();
//         $request->image_3->storeAs('addblogs', $imageName3, 'public');
//         $data['image_3'] = 'addblogs/' . $imageName3;
//     }

//     // 💾 Save blog
//     AddBlog::create($data);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!');
// }


public function store(Request $request)
{
    $request->validate([
        'title'          => 'required|string|max:255',
        'author'         => 'required|string|max:255',
        'publish_date'   => 'required|date',
        'description'    => 'nullable|string',
        'paragraphs'     => 'nullable|array',
        'paragraphs.*'   => 'nullable|string',
        'bullets'        => 'nullable|array',
        'image_1'        => 'nullable|image|max:2048',
        'image_2'        => 'nullable|image|max:2048',
        'image_3'        => 'nullable|image|max:2048',
        'tags'           => 'nullable|array',
        'social_media'   => 'nullable|array', // this is fine
        'related_previous_title' => 'nullable|string|max:255',
        'related_previous_url'   => 'nullable|string|max:255',
        'related_next_title'     => 'nullable|string|max:255',
        'related_next_url'       => 'nullable|string|max:255',
    ]);

    $data = $request->except(['image_1', 'image_2', 'image_3']);

    // Paragraphs, bullets, tags
    if ($request->filled('paragraphs')) {
        $data['paragraphs'] = json_encode($request->paragraphs);
    }
    if ($request->filled('bullets')) {
        $data['bullets'] = json_encode($request->bullets);
    }
    if ($request->filled('tags')) {
        $data['tags'] = json_encode($request->tags);
    }

    // Social media => assign each platform to separate column
    if ($request->filled('social_media')) {
        foreach ($request->social_media as $platform => $url) {
            $data[$platform] = $url; // facebook, x, instagram, etc.
        }
    }

    // Handle images
    foreach (['image_1', 'image_2', 'image_3'] as $img) {
        if ($request->hasFile($img)) {
            $imageName = time() . '_' . substr($img, -1) . '.' . $request->$img->getClientOriginalExtension();
            $request->$img->storeAs('addblogs', $imageName, 'public');
            $data[$img] = 'addblogs/' . $imageName;
        }
    }

    // Save blog
    AddBlog::create($data);

    return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!');
}











    public function show(){
        $blogs = AddBlog::latest()->paginate(8); ;
        return view('admin.blog.manage', compact('blogs'));
    }

    public function view($id){
        $blog = AddBlog::find($id);
        return view('admin.blog.show', compact('blog'));
    }

    public function delete($id){
         $blog = AddBlog::find($id);
         $blog->delete();
         return redirect()->route('admin.blog.index')->with('warning', 'Blogs deleted successfully');
    }

    public function edit($id){
       $blog = AddBlog::find($id);
       return view('admin.blog.edit', compact('blog'));
    }


// public function addupdate(Request $request, $id)
// {
//     $request->validate([
//         'title'          => 'required|string|max:255',
//         'author'         => 'required|string|max:255',
//         'publish_date'   => 'required|date',
//         'description'    => 'nullable|string',
//         'paragraphs'     => 'nullable|array',
//         'bullets'        => 'nullable|array',
//         'image_1'        => 'nullable|image|max:2048',
//         'image_2'        => 'nullable|image|max:2048',
//         'image_3'        => 'nullable|image|max:2048',
//         'tags'           => 'nullable|array',
//         'related_previous_title' => 'nullable|string|max:255',
//         'related_previous_url'   => 'nullable|string|max:255',
//         'related_next_title'     => 'nullable|string|max:255',
//         'related_next_url'       => 'nullable|string|max:255',
//     ]);

//     $blog = AddBlog::findOrFail($id);
//     $data = $request->except(['image_1', 'image_2']);

//     // ✅ Encode arrays before saving
//     $data['paragraphs'] = $request->filled('paragraphs') ? json_encode($request->paragraphs) : null;
//     $data['bullets']    = $request->filled('bullets') ? json_encode($request->bullets) : null;
//     $data['tags']       = $request->filled('tags') ? json_encode($request->tags) : null;

//     // 🖼 Handle Image 1
//     if ($request->hasFile('image_1')) {
//         if ($blog->image_1 && \Storage::disk('public')->exists($blog->image_1)) {
//             \Storage::disk('public')->delete($blog->image_1);
//         }
//         $imageName1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
//         $request->image_1->storeAs('addblogs', $imageName1, 'public');
//         $data['image_1'] = 'addblogs/' . $imageName1;
//     }

//     // 🖼 Handle Image 2
//     if ($request->hasFile('image_2')) {
//         if ($blog->image_2 && \Storage::disk('public')->exists($blog->image_2)) {
//             \Storage::disk('public')->delete($blog->image_2);
//         }
//         $imageName2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
//         $request->image_2->storeAs('addblogs', $imageName2, 'public');
//         $data['image_2'] = 'addblogs/' . $imageName2;
//     }

//     // 💾 Update blog
//     $blog->update($data);

//     return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully!');
// }


public function addupdate(Request $request, $id)
{
    $request->validate([
        'title'          => 'required|string|max:255',
        'author'         => 'required|string|max:255',
        'publish_date'   => 'required|date',
        'description'    => 'nullable|string',
        'paragraphs'     => 'nullable|array',
        'bullets'        => 'nullable|array',
        'image_1'        => 'nullable|image|max:2048',
        'image_2'        => 'nullable|image|max:2048',
        'image_3'        => 'nullable|image|max:2048',
        'tags'           => 'nullable|array',
        'related_previous_title' => 'nullable|string|max:255',
        'related_previous_url'   => 'nullable|string|max:255',
        'related_next_title'     => 'nullable|string|max:255',
        'related_next_url'       => 'nullable|string|max:255',
        'social_media'           => 'nullable|array', // ✅ Add this
    ]);

    $blog = AddBlog::findOrFail($id);
    $data = $request->except(['image_1', 'image_2', 'image_3']);

    // ✅ Encode arrays before saving
    $data['paragraphs'] = $request->filled('paragraphs') ? json_encode($request->paragraphs) : null;
    $data['bullets']    = $request->filled('bullets') ? json_encode($request->bullets) : null;
    $data['tags']       = $request->filled('tags') ? json_encode($request->tags) : null;

    // ✅ Handle Social Media
    if ($request->has('social_media')) {
        foreach ($request->social_media as $platform => $url) {
            $data[$platform] = $url ?: null;
        }
    }

    // 🖼 Handle Image 1
    if ($request->hasFile('image_1')) {
        if ($blog->image_1 && \Storage::disk('public')->exists($blog->image_1)) {
            \Storage::disk('public')->delete($blog->image_1);
        }
        $imageName1 = time() . '_1.' . $request->image_1->getClientOriginalExtension();
        $request->image_1->storeAs('addblogs', $imageName1, 'public');
        $data['image_1'] = 'addblogs/' . $imageName1;
    }

    // 🖼 Handle Image 2
    if ($request->hasFile('image_2')) {
        if ($blog->image_2 && \Storage::disk('public')->exists($blog->image_2)) {
            \Storage::disk('public')->delete($blog->image_2);
        }
        $imageName2 = time() . '_2.' . $request->image_2->getClientOriginalExtension();
        $request->image_2->storeAs('addblogs', $imageName2, 'public');
        $data['image_2'] = 'addblogs/' . $imageName2;
    }

    // 🖼 Handle Image 3
    if ($request->hasFile('image_3')) {
        if ($blog->image_3 && \Storage::disk('public')->exists($blog->image_3)) {
            \Storage::disk('public')->delete($blog->image_3);
        }
        $imageName3 = time() . '_3.' . $request->image_3->getClientOriginalExtension();
        $request->image_3->storeAs('addblogs', $imageName3, 'public');
        $data['image_3'] = 'addblogs/' . $imageName3;
    }

    // 💾 Update blog
    $blog->update($data);

    return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully!');
}




}
