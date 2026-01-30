@extends('backend.layouts.master')
@section('title', 'Create Property Type')

@section('admin-content')
<div class="container">
    <h4>Create Property Type</h4>
    <form action="{{ route('admin.propertytype.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="form-check mb-2">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
