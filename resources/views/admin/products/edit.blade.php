@extends('layouts.masterlayout')

@section('content')
<style>
.filepond--list { display: flex !important; flex-wrap: wrap !important; gap: 12px; margin-top: 10px; justify-content: flex-start; }
.filepond--item { width: 120px !important; height: 120px !important; border-radius: 8px; overflow: hidden; }
.color-box { cursor: pointer; border: 1px solid #ccc; border-radius: 8px; width: 40px; height: 40px; }
.selected-sizes .size-tag { margin-right: 4px; margin-bottom: 4px; }
.color-code { font-weight: 500; margin-left: 8px; }
</style>

<div class="container py-3">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-center bg-white border-0">
            <h2 class="fw-bold mb-0 text-gradient">
                <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Product
            </h2>
            <p class="text-muted mt-1 small">Update product details and variants</p>
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

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')

                {{-- Category / Subcategory / Childcategory --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category_id" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Subcategory</label>
                        <select name="subcategory_id" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Subcategory --</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected':'' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Childcategory</label>
                        <select name="childcategory_id" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Childcategory --</option>
                            @foreach($childcategories as $childcategory)
                                <option value="{{ $childcategory->id }}" {{ $product->childcategory_id == $childcategory->id ? 'selected':'' }}>{{ $childcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Brand & Product Name --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand</label>
                        <select name="brand_id" class="form-select rounded-3 shadow-sm">
                            <option value="">-- Select Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected':'' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="product_name" class="form-control rounded-3 shadow-sm" value="{{ old('product_name', $product->name) }}">
                    </div>
                </div>

                {{-- Price / Stock / Slug --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control rounded-3 shadow-sm" value="{{ $product->price }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Stock</label>
                        <input type="number" name="stock" class="form-control rounded-3 shadow-sm" value="{{ $product->stock }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug" class="form-control rounded-3 shadow-sm" value="{{ $product->slug }}">
                    </div>
                </div>

                {{-- Description --}}
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="summernote" rows="4" class="form-control rounded-3 shadow-sm">{{ $product->description }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                {{-- Colors + Variants --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-palette me-2 text-warning"></i> Product Colors + Variants</h4>
                    <button type="button" class="btn btn-primary rounded-pill px-4" id="add-color">
                        <i class="bi bi-plus-circle me-1"></i> Add Color
                    </button>
                </div>

                <div id="colors-wrapper" class="d-flex flex-column gap-4">
                    @foreach ($product->variants as $index => $variant)
                        @php
                            $sizes = $variant->sizes;
                            if (is_string($sizes)) {
                                $sizes = json_decode($sizes, true) ?: explode(',', $sizes);
                            } elseif (!is_array($sizes)) {
                                $sizes = [];
                            }
                            $sizes = array_filter($sizes);
                        @endphp
                        <div class="p-3 card shadow-sm rounded-3 color-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3 flex-grow-1">
                                    <div class="color-box" style="background: {{ $variant->color }}"></div>
                                    <input type="text" name="colors[{{ $index }}][color_name]" value="{{ $variant->color_name }}" class="form-control rounded-3">
                                    <input type="hidden" name="colors[{{ $index }}][code]" class="color-code-input" value="{{ $variant->color }}">
                                    <span class="color-code">{{ $variant->color }}</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger ms-3 remove-color">✖</button>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Sizes</label>
                                    <select class="form-select size-dropdown">
                                        <option value="" disabled>Select Size</option>
                                        @foreach(['S','M','L','XL','XXL'] as $sizeOption)
                                            <option value="{{ $sizeOption }}">{{ $sizeOption }}</option>
                                        @endforeach
                                    </select>
                                    <div class="selected-sizes d-flex flex-wrap mt-2 gap-2">
                                        @foreach($sizes as $size)
                                            <span class="badge bg-secondary size-tag">
                                                {{ trim($size) }}
                                                <i class="bi bi-x-circle ms-1 remove-size" style="cursor:pointer;"></i>
                                            </span>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="colors[{{ $index }}][sizes]" class="sizes-hidden-input" value="{{ implode(',', $sizes) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="colors[{{ $index }}][price]" value="{{ $variant->price }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="colors[{{ $index }}][stock]" value="{{ $variant->stock }}" class="form-control">
                                </div>
                            </div>

                            <div class="fw-semibold mb-2">Upload Images</div>
                            <input type="file" name="images[{{ $index }}][]" multiple class="filepond">

                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($variant->images as $img)
                                    <img src="{{ asset('storage/'.$img->image_path) }}" width="80" height="80" class="rounded border">
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success py-2 rounded-pill shadow">
                        <i class="bi bi-check-circle me-1"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ==== Scripts ==== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<link href="https://unpkg.com/filepond@^4/dist/filepond.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

<script>
$(document).ready(function(){

    // Summernote
    $('#summernote').summernote({
        placeholder:'Write product description...',
        tabsize:2,
        height:200
    });

    // Filepond
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );
    FilePond.setOptions({
        allowMultiple:true,
        instantUpload:false,
        storeAsFile:true,
        acceptedFileTypes:['image/*'],
        imagePreviewHeight:120
    });
    FilePond.parse(document.body);

    let colorIndex = {{ $product->variants->count() }};

    // ================== Sizes ==================
    function initSizeDropdown(section){
        const dropdown = section.querySelector('.size-dropdown');
        const selectedWrapper = section.querySelector('.selected-sizes');
        const hiddenInput = section.querySelector('.sizes-hidden-input');

        // ✅ Fixed function
        function updateHidden(){
            const sizes = Array.from(selectedWrapper.querySelectorAll('.size-tag')).map(span =>
                span.textContent.replace('✖','').trim()
            );
            hiddenInput.value = sizes.length ? sizes.join(',') : '';
        }

        dropdown.addEventListener('change', () => {
            const selected = dropdown.value;
            if(selected && !Array.from(selectedWrapper.querySelectorAll('.size-tag')).some(span => span.textContent.includes(selected))){
                const span = document.createElement('span');
                span.classList.add('badge','bg-secondary','size-tag','me-1');
                span.innerHTML = `${selected} <i class="bi bi-x-circle ms-1 remove-size" style="cursor:pointer;"></i>`;
                selectedWrapper.appendChild(span);
                updateHidden();
            }
        });

        selectedWrapper.addEventListener('click', e => {
            if(e.target.classList.contains('remove-size')){
                e.target.closest('.size-tag').remove();
                updateHidden();
            }
        });

        updateHidden();
    }

    // ================== Color Picker ==================
    function initColorPicker(section){
        const colorBox = section.querySelector('.color-box');
        const colorInput = section.querySelector('.color-code-input');
        const colorText = section.querySelector('.color-code');

        const pickr = Pickr.create({
            el: colorBox,
            theme: 'classic',
            default: colorInput.value || '#F44336',
            components: {
                preview:true,
                opacity:true,
                hue:true,
                interaction:{input:true,save:true}
            }
        });

        pickr.on('save', (color) => {
            const hexColor = color.toHEXA().toString();
            colorBox.style.background = hexColor;
            colorInput.value = hexColor;
            colorText.textContent = hexColor;
            pickr.hide();
        });
    }

    // ================== Initialize existing variants ==================
    $('.color-section').each(function(){
        initSizeDropdown(this);
        initColorPicker(this);
    });

    // ================== Remove color ==================
    $(document).on('click','.remove-color',function(){
        $(this).closest('.color-section').remove();
    });

    // ================== Add color dynamically ==================
    $('#add-color').click(function(){
        const div = document.createElement('div');
        div.classList.add('p-3','card','shadow-sm','rounded-3','color-section');
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <div class="color-box" style="background:#F44336"></div>
                    <input type="text" name="colors[${colorIndex}][color_name]" value="#F44336" class="form-control rounded-3">
                    <input type="hidden" name="colors[${colorIndex}][code]" class="color-code-input" value="#F44336">
                    <span class="color-code">#F44336</span>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger ms-3 remove-color">✖</button>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Sizes</label>
                    <select class="form-select size-dropdown">
                        <option value="" disabled>Select Size</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                    <div class="selected-sizes d-flex flex-wrap mt-2 gap-2"></div>
                    <input type="hidden" name="colors[${colorIndex}][size]" class="sizes-hidden-input">
                </div>
                <div class="col-md-4"><label class="form-label">Price</label><input type="number" name="colors[${colorIndex}][price]" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Stock</label><input type="number" name="colors[${colorIndex}][stock]" class="form-control"></div>
            </div>
            <div class="fw-semibold mb-2">Upload Images</div>
            <input type="file" name="images[${colorIndex}][]" multiple class="filepond">
        `;
        $('#colors-wrapper').append(div);
        FilePond.create(div.querySelector('.filepond'));
        initSizeDropdown(div);
        initColorPicker(div);
        colorIndex++;
    });

});
</script>
@endsection
