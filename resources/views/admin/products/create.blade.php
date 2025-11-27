@extends('layouts.masterlayout')

@section('content')
<style>
/* FilePond preview grid */
.filepond--list {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 12px;
    margin-top: 10px;
    justify-content: flex-start;
}
.filepond--item {
    width: 120px !important;
    height: 120px !important;
    border-radius: 8px;
    overflow: hidden;
}
.color-box {
    cursor: pointer;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 40px;
    height: 40px;
}
</style>

<div class="container py-3">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-center bg-white border-0">
            <h2 class="fw-bold mb-0 text-gradient">
                <i class="bi bi-box-seam me-2 text-primary"></i> Add New Product
            </h2>
            <p class="text-muted mt-1 small">Fill the details below to add a product</p>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
    <div class="alert alert-danger rounded-3">
        <h5 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle me-1"></i> Please fix the following errors:</h5>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




            <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <!-- Product Info -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-tags me-1 text-primary"></i> Category</label>
                        <select name="category_id" id="category" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-diagram-2 me-1 text-success"></i> Subcategory</label>
                        <select name="subcategory_id" id="subcategory" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Subcategory --</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-diagram-3 me-1 text-success"></i> Childcategory</label>
                        <select name="childcategory_id" id="childcategory" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Childcategory --</option>
                            @foreach($childcategories as $childcategory)
                                <option value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>


                     <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="bi bi-award-fill text-primary me-1"></i> Brands</label>
                        <select name="brand_id" id="brand_id" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Brands --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

            

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="bi bi-bag me-1 text-warning"></i> Product Name</label>
                        <input type="text" name="product_name" class="form-control rounded-3 shadow-sm" placeholder="Red T-shirt">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-cash-coin me-1 text-success"></i> Price</label>
                        <input type="number" step="0.01" name="price" class="form-control rounded-3 shadow-sm" placeholder="19.99">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-box2-fill me-1 text-danger"></i> Stock</label>
                        <input type="number" name="stock" class="form-control rounded-3 shadow-sm" placeholder="10">
                    </div>

            

                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-link-45deg me-1 text-info"></i> Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control rounded-3 shadow-sm" placeholder="red-t-shirt">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold"><i class="bi bi-text-paragraph me-1 text-primary"></i> Description</label>
                        <textarea name="description" id="summernote" rows="4" class="form-control rounded-3 shadow-sm" placeholder="Enter product details, material, features..."></textarea>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Colors + Images -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-palette me-2 text-warning"></i> Product Colors + Images</h4>
                    <button type="button" class="btn btn-primary rounded-pill px-4" id="add-color">
                        <i class="bi bi-plus-circle me-1"></i> Add Color
                    </button>
                </div>

                <div id="colors-wrapper" class="d-flex flex-column gap-4">
                    <div id="no-color-message" class="text-muted text-center p-3 border rounded">
                        <i class="bi bi-info-circle me-1"></i> No colors selected yet. Click "Add Color" to add product colors.
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success py-2 rounded-pill shadow">
                        <i class="bi bi-check-circle me-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<!-- Pickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>

<!-- FilePond -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>


<script>
$(document).ready(function() {
    // Summernote
    $('#summernote').summernote({
        placeholder: 'Write product description here...',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold','italic','underline','clear']],
            ['color', ['color']],
            ['para', ['ul','ol','paragraph']],
            ['insert', ['link','picture']],
            ['view', ['fullscreen','codeview','help']]
        ]
    });

    // FilePond Register
    FilePond.registerPlugin(
        FilePondPluginFileValidateSize,
        FilePondPluginImagePreview,
        FilePondPluginFileEncode,
        FilePondPluginImageExifOrientation
    );

    // Add Color + FilePond + Pickr
    let colorIndex = 0;
    const wrapper = document.getElementById('colors-wrapper');

    $('#add-color').click(function() {
        document.getElementById('no-color-message').style.display = 'none';

        const div = document.createElement('div');
        div.classList.add('p-3','card','shadow-sm','rounded-3');
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <div class="color-box"></div>
                    <input type="text" name="colors[${colorIndex}][color_name]" placeholder="Color Name" class="form-control rounded-3">
                    <input type="hidden" name="colors[${colorIndex}][code]" value="#000000">
                </div>
                
                <button type="button" class="btn btn-sm btn-outline-danger ms-3 remove-color">✖</button>
            </div>

            <!-- ✅ Size, Price, Stock -->
            <div class="row mb-3">


<div class="col-md-4">
    <label class="form-label">Sizes</label>
    <select class="form-select size-dropdown" name="sizeSelect">
        <option value="" disabled selected>Select Size</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>

    <!-- where selected tags appear -->
    <div class="selected-sizes d-flex flex-wrap mt-2 gap-2"></div>

    <!-- hidden input for backend -->
    <input type="hidden" name="colors[${colorIndex}][size]" class="sizes-hidden-input">
</div>


    

    <div class="col-md-4">
        <label class="form-label">Price</label>
        <input type="number" name="colors[${colorIndex}][price]" placeholder="e.g. 999" class="form-control">
    </div>

    <div class="col-md-4">
        <label class="form-label">Stock</label>
        <input type="number" name="colors[${colorIndex}][stock]" placeholder="e.g. 10" class="form-control">
    </div>
</div>


            <div class="fw-semibold mb-2">Upload Images</div>
            <input type="file" name="images[${colorIndex}][]" multiple class="filepond">
        `;
        wrapper.appendChild(div);

        // Remove color block
        div.querySelector('.remove-color').addEventListener('click', () => {
            div.remove();
            if(wrapper.querySelectorAll('.card').length === 0){
                document.getElementById('no-color-message').style.display = 'block';
            }
        });

        // Pickr (color picker)
        const colorBox = div.querySelector('.color-box');
        const hiddenInput = div.querySelector(`input[name="colors[${colorIndex}][code]"]`);
        const pickr = Pickr.create({
            el: colorBox,
            theme: 'classic',
            default: '#000000',
            swatches: ['#F44336','#E91E63','#9C27B0','#2196F3','#4CAF50','#FFEB3B','#FF9800','#795548'],
            components: {
                preview:true, opacity:true, hue:true,
                interaction:{ hex:true,input:true,save:true }
            }
        });
        pickr.on('save', color => {
            const hex = color.toHEXA().toString();
            colorBox.style.background = hex;
            hiddenInput.value = hex;
            pickr.hide();
        });

        // FilePond init
        FilePond.create(div.querySelector('.filepond'), {
            allowMultiple: true,
            maxFiles: 10,
            instantUpload: false,
            storeAsFile: true,
            imagePreviewHeight: 120,
            allowFileSizeValidation: true,
            maxFileSize: '5MB'
        });

        colorIndex++;
    });



    // When a size is selected from dropdown
$(document).on('change', '.size-dropdown', function () {
    const selectedSize = $(this).val();
    const container = $(this).siblings('.selected-sizes');
    const hiddenInput = $(this).siblings('.sizes-hidden-input');

    if (!selectedSize) return;

    // Prevent duplicate tag
    if (container.find(`[data-size="${selectedSize}"]`).length > 0) {
        $(this).val('');
        return;
    }

    // Create tag badge
    const badge = `
        <span class="badge bg-primary d-flex align-items-center gap-1 mb-1" data-size="${selectedSize}">
            ${selectedSize}
            <button type="button" class="btn btn-sm btn-light text-danger remove-size" 
                style="line-height:1;padding:0 4px;">×</button>
        </span>
    `;
    container.append(badge);

    // Reset select dropdown
    $(this).val('');

    updateHiddenInput(container, hiddenInput);
});

// When × button is clicked
$(document).on('click', '.remove-size', function () {
    const badge = $(this).closest('span');
    const container = badge.parent();
    const hiddenInput = container.siblings('.sizes-hidden-input');

    badge.remove();
    updateHiddenInput(container, hiddenInput);
});

// Update hidden input JSON data
function updateHiddenInput(container, hiddenInput) {
    const sizes = [];
    container.find('span').each(function () {
        sizes.push($(this).data('size'));
    });
    hiddenInput.val(JSON.stringify(sizes));
}





    // Dependent Dropdown: Category → Subcategory
    // $('#category').change(function() {
    //     const categoryId = $(this).val();
    //     if(categoryId){
    //         $.get('/api/get-subcategories/' + categoryId, function(data){
    //             $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
    //             $.each(data, function(k,v){
    //                 $('#subcategory').append('<option value="'+v.id+'">'+v.name+'</option>');
    //             });
    //         });
    //     } else {
    //         $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
    //     }
    // });


    // 🔹 Category → Subcategory
$('#category').change(function() {
    const categoryId = $(this).val();
    $('#childcategory').empty().append('<option value="">-- Select Child Category --</option>');

    if (categoryId) {
        $.get('/api/get-subcategories/' + categoryId, function(data) {
            $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
            $.each(data, function(k, v) {
                $('#subcategory').append('<option value="' + v.id + '">' + v.name + '</option>');
            });
        });
    } else {
        $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
    }
});

// 🔹 Subcategory → Child Category
$('#subcategory').change(function() {
    const subcategoryId = $(this).val();
    if (subcategoryId) {
        $.get('/api/get-childcategories/' + subcategoryId, function(data) {
            $('#childcategory').empty().append('<option value="">-- Select Child Category --</option>');
            $.each(data, function(k, v) {
                $('#childcategory').append('<option value="' + v.id + '">' + v.name + '</option>');
            });
        });
    } else {
        $('#childcategory').empty().append('<option value="">-- Select Child Category --</option>');
    }
});





});


</script>
@endsection
