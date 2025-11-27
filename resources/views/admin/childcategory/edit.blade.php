@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
  <div class="card shadow-sm border-0 rounded-4 p-4">
    <h4 class="fw-bold mb-4 text-primary">
      <i class="bi bi-diagram-3 me-2"></i>Update Child Category
    </h4>

    {{-- Form --}}
    <form action="{{route('childcategory.update',$childcategory->id)}}" method="POST">
      @csrf
      <div class="row g-3">

        {{-- Category --}}
        <div class="col-md-6">
          <label for="category" class="form-label fw-semibold">
            <i class="bi bi-tags-fill me-1 text-primary"></i>Select Category
          </label>
          <select name="category_id" id="category" class="form-select" >
            <option value="">-- Choose Category --</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{$childcategory->category_id == $category->id ? 'selected':''}}>{{ $category->name }}</option>
            @endforeach
          </select>
          @error('category_id')
            <div class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
          @enderror
        </div>

        {{-- Subcategory --}}
        <div class="col-md-6">
          <label for="subcategory" class="form-label fw-semibold">
            <i class="bi bi-diagram-2-fill me-1 text-success"></i>Select Subcategory
          </label>
          <select name="subcategory_id" id="subcategory" class="form-select">
            <option value="">-- Choose Subcategory --</option>
            @foreach($subcategories as $subcategory)
              <option value="{{ $subcategory->id }}" {{$childcategory->subcategory_id == $subcategory->id ? 'selected': ''}}>{{ $subcategory->name }}</option>
            @endforeach
          </select>
          @error('subcategory_id')
            <div class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
          @enderror
        </div>

        {{-- Childcategory Name --}}
        <div class="col-md-12">
          <label class="form-label fw-semibold">
            <i class="bi bi-pencil-square me-1 text-warning"></i>Child Category Name
          </label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="bi bi-textarea-t"></i></span>
            <input type="text" name="name" value="{{$childcategory->name}}" class="form-control" placeholder="Enter Child Category name">
          </div>
          @error('name')
            <div class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
          @enderror
        </div>

      </div>

      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold">
          <i class="bi bi-save2-fill me-1"></i> Update Child Category
        </button>
      </div>
    </form>
  </div>
</div>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>


$(document).ready(function() {
   


    // Dependent Dropdown: Category → Subcategory
    $('#category').change(function() {
        const categoryId = $(this).val();
        if(categoryId){
            $.get('/api/get-subcategories/' + categoryId, function(data){
                $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
                $.each(data, function(k,v){
                    $('#subcategory').append('<option value="'+v.id+'">'+v.name+'</option>');
                });
            });
        } else {
            $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
        }
    });
});


</script>

@endsection

