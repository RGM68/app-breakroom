<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    //
    public function index()
    {
        //
        $tables = Table::orderBy('capacity', 'desc')->get();
        $events = Event::orderBy('date', 'asc')->take(3)->get();
        foreach ($tables as $table) {
            $table->image_url = Storage::url($table->image);
        }
        foreach ($events as $event) {
            $event->image_url = Storage::url($event->image);
        }
        return view('admin.index', ['tables' => $tables, 'events' => $events]);
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
}
