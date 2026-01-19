@extends('backend.layouts.master')

@section('title', 'Subcategories')

@section('admin-content')
<div class="container">
    <h4 class="mb-4">All Subcategories</h4>

    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary mb-3">Add Subcategory</a>

    <table id="subcategories-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Subcategory</th>
                <th>Category</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->category->name }}</td>
                <td>
                    @if($subcategory->image)
                    <img src="{{ asset('storage/' . $subcategory->image) }}" width="50">
                    @endif
                </td>
                <td>{{ $subcategory->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                        class="btn btn-sm btn-warning">Edit</a>
                    <!-- <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST"
                        class="d-inline" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Del</button>
                    </form> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#subcategories-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush