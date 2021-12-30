<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attendances';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array
     */
    protected $fillable = ['start_at', 'end_at', 'date', 'entry_at', 'exit_at', 'late'];
    
    /**
     * Get the user that owns the attendance.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the work hour that owns the attendance.
     */
    public function workhour()
    {
        return $this->belongsTo(WorkHour::class, 'workhour_id');
    }

    /**
     * Get the office that owns the attendance.
     */
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
