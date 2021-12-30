<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'absents';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array
     */
    protected $fillable = ['category_id', 'date', 'note', 'attachment'];
    
    /**
     * Get the user that owns the absent.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
