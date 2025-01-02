<?php

namespace App\Http\Controllers;

use App\Models\TableBooking;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\DB;
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
        $bookings = TableBooking::with(['user', 'table', 'usedVoucher'])->where('status', 'active')
        ->orderBy('booking_time', 'asc')->get();

        return view('admin.table_bookings.index', compact('bookings'));

    }

    public function finish($id)
    {
        $booking = TableBooking::with(['user', 'table', 'user.loyaltyTier'])->findOrFail($id);

        // Calculate original price
        $duration = $booking->duration ?? 0;
        $price = $booking->table->price ?? 0;
        $originalPrice = ($duration / 60) * $price;

        // Get loyalty discount
        $loyaltyDiscount = 0;
        $loyaltyDiscount = floor(($originalPrice * $booking->user->loyaltyTier->table_discount_percentage) / 100);
        

        // Get voucher discount
        $voucherDiscount = 0;
        if ($booking->used_voucher_id) {
            $userVoucher = UserVoucher::with('voucher')->find($booking->used_voucher_id);
            if ($userVoucher) {
                if ($userVoucher->voucher->discount_type === 'percentage') {
                    $voucherDiscount = floor(($originalPrice * $userVoucher->voucher->discount_value) / 100);
                    if ($userVoucher->voucher->max_discount) {
                        $voucherDiscount = min($voucherDiscount, $userVoucher->voucher->max_discount);
                    }
                } else {
                    $voucherDiscount = $userVoucher->voucher->discount_value;
                }
                
                // Mark voucher as used
                $userVoucher->is_used = true;
                $userVoucher->used_at = now();
                $userVoucher->save();
            }
        }

        // Calculate final price
        $finalPrice = ($originalPrice - $loyaltyDiscount) - $voucherDiscount;
        
        // Update booking
        $booking->status = 'finished';
        $booking->original_price = $originalPrice;
        $booking->loyalty_discount = $loyaltyDiscount;
        $booking->voucher_discount = $voucherDiscount;
        $booking->final_price = $finalPrice;
        
        // Add loyalty points based on final paid price
        $booking->user->loyalty_points += floor($finalPrice / 10000);
        
        DB::transaction(function() use ($booking) {
            $booking->save();
            $booking->user->save();
        });

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
