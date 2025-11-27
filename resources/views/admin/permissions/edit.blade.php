@extends('layouts.masterlayout')

@section('content')
<div class="container">
    <h2>Edit Permission</h2>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Permission Name</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('permission.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
