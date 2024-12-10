<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'phone',
    //     'role',
    //     'reset_token'
    // ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'verification_code',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Existing relationships
    public function tableBookings()
    {
        return $this->hasMany(TableBooking::class);
    }

    public function events()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function isAdmin()
    {
        return (int)$this->role_id === 1;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Add this new relationship for OTP codes
    public function otpCodes()
    {
        return $this->hasMany(OtpCode::class);
    }
    
}