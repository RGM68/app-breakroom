<?php

namespace App\Http\Controllers;

use App\Models\FoodAndDrink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodAndDrinkController extends Controller
{
    //
    public function adminIndex()
    {
        $foods = FoodAndDrink::orderBy('name', 'asc')->get();
        $categories = [
            'Food' => [],
            'Drink' => [],
            'Dessert' => [],
            'Other' => []
        ];
        foreach ($foods as $food) {
            $food->image_url = Storage::url($food->image);
            
            if (isset($categories[$food->category])) {
                $categories[$food->category][] = $food;
            } else {
                $categories['Other'][] = $food;
            }
        }
        return view('admin.food.index', compact('categories'));
    }

    public function show($id)
    {
        //
        $food = FoodAndDrink::findOrFail($id);
        $image = Storage::url($food->image);
        return view('admin.food.show', [
            'food' => $food,
            'image' => $image
        ]);
    }

    public function edit($id)
    {
        //
        $food = FoodAndDrink::findOrFail($id);
        $image = Storage::url($food->image);
        return view('admin.food.edit', ['food' => $food, 'image' => $image]);
    }

    public function changeImage($id)
    {
        //
        $food = FoodAndDrink::findOrFail($id);
        $image = Storage::url($food->image);
        return view('admin.food.change_image', ['food' => $food, 'image' => $image]);
    }
    
    public function update(Request $request, $id)
    {
        //
        $food = FoodAndDrink::findOrFail($id);
        $food->name = $request->name;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->category = $request->category;
        $food->save();

        return redirect('/admin/foods')->with('success', 'Food updated successfully!');
    }

        public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $path = $request->file(key: 'image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $validatedData['image'] = $path;
        FoodAndDrink::create($validatedData);
        return redirect('/admin')->with('success', 'Food added successfully!');

        // return redirect()->route('food.index')
        //     ->with('success', 'Produk berhasil ditambahkan');
    }

    public function updateStatus(Request $request, $id)
    {
        $food = FoodAndDrink::findOrFail($id);
        $food->status = $request->input('status');
        $food->save();
    
        return redirect('/admin/foods')->with('success', 'Table updated successfully!');
    }

    public function updateImage(Request $request, $id){
        $food = FoodAndDrink::findOrFail($id);
        $path = $request->file('image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $food->image = $path;
        $food->save();
        return redirect('/admin/foods')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        //
        $food = FoodAndDrink::findOrFail($id);
        $food->delete();
        return redirect('/admin/foods');
    }
}
