@extends('layouts.masterlayout')

@section('content')
<div class="container mt-4">
 <div class="card-header text-white d-flex justify-content-between align-items-center" 
     style="background: linear-gradient(90deg, #007bff, #6610f2);">
  
  <!-- Left Side Title -->
  <h4 class="mb-0">
    <i class="bi bi-shield-lock"></i> Assign Permissions to Role
  </h4>

  <!-- Right Side Badge -->
  <span class="badge bg-light text-dark fs-6 shadow-sm px-3 py-2">
    <i class="bi bi-person-badge"></i> Role: 
    <strong>{{ ucfirst($role->name) }}</strong>
  </span>
</div>


    <div class="card-body p-4">
      <form action="{{ route('roles.updatePermissions', $role->id) }}" method="POST">
        @csrf

        <!-- Permission List -->
        <div class="list-group list-group-flush shadow-sm border rounded-3" style="max-height: 500px; overflow-y: auto;">
          @foreach($permissions as $permission)
            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
              <div class="d-flex align-items-center">
                <input 
                  class="form-check-input me-3" 
                  type="checkbox" 
                  name="permissions[]" 
                  id="perm_{{ $permission->id }}" 
                  value="{{ $permission->id }}"
                  {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                <span class="fw-semibold">{{ ucfirst($permission->name) }}</span>
              </div>
              <i class="bi bi-key text-primary fs-5"></i>
            </label>
          @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
          <a href="{{ route('role.manage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Roles
          </a>
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save"></i> Update Permissions
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  /* Modern Scrollbar */
  .list-group::-webkit-scrollbar {
    width: 8px;
  }
  .list-group::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 10px;
  }
  .list-group::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0,0,0,0.3);
  }

  /* Hover Effects */
  .list-group-item {
    transition: all 0.2s ease-in-out;
  }


  /* Checkbox Style */
  .form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
  }
</style>
@endsection
