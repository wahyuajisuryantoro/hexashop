@extends('layouts.admin')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Add New Product</h1>

<!-- Form Start -->
<form action="{{ route('admin.products.storeProcess') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" name="name" required>
    </div>
    <div class="form-group">
        <label for="productDescription">Description</label>
        <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="productPrice">Price</label>
        <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="productCategory">Category</label>
        <select class="form-control" id="productCategory" name="category">
            <option value="Men">Men</option>
            <option value="Women">Women</option>
            <option value="Kids">Kids</option>
            <option value="Accessories">Accessories</option>
        </select>
    </div>
        <div class="form-group">
            <label for="productImage">Upload Image</label>
            <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection