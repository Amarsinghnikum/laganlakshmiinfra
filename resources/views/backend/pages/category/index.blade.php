@extends('backend.layouts.master')

@section('title')
Category - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2 class="mb-4">Categories</h2>

    <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="categories-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    @if($category->image)
                    <img src="{{ asset($category->image) }}" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-info">Edit</a>

                    <!-- <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this category?')"
                            class="btn btn-sm btn-danger">Delete</button>
                    </form> -->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#categories-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush