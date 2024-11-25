<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
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
