<?php
// app/Models/Event.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'date', 'max_participants'
    ];

    // Scope untuk event mendatang
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now());
    }

    // Relasi many-to-many untuk peserta event
    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participants');
    }
}