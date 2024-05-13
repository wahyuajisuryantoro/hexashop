@extends('layouts.admin')

@section('content')
<style>
    .container {
        min-height: 100vh; /* Minimal height of the viewport */
        overflow-y: auto; /* Enable vertical scrolling */
    }
</style>
<div class="container mt-3">
    <h2>Manage Assets</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- List existing assets -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Type</th>
                <th>Preview</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assets as $asset)
            <tr>
                <td>{{ $asset->type }}</td>
                <td><img src="{{ asset($asset->path) }}" alt="{{ $asset->type }}" style="width: 100px; height: auto;"></td>
                <td>
                    <a href="{{ route('admin.assets.edit', $asset->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No assets found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Upload forms for each type of asset -->
    @foreach(['logo', 'mainBanner', 'womanBanner', 'menBanner', 'kidsBanner', 'otherBanner'] as $type)
    <form action="{{ route('admin.assets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="{{ $type }}" class="form-label">Upload {{ ucfirst($type) }}</label>
            <input class="form-control" type="file" id="{{ $type }}" name="{{ $type }}">
            <button type="submit" class="btn btn-primary mt-2">Upload {{ ucfirst($type) }}</button>
        </div>
    </form>
    @endforeach
</div>
@endsection
