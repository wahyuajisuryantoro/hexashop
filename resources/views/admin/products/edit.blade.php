@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Product</h1>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" name="name" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label for="productDescription">Description</label>
        <textarea class="form-control" id="productDescription" name="description" rows="3">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="productPrice">Price</label>
        <input type="number" class="form-control" id="productPrice" name="price" value="{{ $product->price }}" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="productCategory">Category</label>
        <select class="form-control" id="productCategory" name="category">
            <option value="Men" {{ $product->category == 'Men' ? 'selected' : '' }}>Men</option>
            <option value="Women" {{ $product->category == 'Women' ? 'selected' : '' }}>Women</option>
            <option value="Kids" {{ $product->category == 'Kids' ? 'selected' : '' }}>Kids</option>
            <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
        </select>
    </div>
        <div class="form-group">
            <label for="productImage">Upload Image</label>
            <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
            <img src="{{ asset($product->image_url) }}" alt="Current Image" style="width: 100px; height: auto;">
        </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
