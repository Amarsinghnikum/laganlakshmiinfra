@extends('backend.layouts.master')
@section('title', 'Create Subcategory')

@section('admin-content')
<div class="container">
    <h4>Create Subcategory</h4>
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label>Main Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group mb-2">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-check mb-2">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
