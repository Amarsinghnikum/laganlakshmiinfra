@extends('backend.layouts.master')

@section('title')
Category - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Edit Category</h2>

    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($category->image)
            <img src="{{ asset($category->image) }}" width="80">
            @else
            <p>No image</p>
            @endif
        </div>

        <div class="mb-3">
            <label>New Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input"
                {{ $category->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection