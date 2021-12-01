<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'positions';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = ['name', 'work_hours'];

    /**
     * Get the users for the position.
     */
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
    
    /**
     * Get the group that owns the office.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
