<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'birthdate', 'gender', 'phone_number', 'role', 'status', 'last_visit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the group that owns the user.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    
    /**
     * Get the office that owns the user.
     */
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    
    /**
     * Get the position that owns the user.
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Get the indicators for the user.
     */
    public function indicators()
    {
        return $this->hasMany(\App\Models\UserIndicator::class);
    }
}
