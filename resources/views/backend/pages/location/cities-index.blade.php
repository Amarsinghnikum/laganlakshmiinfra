@extends('backend.layouts.master')

@section('title')
Cities - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h3 class="mb-3">Cities List</h3>

    <table id="cities-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>City Name</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cities as $city)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $city->city }}</td>
                <td>
                    <span class="status-badge {{ $city->status ? 'active' : 'active' }}">
                        {{ $city->status ? 'Active' : 'Active' }}
                    </span>
                </td>
                <td>{{ $city->state->name ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No cities found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#cities-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush