@extends('backend.layouts.master')

@section('title')
Clients - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Clients</h2>

    <a href="{{ route('admin.clients.create') }}" class="btn btn-success mb-3">Add Client</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        @foreach($clients as $client)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $client->name }}</td>
            <td>
                @if($client->image)
                <img src="{{ asset($client->image) }}" width="80">
                @endif
            </td>
            <td>
                {{-- Edit Button --}}
                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>

                {{-- Delete Button --}}
                <!-- <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                    style="display:inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this client?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </form> -->
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection