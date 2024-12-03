<?php

namespace App\Http\Controllers;

use App\Models\FoodAndDrink;
use Illuminate\Http\Request;

class FoodAndDrinkController extends Controller
{
    //
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
        FoodAndDrink::create($validatedData);

        // return redirect()->route('products.index')
        //     ->with('success', 'Produk berhasil ditambahkan');
    }
}
