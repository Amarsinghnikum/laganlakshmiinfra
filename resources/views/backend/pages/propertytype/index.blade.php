@extends('backend.layouts.master')

@section('title', 'Property Type')

@section('admin-content')
<div class="container">
    <h4 class="mb-4">All Property Type</h4>

    <a href="{{ route('admin.propertytype.create') }}" class="btn btn-primary mb-3">Add Property Type</a>

    <table id="propertytype-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Property Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propertytype as $type)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $type->name }}</td>
                <td>{{ $type->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.propertytype.edit', $type->id) }}"
                        class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.propertytype.destroy', $type->id) }}" method="POST"
                        class="d-inline" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Del</button>
                    </form>
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
    $('#propertytype-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush