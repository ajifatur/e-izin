<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLateFund extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user__late__funds';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array
     */
    protected $fillable = ['month', 'year', 'amount'];
    
    /**
     * Get the user that owns the indicator.
     */
    public function user()
    {
        return $this->belongsTo(Group::class, 'user_id');
    }
}
