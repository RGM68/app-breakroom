<?php

namespace App\Http\Controllers;

use App\Models\TableBooking;
use Illuminate\Http\Request;

class TableBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminIndex()
    {
        //
        $bookings = TableBooking::with(['user', 'table'])->where('status', 'active')
        ->orderBy('booking_time', 'asc')->get();

        foreach($bookings as $booking){
            $booking->total_price = ($booking->duration / 60) * $booking->table->price;
        }

        return view('admin.table_bookings.index', compact('bookings'));

    }

    public function finish($id)
    {
        $booking = TableBooking::with(['user', 'table'])->findOrFail($id);

        $duration = $booking->duration ?? 0;
        $price = $booking->table->price ?? 0;
        $total_price = ($duration / 60) * $price;

        $booking->status = 'finished';
        $booking->user->loyalty_points += ceil($total_price / 10000);
        $booking->save();
        $booking->user->save();

        return redirect('/admin/bookings')->with('success', 'Booking has been marked as finished.');
    }

    public function cancel($id)
    {
        $booking = TableBooking::with(['user', 'table'])->findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect('/admin/bookings')->with('success', 'Booking has been marked as cancelled.');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TableBooking $tableBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TableBooking $tableBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TableBooking $tableBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TableBooking $tableBooking)
    {
        //
    }
}
