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
        'name', 'role_id', 'group_id', 'office_id', 'position_id', 'username', 'email', 'password', 'birthdate', 'gender', 'phone_number', 'address', 'latest_education', 'identity_number', 'start_date', 'end_date', 'status', 'last_visit',
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

    /**
     * Get the late funds for the user.
     */
    public function late_funds()
    {
        return $this->hasMany(\App\Models\UserLateFund::class);
    }

    /**
     * Get the debt funds for the user.
     */
    public function debt_funds()
    {
        return $this->hasMany(\App\Models\UserDebtFund::class);
    }
}
