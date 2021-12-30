<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work__hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category', 'quota', 'start_at', 'end_at'];
    
    /**
     * Get the group that owns the work hour.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * Get the office that owns the work hour.
     */
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    /**
     * Get the position that owns the work hour.
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
