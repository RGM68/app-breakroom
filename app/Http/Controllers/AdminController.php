<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $tables = Table::all();
        return view('admin.index', ['tables' => $tables]);
    }

    public function create_table()
    {
        //
        return view('admin.table.create_table');
    }
}
