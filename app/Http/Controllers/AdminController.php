<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $tables = Table::all();
        foreach ($tables as $table) {
            $table->image_url = Storage::url($table->image);
        }
        return view('admin.index', ['tables' => $tables]);
    }

    public function create_table()
    {
        //
        return view('admin.table.create_table');
    }
}
