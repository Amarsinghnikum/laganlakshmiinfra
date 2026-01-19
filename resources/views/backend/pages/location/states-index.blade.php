@extends('backend.layouts.master')

@section('title')
States - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h3 class="mb-3">States List</h3>

    <table id="states-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>State Name</th>
                <th>Status</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            @forelse($states as $state)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $state->name }}</td>
                <td>
                    <span class="status-badge {{ $state->status ? 'active' : 'active' }}">
                        {{ $state->status ? 'Active' : 'Active' }}
                    </span>
                </td>
                <td>{{$countryName}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No states found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#states-table').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});
</script>
@endpush