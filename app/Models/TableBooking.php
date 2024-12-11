<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    protected $fillable = [
        'user_id',
        'table_id',
        'booking_time',
        'duration',
        'status'
    ];
    //
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A booking belongs to one table
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
