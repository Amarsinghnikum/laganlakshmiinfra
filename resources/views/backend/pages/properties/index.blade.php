@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2 class="mb-4">Properties</h2>

    <a href="{{ route('user.properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="properties-table" class="table table-hover table-striped table-bordered align-middle text-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>State</th>
                <th>City</th>
                <th>Property For</th>
                <th>Price</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $index => $property)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $property->title }}</td>
                <td>
                    {{ $states[$property->dynamic_data['state_id']] ?? '-' }}
                </td>
                <td>
                    {{ $cities[$property->dynamic_data['city_id']] ?? '-' }}
                </td>
                <td>{{ $property->dynamic_data['property_for'] ?? '-' }}</td>
                <td>
                    <strong>₹{{ number_format($property->price, 2) }}</strong>
                </td>
                <td>
                    @if($property->status === 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($property->status === 'approved')
                    <span class="badge bg-success">Approved</span>
                    @else
                    <span class="badge bg-secondary">{{ ucfirst($property->status) }}</span>
                    @endif
                </td>
                <td>
                    @if(!empty($property->dynamic_data['main_image']))
                    <img src="{{ asset($property->dynamic_data['main_image']) }}" class="img-thumbnail"
                        style="width:80px;height:60px;object-fit:cover;">
                    @else
                    <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('user.properties.edit', $property->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('user.properties.destroy', $property->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this property?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
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
        pageLength: 10,
        lengthChange: true,
        ordering: true,
        responsive: true
    });
});
</script>
@endpush