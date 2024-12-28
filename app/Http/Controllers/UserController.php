<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\TableBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        $tables = Table::all();

        return view('user.dashboard', compact('tables'));
    }

    public function profile() {}

    public function updateProfile() {}

    public function tables()
    {
        $tables = Table::with('tableBookings') // Eager load bookings for each table
        ->orderBy('number', 'asc')
        ->get()
        ->map(function ($table) {
            // Check if the table has any active bookings
            $isTaken = $table->tableBookings->isNotEmpty(); // Modify logic as needed for your app
            $table->status_flag = $isTaken ? 'Taken' : $table->status; // Preserve 'open' or 'closed' from table
            $table->image_url = Storage::url($table->image);
            return $table;
        });
        foreach ($tables as $table) {
            $table->image_url = Storage::url($table->image);
        }
        return view('user.tables.index', ['tables' => $tables]);
    }

    public function bookTablesView(Request $request, $table_id)
    {
        $table = Table::findOrFail($table_id);
        $table->image_url = Storage::url($table->image);

        return view('user.tables.booking', ['table' => $table]);
    }


    public function bookTables(Request $request, $table_id)
    {
        // $request->validate([
        //     'duration' => 'required|integer',
        // ]);
        $table = Table::findOrFail($table_id);
        TableBooking::create([
            'user_id' => Auth::id(),
            'table_id' => $table_id,
            'booking_time' => $request->input('datetime'),
            // 'duration' => 3,
            'duration' => $request->input('duration'),
            'status' => 'active',
        ]);
        return redirect()->route('user.tables')->with(['booking_status' => 'Berhasil booking table ' . $table->number . '!']);
    }
}
