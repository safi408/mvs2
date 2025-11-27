@extends('layouts.masterlayout')

@section('title', 'Create Permission')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-key-fill me-2"></i>Create New Permission
                    </h4>
                </div>

                <div class="card-body p-4">

  

                    <!-- Form -->
                    <form action="{{route('permission.store')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Permission Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Enter permission name (e.g. manage_users)" 
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save"></i> Save Permission
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
