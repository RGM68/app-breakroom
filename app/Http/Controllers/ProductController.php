<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->image_url = Storage::url($product->image);
        }
        return view('admin.product.index', compact('products'));
    }

    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        $image = Storage::url($product->image);
        return view('admin.product.show', [
            'product' => $product,
            'image' => $image
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            // 'category' => 'required|in:food,drink,merchandise',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $path = $request->file(key: 'image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $validatedData['image'] = $path;
        Product::create($validatedData);

        return redirect()->route('admin.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $image = Storage::url($product->image);
        return view('admin.product.edit', ['product' => $product, 'image' => $image]);
    }

    public function changeImage($id)
    {
        //
        $product = Product::findOrFail($id);
        $image = Storage::url($product->image);
        return view('admin.product.change_image', ['product' => $product, 'image' => $image]);
    }
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect('/admin/products')->with('success', 'Product updated successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->input('status');
        $product->save();
    
        return redirect('/admin/products')->with('success', 'Product status updated successfully!');
    }

    public function updateImage(Request $request, $id){
        $product = Product::findOrFail($id);
        $path = $request->file('image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $product->image = $path;
        $product->save();
        return redirect('/admin/products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/admin/products');
    }
}
?>