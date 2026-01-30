@extends('backend.layouts.master')
@section('title', 'Edit Property Type')

@section('admin-content')
<div class="container">
    <h4>Edit Property Type</h4>
    <form action="{{ route('admin.propertytype.update', $propertytype->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $propertytype->name }}" required>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $propertytype->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
