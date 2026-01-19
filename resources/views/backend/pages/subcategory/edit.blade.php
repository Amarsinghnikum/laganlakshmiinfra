@extends('backend.layouts.master')
@section('title', 'Edit Subcategory')

@section('admin-content')
<div class="container">
    <h4>Edit Subcategory</h4>
    <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group mb-2">
            <label>Main Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $subcategory->description }}</textarea>
        </div>

        <div class="form-group mb-2">
            <label>Current Image</label><br>
            @if($subcategory->image)
                <img src="{{ asset('storage/'.$subcategory->image) }}" width="80">
            @endif
        </div>

        <div class="form-group mb-2">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $subcategory->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
