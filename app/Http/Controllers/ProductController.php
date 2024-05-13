<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Kelola Produk";
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products', 'title'));
    }

    public function store()
    {
        $title = "Tambah Produk";
        return view('admin.products.create', compact('title'));
    }

    public function storeProcess(Request $request)
    {
        $title = "Tambah Produk Baru";
        try {
            // Validate the incoming request.
            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'nullable',
                'price' => 'required|numeric',
                'category' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'image.mimes' => 'Unsupported file format. Please upload an image in JPEG, PNG, JPG, GIF, or SVG format.',
                'image.max' => 'File too large. Maximum file size allowed is 2MB.'
            ]);

            // Proceed if validation passes
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $destinationPath = public_path('images/unggahan');
                $request->image->move($destinationPath, $imageName);
                $imagePath = "images/unggahan/" . $imageName;
                Log::info('Image uploaded: ' . $imagePath);
            } else {
                $imagePath = null;
                Log::info('No image uploaded');
            }

            $product = new Product([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category' => $request->category,
                'image_url' => $imagePath
            ]);
            $product->save();
            Log::info('Product created: ' . $product->id);

            Alert::success('Success', 'Product added successfully.');
            return redirect()->back()->with(compact('title'));
        } catch (ValidationException $e) {
            // Handle specific validation errors
            Log::error('Validation failed: ' . $e->getMessage());
            $errors = $e->errors();
            foreach ($errors as $field => $message) {
                Alert::error('Validation Error', $message[0]);  // Show the first error message
            }
            return redirect()->back()->withErrors($e->errors())->withInput()->with(compact('title'));
        } catch (\Exception $e) {
            Log::error('Failed to add product: ' . $e->getMessage());
            Alert::error('Error', 'Failed to add product: ' . $e->getMessage());
            return redirect()->back()->with(compact('title'));
        }
    }

    public function edit($id)
    {
        $title = "Edit Produk";
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'title'));
    }

    public function update(Request $request, $id)
    {
        $title = "Update Product";
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category' => $request->category,
            ]);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $destinationPath = public_path('images/unggahan');
                $request->image->move($destinationPath, $imageName);
                $product->image_url = "images/unggahan/" . $imageName;
                $product->save();
            }

            Alert::success('Success', 'Product updated successfully.');
            return redirect()->route('admin.products.index')->with(compact('title'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update product: ' . $e->getMessage());
            return redirect()->back()->with(compact('title'));
        }
    }

    public function delete($id)
    {
        $title = "Delete Product";
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            Alert::success('Success', 'Product deleted successfully.');
            return redirect()->route('admin.products.index')->with(compact('title'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to delete product: ' . $e->getMessage());
            return redirect()->back()->with(compact('title'));
        }
    }
}
