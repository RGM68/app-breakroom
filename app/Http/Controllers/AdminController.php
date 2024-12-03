<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $tables = Table::orderBy('capacity', 'desc')->get();
        foreach ($tables as $table) {
            $table->image_url = Storage::url($table->image);
        }
        $events = Event::orderBy('date', 'asc')->take(2)->get();
        foreach ($events as $event) {
            $event->image_url = Storage::url($event->image);
        }
        $products = Product::orderBy('name', 'asc')->take(3)->get();
        foreach ($products as $product) {
            $product->image_url = Storage::url($product->image);
        }
        return view('admin.index', ['tables' => $tables, 'events' => $events, 'products' => $products]);
    }

    public function create_table()
    {
        //
        return view('admin.table.create_table');
    }

    public function create_event()
    {
        //
        return view('admin.event.create_event');
    }
    public function create_product()
    {
        //
        return view('admin.product.create_product');
    }
}
