<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tables = Table::all();
        return view('admin.index', ['tables' => $tables]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view('admin.table.create_table');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $path = $request->file('image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $table = new Table();
        $table->number = $request->number;
        $table->status = $request->status;
        $table->capacity = $request->capacity;
        $table->image = $path;
        $table->save();
        return redirect('/admin');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $table = Table::findOrFail($id);
        $image = Storage::url($table->image);
        return view('admin.table.show', [
            'table' => $table,
            'image' => $image
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $table = Table::findOrFail($id);
        return view('admin.table.edit', ['table' => $table]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $table = Table::findOrFail($id);
        $table->number = $request->number;
        $table->status = $request->status;
        $table->capacity = $request->capacity;
        $table->save();

        return redirect('/admin')->with('success', 'Table updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $table = Table::findOrFail($id);
        $table->delete();
        return redirect('/admin');
    }
}
