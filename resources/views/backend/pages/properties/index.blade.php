@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2 class="mb-4">Properties</h2>

    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="properties-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>City</th>
                <th>Location</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $index => $property)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $property->name }}</td>
                <td>{{ $property->sku }}</td>
                <td>${{ $property->offer_price }}</td>
                @php
                $categoryValue = $property->category_id;
                if (is_string($categoryValue) && (str_starts_with($categoryValue, '['))) {
                $categoryIds = json_decode($categoryValue, true);
                } else {
                $categoryIds = [$categoryValue];
                }
                $categoryNames = App\Models\Category::whereIn('id', $categoryIds)->pluck('name')->toArray();
                @endphp
                <td>{{ implode(', ', $categoryNames) ?: '-' }}</td>
                <td>{{ $property->is_featured ? 'Yes' : 'No' }}</td>
                <td>{{ $property->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    @if($property->main_image)
                    <img src="{{ url($property->main_image) }}" alt="Property Image" height="100px" width="100px">
                    @endif
                </td>
                <td>
                    <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this property?')"
                                class="btn btn-sm btn-danger">Delete</button>
                        </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No properties found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#properties-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush